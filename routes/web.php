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
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Prescription;



/*
|--------------------------------------------------------------------------
| Public Routes (للناس)
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// صفحة الحجز
Route::get('/book', function () {

    // كل المواعيد (10 صباحًا لـ 5 مساءً)
    $times = [];

    for ($i = 10; $i <= 17; $i++) {
        $times[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
    }

    return view('book', ['times' => $times]);
});

// حجز موعد
Route::post('/book', function (Request $request) {

    // ✅ Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required',
        'date' => 'required|date',
        'time' => 'required',
    ]);

    // 🔍 البحث عن المريض
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

    // ❌ منع تعارض المواعيد
    $exists = Appointment::where('date', $request->date)
        ->where('time', $request->time)
        ->exists();

    if ($exists) {
        return back()->with('error', 'This time is already booked!');
    }

    // ✅ إنشاء الموعد
    Appointment::create([
        'patient_id' => $patient->id,
        'date' => $request->date,
        'time' => $request->time,
    ]);

    return back()->with('success', 'Appointment booked successfully!');
});

// API لجلب المواعيد المتاحة (AJAX)
Route::get('/available-times', function (Request $request) {

    $date = $request->date;

    // كل المواعيد
    $times = [];
    for ($i = 10; $i <= 17; $i++) {
        $times[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
    }

    // المحجوز
    $booked = Appointment::where('date', $date)
        ->pluck('time')
        ->toArray();

    // المتاح
    $available = array_diff($times, $booked);

    return response()->json(array_values($available));
});

/*
|--------------------------------------------------------------------------
| Protected Routes (الدكتور فقط)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Patients
    Route::resource('patients', PatientController::class);

    // Appointments
    Route::resource('appointments', AppointmentController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('prescriptions', PrescriptionController::class);
});




Route::get('/prescriptions/{id}/pdf', function ($id) {

    $prescription = Prescription::with('patient')->findOrFail($id);

    $pdf = Pdf::loadView('prescriptions.pdf', compact('prescription'));

    return $pdf->download('prescription.pdf');
});


require __DIR__.'/auth.php';
