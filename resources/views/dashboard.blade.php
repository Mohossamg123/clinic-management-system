<x-app-layout>
    <style>
        .dashboard-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .welcome-section {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-section h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0f172a;
        }

        .welcome-section p {
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 0.4rem;
        }

        .date-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            background: #f1f5f9;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        /* Quick Action Buttons */
        .quick-actions {
            display: flex;
            gap: 12px;
        }

        .welcome-tools {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-action {
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #6c5ce7, #0984e3);
            color: white;
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.25);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(108, 92, 231, 0.35);
        }

        .btn-secondary-custom {
            background: #ffffff;
            color: #334155;
            border: 1px solid #e2e8f0;
        }

        .btn-secondary-custom:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Metric Cards Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .metric-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px -10px rgba(108, 92, 231, 0.12);
        }

        .metric-info p {
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
        }

        .metric-info h3 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #0f172a;
        }

        .icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .patients-icon { background: #f3f0ff; color: #6c5ce7; }
        .appointments-icon { background: #e0f2fe; color: #0284c7; }
        .prescriptions-icon { background: #dcfce7; color: #16a34a; }
        .today-icon { background: #fff7ed; color: #ea580c; }

        .metric-note {
            color: #94a3b8;
            font-size: 0.78rem;
            font-weight: 600;
            margin-top: 0.3rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.45fr) minmax(300px, 0.85fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Appointments Table Container */
        .appointments-section {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.75rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
        }

        .section-title i { color: #6c5ce7; }

        .section-link {
            color: #6c5ce7;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
        }

        .section-link:hover { color: #4338ca; }

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

        .time-badge {
            background: #ffffff;
            color: #0284c7;
            border: 1px solid #e0f2fe;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: #94a3b8;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: 0.75rem;
            font-weight: 700;
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.pending, .status-select.status-pending { background: #fef3c7; color: #92400e; }
        .status-badge.confirmed, .status-select.status-confirmed { background: #dcfce7; color: #166534; }
        .status-badge.completed, .status-select.status-completed { background: #dbeafe; color: #1d4ed8; }
        .status-badge.cancelled, .status-select.status-cancelled { background: #fee2e2; color: #991b1b; }

        .status-form { margin: 0; }

        .status-select {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #ffffff;
            color: #334155;
            padding: 7px 28px 7px 10px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
        }

        .status-select:focus { outline: 2px solid #c7d2fe; border-color: #818cf8; }

        .list-section {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
        }

        .activity-list { display: grid; gap: 12px; }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 12px;
            background: #f8fafc;
        }

        .activity-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: #eef2ff;
            color: #6366f1;
        }

        .activity-copy { min-width: 0; }
        .activity-copy strong, .activity-copy small { display: block; }
        .activity-copy strong { color: #1e293b; font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .activity-copy small { color: #94a3b8; margin-top: 3px; }

        @media (max-width: 900px) {
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 700px) {
            .welcome-section { align-items: flex-start; flex-direction: column; gap: 1rem; }
            .welcome-tools { align-items: flex-start; flex-direction: column; }
            .quick-actions { flex-wrap: wrap; }
            .btn-action { flex: 1; justify-content: center; }
            .date-chip { align-self: flex-start; }
        }
    </style>

    <div class="dashboard-container">

        <!-- Welcome & Quick Actions -->
        <div class="welcome-section">
            <div>
                <h2>Dashboard Overview</h2>
                <p>مرحباً بك دكتور، إليك ملخص نشاط العيادة اليوم</p>
            </div>
            <div class="welcome-tools">
                <div class="date-chip">
                    <i class="fa-regular fa-calendar"></i>
                    {{ now()->translatedFormat('l، d F Y') }}
                </div>
                <div class="quick-actions">
                    <a href="{{ route('prescriptions.create') }}" class="btn-action btn-primary-custom">
                        <i class="fa-solid fa-plus"></i>
                        <span>إضافة روشتة جديدة</span>
                    </a>
                    <a href="{{ route('prescriptions.index') }}" class="btn-action btn-secondary-custom">
                        <i class="fa-solid fa-file-prescription"></i>
                        <span>عرض الروشتات</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="stats-grid">
            <div class="metric-card">
                <div class="metric-info">
                    <p>Patients</p>
                    <h3>{{ $patientsCount }}</h3>
                </div>
                <div class="icon-wrapper patients-icon">
                    <i class="fa-solid fa-users-medical"></i>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-info">
                    <p>Appointments</p>
                    <h3>{{ $appointmentsCount }}</h3>
                </div>
                <div class="icon-wrapper appointments-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-info">
                    <p>Prescriptions</p>
                    <h3>{{ $prescriptionsCount }}</h3>
                    <div class="metric-note">إجمالي الروشتات</div>
                </div>
                <div class="icon-wrapper prescriptions-icon">
                    <i class="fa-solid fa-file-prescription"></i>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-info">
                    <p>Today</p>
                    <h3>{{ $todayAppointmentsCount }}</h3>
                    <div class="metric-note">مواعيد اليوم</div>
                </div>
                <div class="icon-wrapper today-icon">
                    <i class="fa-solid fa-stethoscope"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <!-- Upcoming Appointments Table -->
            <div class="appointments-section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Upcoming Appointments</span>
                </div>
                <a href="{{ route('appointments.index') }}" class="section-link">View all</a>
            </div>

            <div style="overflow-x: auto;">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingAppointments as $appointment)
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2" style="color: #94a3b8;"></i>
                                    {{ $appointment->patient?->name ?? 'Unknown patient' }}
                                </td>
                                <td>
                                    {{ $appointment->date->format('d M Y') }}
                                </td>
                                <td>
                                    <span class="time-badge">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $appointment->time }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('appointments.status', $appointment) }}" class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="status-select status-{{ $appointment->status }}" onchange="this.className = 'status-select status-' + this.value; this.form.submit()" aria-label="Update appointment status">
                                            @foreach($appointmentStatuses as $value => $label)
                                                <option value="{{ $value }}" @selected($appointment->status === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fa-regular fa-calendar-xmark" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                                        <p>لا توجد مواعيد محجوزة لهذا اليوم</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>

            <div class="list-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>Clinic Snapshot</span>
                    </div>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fa-solid fa-user-plus"></i></div>
                        <div class="activity-copy"><strong>{{ $newPatientsThisMonth }} new patients</strong><small>Added this month</small></div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                        <div class="activity-copy"><strong>{{ $pendingAppointmentsCount }} pending appointments</strong><small>Need your attention</small></div>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="btn-action btn-primary-custom" style="justify-content: center; margin-top: 4px;">
                        <i class="fa-solid fa-calendar-plus"></i><span>Book appointment</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="list-section">
                <div class="section-header">
                    <div class="section-title"><i class="fa-solid fa-user-group"></i><span>Recent Patients</span></div>
                    <a href="{{ route('patients.index') }}" class="section-link">View all</a>
                </div>
                <div class="activity-list">
                    @forelse($recentPatients as $patient)
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fa-solid fa-user"></i></div>
                            <div class="activity-copy"><strong>{{ $patient->name }}</strong><small>{{ $patient->phone }} · {{ $patient->created_at->diffForHumans() }}</small></div>
                        </div>
                    @empty
                        <div class="empty-state">No patients added yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="list-section">
                <div class="section-header">
                    <div class="section-title"><i class="fa-solid fa-file-medical"></i><span>Recent Prescriptions</span></div>
                    <a href="{{ route('prescriptions.index') }}" class="section-link">View all</a>
                </div>
                <div class="activity-list">
                    @forelse($recentPrescriptions as $prescription)
                        <div class="activity-item">
                            <div class="activity-icon"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
                            <div class="activity-copy"><strong>{{ $prescription->patient?->name ?? 'Unknown patient' }}</strong><small>{{ $prescription->created_at->diffForHumans() }}</small></div>
                        </div>
                    @empty
                        <div class="empty-state">No prescriptions added yet.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
