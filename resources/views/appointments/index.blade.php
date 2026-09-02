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

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            background: #fef3c7;
            color: #b45309;
        }

        .status-badge.pending { background: #fef3c7; color: #92400e; }
        .status-badge.confirmed { background: #dcfce7; color: #166534; }
        .status-badge.completed { background: #dbeafe; color: #1d4ed8; }
        .status-badge.cancelled { background: #fee2e2; color: #991b1b; }
        .status-badge.no_show { background: #f3e8ff; color: #7e22ce; }

        .row-actions { display: flex; align-items: center; gap: 6px; }
        .row-actions a, .row-actions button { border: 0; border-radius: 8px; padding: 6px 9px; font-size: .8rem; font-weight: 700; text-decoration: none; cursor: pointer; }
        .btn-view { background: #e0f2fe; color: #0369a1; }
        .btn-edit { background: #fef3c7; color: #a16207; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }
    </style>

    <div class="page-container">

        <div class="header-actions">
            <div>
                <h2>المواعيد - Appointments</h2>
                <p style="color: #64748b; margin-top: 0.25rem;">إدارة جدول الحجوزات والمواعيد</p>
            </div>
            <a href="{{ route('appointments.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> إضافة موعد
            </a>
        </div>

        @if(session('success'))
            <div class="alert-custom-success">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-custom-danger">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="table-card">
            <div style="overflow-x: auto;">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2" style="color: #94a3b8;"></i>
                                    {{ $appointment->patient->name }}
                                </td>
                                <td>
                                    <i class="fa-regular fa-calendar me-2" style="color: #0984e3;"></i>
                                    {{ $appointment->date }}
                                </td>
                                <td>
                                    <i class="fa-regular fa-clock me-2" style="color: #6c5ce7;"></i>
                                    {{ $appointment->time }}
                                </td>
                                <td>
                                    <span class="status-badge {{ strtolower($appointment->status ?? 'pending') }}">
                                        <i class="fa-solid fa-circle me-1" style="font-size: 8px;"></i>
                                        {{ ucwords(str_replace('_', ' ', $appointment->status ?? 'pending')) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('appointments.show', $appointment) }}" class="btn-view" title="View appointment"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn-edit" title="Edit appointment"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف الموعد؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Delete appointment"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #94a3b8; padding: 2rem;">
                                    لا توجد مواعيد مسجلة حالياً
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
