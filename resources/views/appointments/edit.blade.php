<x-app-layout>
    <style>
        .form-container { max-width: 620px; margin: 0 auto; }
        .card-custom { background: #fff; border: 1px solid #f1f5f9; border-radius: 20px; box-shadow: 0 10px 25px -5px rgba(0,0,0,.03); padding: 2rem; }
        .card-custom h2 { color: #0f172a; font-size: 1.35rem; font-weight: 800; margin: 0 0 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9; }
        .form-group { margin-bottom: 1.15rem; }
        .form-label { display: block; color: #475569; font-size: .9rem; font-weight: 700; margin-bottom: .45rem; }
        .form-control, .form-select { width: 100%; border: 1px solid #e2e8f0; border-radius: 11px; padding: .75rem 1rem; color: #334155; background: #f8fafc; }
        .form-control:focus, .form-select:focus { outline: 2px solid #c7d2fe; border-color: #818cf8; background: #fff; }
        .form-actions { display: flex; justify-content: space-between; align-items: center; margin-top: 1.75rem; padding-top: 1rem; border-top: 1px solid #f1f5f9; }
        .btn { border: 0; border-radius: 11px; padding: .75rem 1.25rem; font-weight: 700; text-decoration: none; cursor: pointer; }
        .btn-primary { color: #fff; background: #4f46e5; }
        .btn-secondary { color: #64748b; background: #f1f5f9; }
    </style>
    <div class="form-container">
        <div class="card-custom">
            <h2><i class="fa-solid fa-pen-to-square" style="color:#4f46e5;"></i> تعديل الموعد</h2>
            @if(session('error'))
                <div style="background:#fee2e2;color:#991b1b;border-radius:10px;padding:.8rem;margin-bottom:1rem;font-weight:600;">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                @csrf
                @method('PUT')
                <div class="form-group"><label class="form-label">Patient</label><select name="patient_id" class="form-select" required>@foreach($patients as $patient)<option value="{{ $patient->id }}" @selected(old('patient_id', $appointment->patient_id) == $patient->id)>{{ $patient->name }}</option>@endforeach</select></div>
                <div class="form-group"><label class="form-label">Date</label><input type="date" name="date" class="form-control" value="{{ old('date', $appointment->date?->format('Y-m-d')) }}" min="{{ today()->format('Y-m-d') }}" required></div>
                <div class="form-group"><label class="form-label">Time</label><input type="time" name="time" class="form-control" value="{{ old('time', $appointment->time) }}" required></div>
                <div class="form-group"><label class="form-label">Status</label><select name="status" class="form-select" required>@foreach(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled', 'no_show' => 'No Show'] as $value => $label)<option value="{{ $value }}" @selected(old('status', $appointment->status) === $value)>{{ $label }}</option>@endforeach</select></div>
                <div class="form-group"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="4">{{ old('notes', $appointment->notes) }}</textarea></div>
                <div class="form-actions"><a href="{{ route('appointments.index') }}" class="btn btn-secondary">رجوع</a><button type="submit" class="btn btn-primary">حفظ التعديلات</button></div>
            </form>
        </div>
    </div>
</x-app-layout>
