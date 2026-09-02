<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\PrescriptionController;
use App\Models\Prescription;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/book', function () {
    $times = [];
    for ($i = 10; $i <= 17; $i++) {
        $times[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
    }
    return view('book', ['times' => $times]);
});

Route::post('/book', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required|date_format:H:i',
    ]);

    $patient = Patient::where('phone', $request->phone)->first();

    if ($patient) {
        $patient->update([
            'name' => $request->name
        ]);
    } else {
        $patient = Patient::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
    }

    $exists = Appointment::where('date', $request->date)
        ->where('time', $request->time)
        ->exists();

    if ($exists) {
        return back()->with('error', 'This time is already booked!');
    }

    Appointment::create([
        'patient_id' => $patient->id,
        'date' => $request->date,
        'time' => $request->time,
    ]);

    return back()->with('success', 'Appointment booked successfully!');
});

Route::get('/available-times', function (Request $request) {
    $date = $request->date;
    $times = [];
    for ($i = 10; $i <= 17; $i++) {
        $times[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
    }

    $booked = Appointment::where('date', $date)
        ->pluck('time')
        ->toArray();

    $available = array_diff($times, $booked);

    return response()->json(array_values($available));
});

/*
|--------------------------------------------------------------------------
| Protected Routes (الدكتور فقط)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::resource('prescriptions', PrescriptionController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// تحميل الروشتة PDF
Route::middleware('auth')->get('/prescriptions/{id}/pdf', function ($id) {
    $prescription = Prescription::with('patient')->findOrFail($id);

    $pdf = Pdf::loadView('prescriptions.pdf', compact('prescription'));

    return $pdf->download('prescription.pdf');
});

require __DIR__.'/auth.php';
