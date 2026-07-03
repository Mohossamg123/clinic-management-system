<x-app-layout>
<div class="container mt-4">

<h2>Prescriptions</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Patient</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->patient->name }}</td>
                <td>
                    <a href="/prescriptions/{{ $prescription->id }}/pdf" class="btn btn-success">
                        Download PDF
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
</x-app-layout>
