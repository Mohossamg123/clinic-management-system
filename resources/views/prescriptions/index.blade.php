<x-app-layout>
    <style>
        .page-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-actions h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .btn-add {
            background: linear-gradient(135deg, #6c5ce7, #0984e3);
            color: white;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.25);
            transition: all 0.2s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(108, 92, 231, 0.35);
        }

        .table-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .modern-table th {
            color: #64748b;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            padding: 12px 20px;
            text-align: left;
        }

        .modern-table td {
            background: #f8fafc;
            padding: 16px 20px;
            color: #334155;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .modern-table td:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
        .modern-table td:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }

        .btn-download-pdf {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-download-pdf:hover {
            background: #16a34a;
            color: white;
        }
    </style>

    <div class="page-container">
        <div class="header-actions">
            <div>
                <h2>Prescriptions</h2>
                <p style="color: #64748b; margin-top: 0.25rem;">إدارة وسجل الروشتات الطبية للمرضى</p>
            </div>
            <a href="{{ route('prescriptions.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> إضافة روشتة
            </a>
        </div>

        <div class="table-card">
            <div style="overflow-x: auto;">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prescriptions as $prescription)
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2" style="color: #94a3b8;"></i>
                                    {{ $prescription->patient->name }}
                                </td>
                                <td style="text-align: right;">
                                    <a href="/prescriptions/{{ $prescription->id }}/pdf" class="btn-download-pdf">
                                        <i class="fa-solid fa-file-pdf"></i> Download PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="text-align: center; color: #94a3b8; padding: 2rem;">
                                    لا توجد روشتات مسجلة حالياً
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
