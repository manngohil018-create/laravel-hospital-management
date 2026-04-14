@extends('layouts.admin')

@section('content')
<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
    }
    .header h2 {
        margin: 0;
        color: #333;
    }
    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead tr {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }
    tbody tr:hover {
        background: #f8f9fa;
    }
    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }
    .status-completed {
        background: #d4edda;
        color: #155724;
    }
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    .status-expired {
        background: #e2e3e5;
        color: #383d41;
        text-decoration: line-through;
    }
    .action-links {
        display: flex;
        gap: 10px;
    }
    .btn-edit {
        color: #28a745;
        text-decoration: none;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 3px;
        transition: all 0.3s;
    }
    .btn-edit:hover {
        background: #e8f5e9;
    }
    .btn-delete {
        color: #dc3545;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 3px;
        transition: all 0.3s;
    }
    .btn-delete:hover {
        background: #ffe8e8;
    }
    .empty {
        text-align: center;
        padding: 40px;
        color: #999;
    }

    /* Pagination override for Laravel default Tailwind links */
    nav[role="navigation"] {
        display: flex;
        justify-content: center;
        padding: 20px 0 0;
    }

    nav[role="navigation"] .inline-flex {
        display: inline-flex;
        flex-wrap: wrap;
        gap: 4px;
        align-items: center;
        justify-content: center;
    }

    nav[role="navigation"] .inline-flex.items-center {
        align-items: center;
    }

    nav[role="navigation"] a,
    nav[role="navigation"] span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        min-width: 40px;
        min-height: 40px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        color: #333;
        text-decoration: none;
        background: #fff;
    }

    nav[role="navigation"] a:hover {
        background: #f4f7fc;
        color: #003d7a;
    }

    nav[role="navigation"] span[aria-disabled="true"] {
        cursor: default;
        opacity: 0.65;
        background: #f7f7f7;
    }

    nav[role="navigation"] svg {
        width: 18px;
        height: 18px;
    }

    nav[role="navigation"] .rounded-l-md {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    nav[role="navigation"] .rounded-r-md {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }
</style>

<div class="header">
    <h2>📋 Manage Appointments</h2>
    <div style="font-size: 14px; color: #666;">
        Total Appointments: <strong>{{ $appointments->total() }}</strong> |
        Showing page {{ $appointments->currentPage() }} of {{ $appointments->lastPage() }}
    </div>
</div>

<div class="table-container">
    @if($appointments->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Emergency</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td><strong>{{ $appointment->patient->name ?? 'N/A' }}</strong></td>
                <td>{{ $appointment->doctor->name ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y, h:i A') }}</td>
                <td>
                    @if($appointment->is_emergency)
                        <span class="status-badge" style="background:#f8d7da;color:#721c24;">Emergency</span>
                    @else
                        <span class="status-badge" style="background:#e2e3e5;color:#383d41;">Normal</span>
                    @endif
                </td>
                <td>
                    @php
                        $displayStatus = method_exists($appointment, 'getDisplayStatus') ? $appointment->getDisplayStatus() : ($appointment->status ?? 'pending');
                    @endphp
                    <span class="status-badge status-{{ $displayStatus }}">
                        {{ ucfirst($displayStatus) }}
                    </span>
                </td>
                <td>
                    <div class="action-links">
                        <a href="{{ route('admin.appointments.edit',$appointment->id) }}" class="btn-edit">✏️ Edit</a>
                        <form action="{{ route('admin.appointments.destroy',$appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Delete this appointment?');">🗑️ Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div style="padding: 20px; text-align: center;">
        {{ $appointments->links('vendor.pagination.admin') }}
    </div>
    @else
    <div class="empty">
        <p>No appointments found.</p>
        <p style="font-size: 14px; margin-top: 10px;">New appointments will appear here automatically.</p>
    </div>
    @endif
</div>

@endsection
