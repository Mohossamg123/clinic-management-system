<h1>Edit Patient</h1>

<form method="POST" action="{{ route('patients.update', $patient->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $patient->name }}">
    <input type="text" name="phone" value="{{ $patient->phone }}">
    <input type="number" name="age" value="{{ $patient->age }}">
    <textarea name="notes">{{ $patient->notes }}</textarea>

    <button type="submit">Update</button>
</form>
