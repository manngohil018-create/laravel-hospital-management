@extends('layouts.admin')

@section('content')
<style>
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .card {
        background: var(--bg-primary);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-color);
        transition: 0.3s;
        color: var(--text-primary);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
    }

    .card i {
        font-size: 30px;
        color: #0072ff;
        margin-bottom: 10px;
    }

    .card h3 {
        margin-bottom: 5px;
        color: var(--text-primary);
    }

    .card p {
        color: var(--text-secondary);
        margin: 0;
    }

    .card-value {
        font-size: 28px;
        font-weight: 700;
        color: #0072ff;
        margin: 10px 0;
    }
</style>

<!-- Stats Cards -->
<div class="cards">
    <div class="card">
        <i class="fa-solid fa-user-doctor"></i>
        <h3>Total Doctors</h3>
        <div class="card-value">{{ \App\Models\Doctor::count() }}</div>
        <p>Active Doctors</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-calendar-check"></i>
        <h3>Appointments</h3>
        <div class="card-value">{{ \App\Models\Appointment::count() }}</div>
        <p>Total Appointments</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-users"></i>
        <h3>Patients</h3>
        <div class="card-value">{{ \App\Models\User::where('role','patient')->count() }}</div>
        <p>Registered Patients</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-clock"></i>
        <h3>Pending</h3>
        <div class="card-value">{{ \App\Models\Appointment::where('status','pending')->count() }}</div>
        <p>Pending Appointments</p>
    </div>
</div>

<!-- Recent Appointments Section -->
<div style="margin-top: 40px;">
    <h2 style="color: var(--text-primary); margin-bottom: 20px;">📋 Recent Appointments</h2>
    <div style="background: var(--bg-primary); border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <th style="padding: 15px; text-align: left;">Patient</th>
                    <th style="padding: 15px; text-align: left;">Doctor</th>
                    <th style="padding: 15px; text-align: left;">Date & Time</th>
                    <th style="padding: 15px; text-align: left;">Status</th>
                    <th style="padding: 15px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentAppointments as $appointment)
                    <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-primary);">
                        <td style="padding: 15px;">
                            <strong>{{ $appointment->patient->name ?? 'N/A' }}</strong><br>
                            <small style="color: var(--text-secondary);">{{ $appointment->patient->email ?? 'N/A' }}</small>
                        </td>
                        <td style="padding: 15px;">
                            <strong>{{ $appointment->doctor->name ?? 'N/A' }}</strong><br>
                            <small style="color: var(--text-secondary);">{{ $appointment->doctor->specialization ?? 'N/A' }}</small>
                        </td>
                        <td style="padding: 15px;">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y h:i A') }}
                        </td>
                        <td style="padding: 15px;">
                            @if($appointment->status == 'pending')
                                <span style="background: #FF9800; color: white; padding: 5px 12px; border-radius: 5px; font-size: 12px; font-weight: 600;">PENDING</span>
                            @elseif($appointment->status == 'confirmed')
                                <span style="background: #2196F3; color: white; padding: 5px 12px; border-radius: 5px; font-size: 12px; font-weight: 600;">CONFIRMED</span>
                            @elseif($appointment->status == 'completed')
                                <span style="background: #4CAF50; color: white; padding: 5px 12px; border-radius: 5px; font-size: 12px; font-weight: 600;">COMPLETED</span>
                            @elseif($appointment->status == 'cancelled')
                                <span style="background: #f44336; color: white; padding: 5px 12px; border-radius: 5px; font-size: 12px; font-weight: 600;">CANCELLED</span>
                            @endif
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="{{ route('admin.appointments.show', $appointment->id) }}" style="color: #0072ff; text-decoration: none; font-weight: 600;">View</a>
                        </td>
                    </tr>
                @empty
                    <tr style="color: var(--text-secondary);">
                        <td colspan="5" style="padding: 30px; text-align: center;">
                            <i class="fas fa-calendar-times" style="font-size: 30px; opacity: 0.5; margin-bottom: 10px; display: block;"></i>
                            No appointments yet
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

