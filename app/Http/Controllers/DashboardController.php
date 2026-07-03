<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $patientsCount = Patient::count();
        $appointmentsCount = Appointment::count();

        $todayAppointments = Appointment::whereDate('date', today())->get();

        return view('dashboard', compact(
            'patientsCount',
            'appointmentsCount',
            'todayAppointments'
        ));
    }
}

