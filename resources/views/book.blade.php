<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .booking-card {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 15px 35px rgba(108, 92, 231, 0.08);
            padding: 2.5rem !important;
            border: 1px solid rgba(108, 92, 231, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* تنسيق الحقول */
        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1.5px solid #e9ecef;
            background-color: #fdfdfd;
            transition: all 0.3s ease;
            color: #495057;
        }

        .form-control:focus, .form-select:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.15);
            background-color: #fff;
        }

        /* زر الإرسال المتدرج */
        .btn-booking {
            background: linear-gradient(135deg, #6c5ce7 0%, #0984e3 100%);
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.5px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-booking:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.3);
            color: #ffffff;
        }

        /* التنبيهات */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.9rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>

<div class="container my-5" style="max-width:480px;">

    <div class="card booking-card">

        <div class="form-header">
            <div class="mb-2">
                <i class="fa-regular fa-calendar-check text-primary fs-1" style="color: #6c5ce7 !important;"></i>
            </div>
            <h2>Book Appointment</h2>
            <p>Please fill in the details below to schedule your visit</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-3">
                <i class="fa-solid fa-circle-check me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center mb-3">
                <i class="fa-solid fa-circle-exclamation me-2"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/book">
            @csrf

            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>

            <div class="mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
            </div>

            <div class="mb-3">
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <div class="mb-4">
                <select name="time" id="time" class="form-select" required>
                    <option value="">Select date first</option>
                </select>
            </div>

            <button class="btn btn-booking w-100">
                <i class="fa-solid fa-paper-plane me-1"></i> Book Now
            </button>
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
