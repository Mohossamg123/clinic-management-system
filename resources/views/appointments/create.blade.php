<x-app-layout>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .card-custom {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
            padding: 2rem;
        }

        .card-header-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-header-title i {
            width: 45px;
            height: 45px;
            background: #e0f2fe;
            color: #0284c7;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .card-header-title h3 {
            font-size: 1.3rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label-custom {
            display: block;
            font-weight: 700;
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .form-control-custom, .form-select-custom {
            width: 100%;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: #334155;
            background-color: #f8fafc;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control-custom:focus, .form-select-custom:focus {
            border-color: #0984e3;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(9, 132, 227, 0.1);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .btn-submit {
            background: linear-gradient(135deg, #6c5ce7, #0984e3);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.75rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.25);
            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(108, 92, 231, 0.35);
        }

        .btn-cancel {
            color: #64748b;
            text-decoration: none;
            font-weight: 700;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background: #f1f5f9;
        }
    </style>

    <div class="form-container">
        <div class="card-custom">

            <div class="card-header-title">
                <i class="fa-solid fa-calendar-plus"></i>
                <h3>إضافة موعد جديد</h3>
            </div>

            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf

                <!-- Patient -->
                <div class="form-group">
                    <label class="form-label-custom">
                        <i class="fa-solid fa-user me-1" style="color: #0984e3;"></i> اختر المريض
                    </label>
                    <select name="patient_id" class="form-select-custom" required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div class="form-group">
                    <label class="form-label-custom">
                        <i class="fa-solid fa-calendar-day me-1" style="color: #0984e3;"></i> تاريخ الموعد
                    </label>
                    <input type="date" name="date" class="form-control-custom" required>
                </div>

                <!-- Time -->
                <div class="form-group">
                    <label class="form-label-custom">
                        <i class="fa-solid fa-clock me-1" style="color: #0984e3;"></i> وقت الموعد
                    </label>
                    <input type="time" name="time" class="form-control-custom" required>
                </div>

                <!-- Buttons -->
                <div class="form-actions">
                    <a href="{{ route('appointments.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-arrow-left me-1"></i> إلغاء ورجوع
                    </a>

                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk me-1"></i> حفظ الموعد
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
