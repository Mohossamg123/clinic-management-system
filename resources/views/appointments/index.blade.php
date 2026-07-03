<x-app-layout>
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Appointments</h2>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">+ Add Appointment</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ $appointment->time }}</td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            {{ $appointment->status }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
</x-app-layout>
