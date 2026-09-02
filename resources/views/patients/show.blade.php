<x-app-layout>
    <style>
        .details-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .card-custom {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
            padding: 2rem;
        }

        .patient-profile-header {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .patient-avatar {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #6c5ce7, #0984e3);
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
        }

        .patient-info-main h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .patient-info-main p {
            color: #64748b;
            margin: 0;
            font-size: 0.9rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-card {
            background: #f8fafc;
            border-radius: 14px;
            padding: 1rem;
            border: 1px solid #e2e8f0;
        }

        .info-card-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-card-value {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1e293b;
        }

        .notes-box {
            background: #f8fafc;
            border-radius: 14px;
            padding: 1.25rem;
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
        }

        .notes-box h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin: 0 0 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .notes-box p {
            color: #334155;
            line-height: 1.6;
            margin: 0;
            font-size: 0.95rem;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .btn-back {
            color: #64748b;
            text-decoration: none;
            font-weight: 700;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            transition: background 0.2s;
        }

        .btn-back:hover { background: #f1f5f9; }

        .btn-edit-main {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.25);
            transition: all 0.2s ease;
        }

        .btn-edit-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(217, 119, 6, 0.35);
        }
    </style>

    <div class="details-container">
        <div class="card-custom">

            <div class="patient-profile-header">
                <div class="patient-avatar">
                    {{ mb_substr($patient->name, 0, 1, 'UTF-8') }}
                </div>
                <div class="patient-info-main">
                    <h2>{{ $patient->name }}</h2>
                    <p>ملف المريض الشخصي</p>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-label">
                        <i class="fa-solid fa-phone" style="color: #0984e3;"></i> رقم الهاتف
                    </div>
                    <div class="info-card-value">{{ $patient->phone }}</div>
                </div>

                <div class="info-card">
                    <div class="info-card-label">
                        <i class="fa-solid fa-cake-candles" style="color: #6c5ce7;"></i> العمر
                    </div>
                    <div class="info-card-value">{{ $patient->age ? $patient->age . ' سنة' : 'غير محدد' }}</div>
                </div>
            </div>

            <div class="notes-box">
                <h4><i class="fa-solid fa-clipboard-list" style="color: #64748b;"></i> ملاحظات خاصة بالمريض</h4>
                <p>{{ $patient->notes ?: 'لا توجد ملاحظات مدونة للمريض حالياً.' }}</p>
            </div>

            <div class="card-actions">
                <a href="{{ route('patients.index') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left me-1"></i> رجوع للقائمة
                </a>

                <a href="{{ route('patients.edit', $patient->id) }}" class="btn-edit-main">
                    <i class="fa-solid fa-pen me-1"></i> تعديل البيانات
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
