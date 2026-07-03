<x-app-layout>
<div class="container mt-4">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-3 bg-primary text-white">
                <h4>Patients</h4>
                <h2>{{ $patientsCount }}</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3 bg-success text-white">
                <h4>Appointments</h4>
                <h2>{{ $appointmentsCount }}</h2>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4>Today's Appointments</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Time</th>
                </tr>
            </thead>

            <tbody>
                @foreach($todayAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</x-app-layout>
