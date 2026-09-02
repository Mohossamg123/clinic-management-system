<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Prescription</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            padding: 20px;
            color: #1e293b;
        }

        .header {
            border-bottom: 2px solid #6c5ce7;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .clinic-title {
            font-size: 22px;
            font-weight: bold;
            color: #6c5ce7;
            margin: 0;
        }

        .patient-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-row {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
            color: #475569;
        }

        .section-header {
            font-size: 15px;
            font-weight: bold;
            color: #0f172a;
            border-left: 4px solid #0984e3;
            padding-left: 10px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .box-content {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            line-height: 1.6;
            color: #334155;
            min-height: 50px;
        }

        /* تحسين عرض النصوص العربية داخل DomPDF */
        .arabic-text {
            direction: rtl;
            text-align: right;
            display: block;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="clinic-title">CLINIC PRESCRIPTION</h1>
    </div>

    <div class="patient-box">
        <div class="info-row">
            <span class="label">Patient Name:</span>
            <span class="arabic-text">{{ $prescription->patient->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Phone:</span> {{ $prescription->patient->phone }}
        </div>
        <div class="info-row">
            <span class="label">Date:</span> {{ date('Y-m-d') }}
        </div>
    </div>

    <div class="section-header">Medications (Rx)</div>
    <div class="box-content arabic-text">
        {!! nl2br(e($prescription->medications)) !!}
    </div>

    @if($prescription->notes)
        <div class="section-header">Notes & Instructions</div>
        <div class="box-content arabic-text">
            {!! nl2br(e($prescription->notes)) !!}
        </div>
    @endif

</body>
</html>
