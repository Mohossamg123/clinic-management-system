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

        .table-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
        }

        .search-panel {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 1.25rem;
            padding: 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
        }

        .search-input {
            flex: 1;
            min-width: 0;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 14px;
            color: #1e293b;
            background: #ffffff;
        }

        .search-input:focus { outline: 2px solid #c7d2fe; border-color: #818cf8; }

        .btn-search, .btn-clear {
            border: 0;
            border-radius: 10px;
            padding: 10px 15px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-search { background: #4f46e5; color: white; }
        .btn-clear { background: #e2e8f0; color: #475569; }

        .count-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border-radius: 999px;
            padding: 5px 9px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 0.78rem;
            font-weight: 700;
            white-space: nowrap;
        }

        @media (max-width: 700px) {
            .header-actions { align-items: flex-start; flex-direction: column; gap: 1rem; }
            .search-panel { align-items: stretch; flex-wrap: wrap; }
            .search-input { flex-basis: 100%; }
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

        .action-btns {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-action-view {
            background: #e0f2fe;
            color: #0284c7;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-action-view:hover { background: #bae6fd; }

        .btn-action-edit {
            background: #fef3c7;
            color: #d97706;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-action-edit:hover { background: #fde68a; }

        .btn-action-delete {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-action-delete:hover { background: #fca5a5; }
    </style>

    <div class="page-container">

        <div class="header-actions">
            <div>
                <h2>المرضى - Patients</h2>
                <p style="color: #64748b; margin-top: 0.25rem;">سجل بيانات المرضى في العيادة</p>
            </div>
            <a href="{{ route('patients.create') }}" class="btn-add">
                <i class="fa-solid fa-user-plus"></i> إضافة مريض
            </a>
        </div>

        @if(session('success'))
            <div class="alert-custom-success">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('patients.index') }}" class="search-panel">
            <i class="fa-solid fa-magnifying-glass" style="color: #64748b;"></i>
            <input type="search" name="q" value="{{ $search }}" class="search-input" placeholder="Search by patient name or phone..." aria-label="Search patients">
            <button type="submit" class="btn-search"><i class="fa-solid fa-search me-1"></i> Search</button>
            @if($search)
                <a href="{{ route('patients.index') }}" class="btn-clear"><i class="fa-solid fa-xmark me-1"></i> Clear</a>
            @endif
        </form>

        <div class="table-card">
            <div style="overflow-x: auto;">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Age</th>
                            <th>Activity</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2" style="color: #6c5ce7;"></i>
                                    {{ $patient->name }}
                                </td>
                                <td>
                                    <i class="fa-solid fa-phone me-1" style="color: #94a3b8;"></i>
                                    {{ $patient->phone }}
                                </td>
                                <td>
                                    <span style="background: #e2e8f0; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">
                                        {{ $patient->age ? $patient->age . ' سنة' : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="count-badge"><i class="fa-solid fa-calendar-check"></i> {{ $patient->appointments_count }}</span>
                                    <span class="count-badge"><i class="fa-solid fa-file-prescription"></i> {{ $patient->prescriptions_count }}</span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('patients.show', $patient->id) }}" class="btn-action-view">
                                            <i class="fa-solid fa-eye me-1"></i> View
                                        </a>

                                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn-action-edit">
                                            <i class="fa-solid fa-pen me-1"></i> Edit
                                        </a>

                                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت تأكد من حذف المريض؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">
                                                <i class="fa-solid fa-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #94a3b8; padding: 2rem;">
                                    {{ $search ? 'لا توجد نتائج مطابقة للبحث.' : 'لا يوجد مرضى مسجلين حالياً' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
