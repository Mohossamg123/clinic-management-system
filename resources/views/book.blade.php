<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        .card {
            border-radius: 15px;
        }

        h2 {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container mt-5" style="max-width:500px;">

    <div class="card shadow p-4">

        <h2 class="text-center mb-4">Book Appointment</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- ❗ عرض أخطاء validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/book">
            @csrf

            <input type="text" name="name" class="form-control mb-3" placeholder="Your Name" required>

            <input type="text" name="phone" class="form-control mb-3" placeholder="Phone" required>

            <!-- مهم جدًا: id -->
            <input type="date" name="date" id="date" class="form-control mb-3" required>

            <!-- مهم جدًا: value="" -->
            <select name="time" id="time" class="form-control mb-3" required>
                <option value="">Select date first</option>
            </select>

            <button class="btn btn-primary w-100">Book Now</button>
        </form>

    </div>

</div>

<script>
let dateInput = document.getElementById('date');
let timeSelect = document.getElementById('time');

// Disable في الأول
timeSelect.disabled = true;

dateInput.addEventListener('change', function () {

    let date = this.value;

    timeSelect.disabled = false;

    fetch(`/available-times?date=${date}`)
        .then(response => response.json())
        .then(data => {

            timeSelect.innerHTML = '';

            if (data.length === 0) {
                timeSelect.innerHTML = '<option value="">No available times</option>';
                return;
            }

            data.forEach(time => {
                timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
            });

        });

});
</script>

</body>
</html>
