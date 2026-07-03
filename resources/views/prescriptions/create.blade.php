<x-app-layout>
<div class="container mt-5" style="max-width:600px;">

    <div class="card shadow-lg p-4" style="border-radius:20px;">

        <h2 class="text-center mb-4" style="font-weight:bold; color:#0d6efd;">
            💊 Add Prescription
        </h2>

        <!-- Success -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('prescriptions.store') }}">
            @csrf

            <!-- Patient -->
            <div class="mb-3">
                <label class="form-label fw-bold">👤 Select Patient</label>
                <select name="patient_id" class="form-control">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">
                            {{ $patient->name }} ({{ $patient->phone }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Medications -->
            <div class="mb-3">
                <label class="form-label fw-bold">💊 Medications</label>
                <textarea name="medications" class="form-control" rows="4" placeholder="Write medications..."></textarea>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label class="form-label fw-bold">📝 Notes</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes..."></textarea>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="/dashboard" class="btn btn-outline-secondary">
                    ⬅ Back
                </a>

                <button class="btn btn-primary px-4">
                    💾 Save Prescription
                </button>
            </div>

        </form>

    </div>

</div>
</x-app-layout>
