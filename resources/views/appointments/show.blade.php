<x-app-layout>
    <style>
        .details-container { max-width: 760px; margin: 0 auto; }
        .card-custom { background: #fff; border: 1px solid #f1f5f9; border-radius: 20px; box-shadow: 0 10px 25px -5px rgba(0,0,0,.03); padding: 2rem; }
        .header { display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; padding-bottom:1.25rem; border-bottom:1px solid #f1f5f9; margin-bottom:1.25rem; }
        .header h2 { margin:0; color:#0f172a; font-size:1.45rem; font-weight:800; }
        .header p { margin:.35rem 0 0; color:#64748b; }
        .status { border-radius:999px; padding:7px 12px; font-size:.8rem; font-weight:700; }
        .status.pending { background:#fef3c7; color:#92400e; } .status.confirmed { background:#dcfce7; color:#166534; } .status.completed { background:#dbeafe; color:#1d4ed8; } .status.cancelled { background:#fee2e2; color:#991b1b; } .status.no_show { background:#f3e8ff; color:#7e22ce; }
        .details-grid { display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem; }
        .detail { background:#f8fafc; border:1px solid #e2e8f0; border-radius:13px; padding:1rem; }
        .detail small { display:block; color:#64748b; font-weight:700; margin-bottom:.35rem; } .detail strong { color:#1e293b; }
        .notes { margin-top:1rem; padding:1rem; background:#f8fafc; border-radius:13px; color:#334155; line-height:1.6; }
        .actions { display:flex; justify-content:space-between; margin-top:1.5rem; padding-top:1rem; border-top:1px solid #f1f5f9; }
        .btn { border-radius:10px; padding:.7rem 1rem; text-decoration:none; font-weight:700; } .btn-back { color:#64748b; background:#f1f5f9; } .btn-edit { color:#fff; background:#4f46e5; }
        @media(max-width:600px) { .header, .actions { flex-direction:column; } .details-grid { grid-template-columns:1fr; } }
    </style>
    <div class="details-container">
        <div class="card-custom">
            <div class="header">
                <div><h2>Appointment Details</h2><p>{{ $appointment->patient?->name ?? 'Unknown patient' }}</p></div>
                <span class="status {{ $appointment->status }}">{{ ucwords(str_replace('_', ' ', $appointment->status)) }}</span>
            </div>
            <div class="details-grid">
                <div class="detail"><small><i class="fa-solid fa-user"></i> Patient</small><strong>{{ $appointment->patient?->name ?? 'Unknown patient' }}</strong></div>
                <div class="detail"><small><i class="fa-solid fa-phone"></i> Phone</small><strong>{{ $appointment->patient?->phone ?? '-' }}</strong></div>
                <div class="detail"><small><i class="fa-regular fa-calendar"></i> Date</small><strong>{{ $appointment->date?->format('d M Y') }}</strong></div>
                <div class="detail"><small><i class="fa-regular fa-clock"></i> Time</small><strong>{{ $appointment->time }}</strong></div>
                <div class="detail"><small>Created</small><strong>{{ $appointment->created_at->format('d M Y, H:i') }}</strong></div>
            </div>
            @if($appointment->notes)
                <div class="notes"><strong>Notes</strong><br>{{ $appointment->notes }}</div>
            @endif
            <div class="actions">
                <a href="{{ route('appointments.index') }}" class="btn btn-back">رجوع</a>
                <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-edit"><i class="fa-solid fa-pen"></i> تعديل الموعد</a>
            </div>
        </div>
    </div>
</x-app-layout>
