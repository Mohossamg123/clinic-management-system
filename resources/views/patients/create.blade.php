<x-app-layout>
    <div class="container mt-4">

        <h2>Add Patient</h2>

        <form method="POST" action="{{ route('patients.store') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Age</label>
                <input type="number" name="age" class="form-control">
            </div>

            <div class="mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Save</button>
        </form>

    </div>
</x-app-layout>
