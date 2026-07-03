<!DOCTYPE html>
<html>
<head>
    <title>Prescription</title>

    <style>
        body {
            font-family: DejaVu Sans;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #0d6efd;
        }

        .box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 20px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>

<h1>Clinic Prescription</h1>

<div class="box">
    <p><span class="label">Patient:</span> {{ $prescription->patient->name }}</p>
    <p><span class="label">Phone:</span> {{ $prescription->patient->phone }}</p>
</div>

<div class="box">
    <p class="label">Medications:</p>
    <p>{{ $prescription->medications }}</p>
</div>

<div class="box">
    <p class="label">Notes:</p>
    <p>{{ $prescription->notes }}</p>
</div>

</body>
</html>
