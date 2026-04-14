@extends('layouts.admin')

@section('content')
<style>
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 20px;
    }

    .calendar-header h2 {
        margin: 0;
        color: #333;
    }

    .calendar-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .calendar-actions select,
    .calendar-actions button {
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: white;
        font-size: 14px;
        color: #333;
    }

    .calendar-actions button {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        cursor: pointer;
    }

    .calendar-actions button:hover {
        background: #2563eb;
        border-color: #2563eb;
    }

    .calendar-actions label {
        display: flex;
        flex-direction: column;
        gap: 6px;
        font-size: 13px;
        color: #374151;
    }

    .calendar-actions label select {
        min-width: 160px;
    }

    .calendar-actions button {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        cursor: pointer;
    }

    .calendar-actions button:hover {
        background: #2563eb;
        border-color: #2563eb;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-top: 30px;
    }

    .calendar-panel,
    .calendar-sidebar {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        padding: 25px;
        border: 1px solid #e5e7eb;
    }

    .calendar-panel h3,
    .calendar-sidebar h3 {
        margin-top: 0;
        margin-bottom: 16px;
        color: #111827;
    }

    .appointment-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 14px;
        transition: box-shadow 0.2s ease;
        background: #fafafa;
    }

    .appointment-card:hover {
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
    }

    .appointment-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 15px;
        flex-wrap: wrap;
    }

    .appointment-row strong {
        color: #111827;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }

    .status-pending { background: #fef3c7; color: #92400e; }
    .status-confirmed { background: #dbeafe; color: #1d4ed8; }
    .status-completed { background: #d1fae5; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }
    .status-expired { background: #e5e7eb; color: #374151; }

    .empty-state {
        text-align: center;
        color: #6b7280;
        padding: 40px 20px;
    }

    @media (max-width: 920px) {
        .calendar-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="calendar-header">
    <div>
        <h2>📅 Admin Calendar</h2>
        <p style="color: #6b7280; margin: 6px 0 0;">Filter appointments by doctor and status.</p>
    </div>
    <div class="calendar-actions">
        <form method="GET" action="{{ route('admin.calendar') }}" style="display:flex; flex-wrap:wrap; gap:10px; align-items:center;">
            <label>
                Doctor
                <select name="doctor_id">
                    <option value="">All Doctors</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Status
                <select name="status">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </label>

            <button type="submit">Apply Filters</button>
        </form>
    </div>
</div>

<div class="calendar-grid">
    <div class="calendar-panel">
        <h3>Upcoming Appointments</h3>

        @if($appointments->isEmpty())
            <div class="empty-state">
                <p>No appointments are available yet.</p>
            </div>
        @else
            @foreach($appointments->sortBy('appointment_date')->take(20) as $appointment)
                @php
                    $appointmentDateTime = \Carbon\Carbon::parse($appointment->appointment_date);
                    $status = method_exists($appointment, 'getDisplayStatus') ? $appointment->getDisplayStatus() : ($appointment->status ?? 'pending');
                @endphp
                <div class="appointment-card">
                    <div class="appointment-row">
                        <div>
                            <strong>{{ $appointment->patient->name ?? 'Unknown Patient' }}</strong>
                            <div style="color: #6b7280; margin-top: 5px;">Dr. {{ $appointment->doctor->name ?? 'Unknown Doctor' }}</div>
                        </div>
                        <div style="text-align: right; color: #374151;">
                            <div>{{ $appointmentDateTime->format('d M Y') }}</div>
                            <div style="margin-top: 4px; font-weight: 600;">{{ $appointmentDateTime->format('h:i A') }}</div>
                        </div>
                    </div>
                    <div class="status-badge status-{{ $status }}">
                        {{ ucfirst($status) }}
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="calendar-sidebar">
        <h3>Summary</h3>
        <p style="color: #6b7280; line-height: 1.7;">This page shows the current appointment load. The calendar feature is enabled by backend event data and can be enhanced with a full calendar UI later.</p>

        <div style="margin-top: 20px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <span>Pending</span> <strong>{{ $appointments->where('status', 'pending')->count() }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <span>Confirmed</span> <strong>{{ $appointments->where('status', 'confirmed')->count() }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <span>Completed</span> <strong>{{ $appointments->where('status', 'completed')->count() }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <span>Cancelled</span> <strong>{{ $appointments->where('status', 'cancelled')->count() }}</strong>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <h3>Doctors</h3>
            @if($doctors->isEmpty())
                <p style="color: #6b7280;">No doctors registered yet.</p>
            @else
                <ul style="list-style:none; padding:0; margin:0; color:#374151;">
                    @foreach($doctors as $doctor)
                        <li style="margin-bottom: 10px;">
                            <strong>{{ $doctor->name }}</strong><br>
                            <span style="color:#6b7280; font-size: 13px;">{{ $doctor->specialization ?? 'General' }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
