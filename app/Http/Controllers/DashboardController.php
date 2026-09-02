<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index()
    {
            $patientsCount = Patient::count();
        $appointmentsCount = Appointment::count();
        $prescriptionsCount = Prescription::count();
            $todayAppointmentsCount = Appointment::whereDate('date', today())->count();
            $pendingAppointmentsCount = Appointment::where('status', 'pending')->count();
            $newPatientsThisMonth = Patient::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();

        $todayAppointments = Appointment::with('patient')
            ->whereDate('date', today())
            ->orderBy('time', 'asc')
            ->get();

        $upcomingAppointments = Appointment::with('patient')
            ->whereDate('date', '>=', today())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->limit(5)
            ->get();

        $recentPatients = Patient::latest()->limit(5)->get();
        $recentPrescriptions = Prescription::with('patient')->latest()->limit(5)->get();
        $appointmentStatuses = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        return view('dashboard', compact(
            'patientsCount',
            'appointmentsCount',
            'prescriptionsCount',
                'todayAppointmentsCount',
                'pendingAppointmentsCount',
                'newPatientsThisMonth',
                'todayAppointments',
                'upcomingAppointments',
                'recentPatients',
                'recentPrescriptions',
                'appointmentStatuses'
        ));
            }


}
