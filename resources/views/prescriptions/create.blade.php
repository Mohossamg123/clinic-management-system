<x-app-layout>
    <style>
        .form-container {
            max-width: 680px;
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
            background: #f3f0ff;
            color: #6c5ce7;
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
            border-color: #6c5ce7;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.1);
        }

        .alert-custom-success {
            background: #dcfce7;
            color: #15803d;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .alert-custom-danger {
            background: #fee2e2;
            color: #b91c1c;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
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
                <i class="fa-solid fa-file-prescription"></i>
                <h3>إضافة روشتة جديدة</h3>
            </div>

            @if(session('success'))
                <div class="alert-custom-success">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-custom-danger">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('prescriptions.store') }}">
                @csrf

                <!-- Patient -->
                <div class="form-group">
                    <label class="form-label-custom">
                        <i class="fa-solid fa-user me-1" style="color: #6c5ce7;"></i> اختر المريض
                    </label>
                    <select name="patient_id" class="form-select-custom">
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">
                                {{ $patient->name }} ({{ $patient->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Medications -->
                <div class="form-group">
                    <label class="form-label-custom">
                        <i class="fa-solid fa-pills me-1" style="color: #6c5ce7;"></i> الأدوية والعلاج
                    </label>
                    <textarea name="medications" class="form-control-custom" rows="4" placeholder="اكتب تفاصيل الأدوية والجرعات..."></textarea>
                </div>

                <!-- Notes -->
                <div class="form-group">
                    <label class="form-label-custom">
                        <i class="fa-solid fa-clipboard-list me-1" style="color: #6c5ce7;"></i> ملاحظات إضافية
                    </label>
                    <textarea name="notes" class="form-control-custom" rows="3" placeholder="ملاحظات للتعليمات أو الاستشارات القادمة..."></textarea>
                </div>

                <!-- Buttons -->
                <div class="form-actions">
                    <a href="{{ route('prescriptions.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-arrow-left me-1"></i> إلغاء ورجوع
                    </a>

                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk me-1"></i> حفظ الروشتة
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
