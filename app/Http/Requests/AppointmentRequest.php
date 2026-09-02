<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $appointmentId = $this->route('appointment')?->id;

        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'status' => ['nullable', 'in:pending,confirmed,completed,cancelled,no_show'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function appointmentData(): array
    {
        return [
            'patient_id' => $this->integer('patient_id'),
            'date' => $this->date('date')->format('Y-m-d'),
            'time' => $this->input('time'),
            'status' => $this->input('status', 'pending'),
            'notes' => $this->input('notes'),
        ];
    }
}
