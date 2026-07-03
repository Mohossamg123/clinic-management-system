<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient')->latest()->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('appointments.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $exists = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This time is already booked!');
        }

        Appointment::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Added successfully');
    }
}
