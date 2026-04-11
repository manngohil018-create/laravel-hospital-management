@extends('layouts.admin')

@section('content')
<style>
    .patient-detail-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-section h2 {
        margin: 0;
        color: #333;
        font-size: 28px;
    }

    .header-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateX(-3px);
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-2px);
    }

    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-body {
        padding: 30px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 20px;
    }

    .info-item {
        border-left: 4px solid #667eea;
        padding-left: 15px;
    }

    .info-label {
        font-size: 12px;
        font-weight: 600;
        color: #667eea;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 16px;
        color: #333;
        font-weight: 500;
        word-break: break-word;
        line-height: 1.6;
    }

    .info-value.empty {
        color: #999;
        font-style: italic;
    }

    .badge {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }

    .badge-patient {
        background: #e7f1ff;
        color: #0072ff;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        margin-left: 10px;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #cfe2ff;
        color: #084298;
    }

    .status-completed {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #842029;
    }

    .status-emergency {
        background: #f8d7da;
        color: #842029;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
        }
    }

    .appointment-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .appointment-table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #e0e0e0;
    }

    .appointment-table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #333;
    }

    .appointment-table td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .appointment-table tbody tr:hover {
        background: #f8f9fa;
    }

    .no-data {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    .btn-icon {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-content {
        background: white;
        padding: 40px;
        border-radius: 10px;
        max-width: 500px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .modal-header h3 {
        margin: 0;
        color: #333;
    }

    .modal-body {
        margin-bottom: 20px;
        color: #666;
        line-height: 1.6;
    }

    .modal-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .modal-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .modal-btn-cancel {
        background: #e0e0e0;
        color: #333;
    }

    .modal-btn-delete {
        background: #dc3545;
        color: white;
    }

    .modal-btn-delete:hover {
        background: #c82333;
    }

    @media (max-width: 768px) {
        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
        }

        .btn {
            flex: 1;
            justify-content: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .appointment-table {
            font-size: 12px;
        }

        .appointment-table th,
        .appointment-table td {
            padding: 10px;
        }

        .modal-content {
            width: 90%;
            padding: 20px;
        }
    }
</style>

<div class="patient-detail-container">
    <!-- Header Section -->
    <div class="header-section">
        <div>
            <h2>👤 Patient Details</h2>
            <span class="badge badge-patient">Patient ID: #{{ $patient->id }}</span>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.patients') }}" class="btn btn-back">
                <span>←</span> Back to Patients
            </a>
            <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-delete" onclick="confirmDelete()">
                    <span>🗑️</span> Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Personal Information Card -->
    <div class="card">
        <div class="card-header">
            📋 Personal Information
        </div>
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">{{ $patient->name }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Username</div>
                    <div class="info-value">{{ $patient->username ?? 'N/A' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">
                        <a href="mailto:{{ $patient->email }}" style="color: #667eea; text-decoration: none;">
                            {{ $patient->email }}
                        </a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">
                        @if($patient->phone)
                            <a href="tel:{{ $patient->phone }}" style="color: #667eea; text-decoration: none;">
                                {{ $patient->phone }}
                            </a>
                        @else
                            <span class="empty">Not provided</span>
                        @endif
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Member Since</div>
                    <div class="info-value">{{ $patient->created_at->format('F d, Y') }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Last Updated</div>
                    <div class="info-value">{{ $patient->updated_at->format('F d, Y - h:i A') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Information Card -->
    <div class="card">
        <div class="card-header">
            ⚕️ Medical Information & History
        </div>
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item" style="grid-column: 1 / -1;">
                    <div class="info-label">Current Disease / Illness</div>
                    <div class="info-value">
                        @if($patient->disease_illness)
                            <span style="background: #fff3cd; color: #856404; padding: 8px 12px; border-radius: 5px; display: inline-block; font-weight: 600;">
                                {{ $patient->disease_illness }}
                            </span>
                        @else
                            <span class="empty">Not specified</span>
                        @endif
                    </div>
                </div>

                <div class="info-item" style="grid-column: 1 / -1;">
                    <div class="info-label">Medical History</div>
                    @if($patient->medical_history)
                        <div class="info-value" style="background: #f8f9fa; padding: 15px; border-radius: 6px; line-height: 1.8;">
                            {!! nl2br(e($patient->medical_history)) !!}
                        </div>
                    @else
                        <div class="info-value empty">No medical history recorded</div>
                    @endif
                </div>

                <div class="info-item" style="grid-column: 1 / -1;">
                    <div class="info-label">Appointment History with Illness Details</div>
                    @if($appointments->count() > 0)
                        <div class="info-value">
                            @foreach($appointments->sortByDesc('appointment_date') as $appointment)
                                <div style="background: {{ $appointment->status === 'completed' ? '#e8f5e9' : ($appointment->status === 'pending' ? '#fff3cd' : '#f8f9fa') }}; border-left: 4px solid {{ $appointment->status === 'completed' ? '#28a745' : ($appointment->status === 'pending' ? '#ffc107' : '#6c757d') }}; padding: 15px; margin-bottom: 10px; border-radius: 6px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <strong style="color: {{ $appointment->status === 'completed' ? '#28a745' : ($appointment->status === 'pending' ? '#856404' : '#495057') }};">
                                            @if($appointment->doctor)
                                                Dr. {{ $appointment->doctor->name }}
                                            @else
                                                Unknown Doctor
                                            @endif
                                        </strong>
                                        <div style="text-align: right;">
                                            <small style="color: #666; display: block;">
                                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y - h:i A') }}
                                            </small>
                                            <span style="background: {{ $appointment->status === 'completed' ? '#d4edda' : ($appointment->status === 'pending' ? '#fff3cd' : '#e2e3e5') }}; color: {{ $appointment->status === 'completed' ? '#155724' : ($appointment->status === 'pending' ? '#856404' : '#383d41') }}; padding: 2px 6px; border-radius: 3px; font-size: 11px; font-weight: 600;">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    @if($appointment->disease_illness)
                                        <div style="margin-bottom: 8px;">
                                            <strong style="color: #dc3545;">Patient's Reported Illness:</strong>
                                            <span style="background: #ffe8e8; color: #721c24; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 500;">
                                                {{ $appointment->disease_illness }}
                                            </span>
                                        </div>
                                    @endif

                                    @if($appointment->status === 'completed' && $appointment->completion_description)
                                        <div style="margin-bottom: 8px;">
                                            <strong style="color: #007bff;">Doctor's Treatment/Notes:</strong>
                                            <div style="background: white; padding: 8px; border-radius: 4px; margin-top: 4px; font-size: 14px; border: 1px solid #dee2e6;">
                                                {!! nl2br(e($appointment->completion_description)) !!}
                                            </div>
                                        </div>
                                    @endif

                                    <div style="display: flex; gap: 8px; margin-top: 8px;">
                                        @if($appointment->is_emergency)
                                            <span style="background: #f8d7da; color: #721c24; padding: 2px 6px; border-radius: 3px; font-size: 11px; font-weight: 600;">
                                                🚨 EMERGENCY
                                            </span>
                                        @endif
                                        @if($appointment->status === 'completed')
                                            <span style="background: #d1ecf1; color: #0c5460; padding: 2px 6px; border-radius: 3px; font-size: 11px; font-weight: 600;">
                                                ✅ TREATED
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="info-value empty">No appointments found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Appointments Card -->
    <div class="card">
        <div class="card-header">
            📅 Appointment History ({{ $appointments->count() }})
        </div>
        <div class="card-body">
            @if($appointments->count() > 0)
                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Emergency</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>
                                @if($appointment->doctor)
                                    <strong>Dr. {{ $appointment->doctor->name }}</strong>
                                    <div style="font-size: 12px; color: #666;">
                                        {{ $appointment->doctor->specialization ?? 'Specialist' }}
                                    </div>
                                @else
                                    <span class="empty">Unknown Doctor</span>
                                @endif
                            </td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</div>
                                <div style="font-size: 12px; color: #666;">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $appointment->status }}">
                                    @switch($appointment->status)
                                        @case('pending')
                                            ⏳ Pending
                                            @break
                                        @case('confirmed')
                                            ✓ Confirmed
                                            @break
                                        @case('completed')
                                            ✓✓ Completed
                                            @break
                                        @case('cancelled')
                                            ✕ Cancelled
                                            @break
                                        @default
                                            {{ ucfirst($appointment->status) }}
                                    @endswitch
                                </span>
                            </td>
                            <td style="text-align: center;">
                                @if($appointment->is_emergency)
                                    <span style="color: #dc3545; font-weight: bold; font-size: 14px;">
                                        🚨 YES
                                    </span>
                                @else
                                    <span style="color: #28a745; font-size: 12px;">
                                        No
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p style="font-size: 16px; margin-bottom: 10px;">📭 No appointments found</p>
                    <p style="font-size: 13px;">This patient hasn't booked any appointments yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>⚠️ Confirm Delete</h3>
        </div>
        <div class="modal-body">
            Are you sure you want to delete <strong>{{ $patient->name }}</strong>? This action cannot be undone.
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="modal-btn modal-btn-delete" onclick="performDelete()">Delete Patient</button>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
    }

    function performDelete() {
        document.querySelector('form[action*="destroy"]').submit();
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeDeleteModal();
        }
    });
</script>

@endsection
