<x-app-layout>
<div class="container mt-4">

<h2>Add Appointment</h2>

<form method="POST" action="{{ route('appointments.store') }}">
    @csrf

    <div class="mb-3">
        <label>Patient</label>
        <select name="patient_id" class="form-control">
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="date" class="form-control">
    </div>

    <div class="mb-3">
        <label>Time</label>
        <input type="time" name="time" class="form-control">
    </div>

    <button class="btn btn-success">Save</button>

</form>

</div>
</x-app-layout>
