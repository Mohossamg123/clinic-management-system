<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Http\Requests\AppointmentRequest;
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

    public function store(AppointmentRequest $request)
    {
        $data = $request->appointmentData();
        $exists = Appointment::whereDate('date', $data['date'])
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This time is already booked!');
        }

        Appointment::create($data);

        return redirect()->route('appointments.index')->with('success', 'Added successfully');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('patient');

        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::orderBy('name')->get();

        return view('appointments.edit', compact('appointment', 'patients'));
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $data = $request->appointmentData();
        $exists = Appointment::whereDate('date', $data['date'])
            ->where('time', $request->time)
                ->where('id', '!=', $appointment->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'This time is already booked!');
        }

        $appointment->update($data);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled,no_show',
        ]);

        $appointment->update($validated);

        return back()->with('success', 'Appointment status updated successfully.');
    }
}
