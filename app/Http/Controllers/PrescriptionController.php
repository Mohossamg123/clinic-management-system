<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // ✅ مهم جدًا
use App\Models\Prescription;
use App\Models\Patient;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('patient')->latest()->get();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('prescriptions.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'medications' => 'required',
        ]);

        Prescription::create($request->all());

        return redirect()->route('prescriptions.index')->with('success', 'Saved');
    }
}
