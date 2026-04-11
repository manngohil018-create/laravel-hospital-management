@php
    /**
     * Variables available: $user, $totalAppointments, $upcoming, $completed, $appointments
     */
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Doctor Dashboard - LifeCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body{font-family:'Poppins',sans-serif;background:#f5f7fb;color:#222;margin:0}
        .navbar{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:#fff;padding:14px 24px;display:flex;justify-content:space-between;align-items:center}
        .navbar h1{font-size:18px;margin:0}
        .container{max-width:1100px;margin:24px auto;padding:0 20px}
        .layout{display:grid;grid-template-columns:260px 1fr;gap:20px}
        .sidebar{background:#2f3e52;padding:14px;border-radius:8px;color:#fff;height:calc(100vh - 120px)}
        .sidebar a{display:block;color:#fff;text-decoration:none;padding:10px;border-radius:6px;margin-bottom:6px}
        .sidebar a:hover{background:#3b4d63}
        .content{min-height:400px}
        .cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px}
        .card{background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(16,24,40,0.06)}
        .card h3{font-size:14px;color:#667eea;margin:0 0 8px}
        .card .value{font-size:24px;font-weight:700}
        .profile{background:#fff;padding:16px;border-radius:8px;margin-bottom:20px}
        .btn{display:inline-block;padding:8px 12px;border-radius:6px;background:#667eea;color:#fff;text-decoration:none}
        table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 6px 18px rgba(16,24,40,0.04)}
        th,td{padding:12px 14px;text-align:left;border-bottom:1px solid #f1f5f9}
        thead th{background:#f8fafc;color:#334155;font-weight:600}
        .status-pill{display:inline-block;padding:6px 10px;border-radius:999px;font-weight:600;color:#fff}
        .status-pending{background:#f59e0b}
        .status-confirmed{background:#06b6d4}
        .status-completed{background:#10b981}
        .pagination{margin-top:12px;display:flex;gap:8px;align-items:center}
        .page-link{padding:8px 10px;background:#fff;border:1px solid #e2e8f0;border-radius:6px;text-decoration:none;color:#334155}
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🏥 LifeCare Doctor Portal</h1>
        <div style="display:flex;align-items:center;gap:8px">
            <a href="{{ route('home') }}" class="btn">Home</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;margin:0">
                @csrf
                <button type="submit" class="btn" style="background:#222">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="layout">
            <aside class="sidebar">
                <a href="{{ route('doctor.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('doctor.appointments') }}">📋 Appointments</a>
                <a href="{{ route('doctor.analytics') }}">📈 Analytics</a>
                <a href="#">👤 Profile</a>
            </aside>

            <main class="content">
                <div class="profile">
                    <h2 style="margin:0 0 6px">{{ $user->name }}</h2>
                    <div style="color:#64748b;font-size:14px">{{ $user->email }} · {{ $user->phone ?? 'No phone' }}</div>
                </div>

                <div class="cards">
                    <div class="card">
                        <h3>Total Appointments</h3>
                        <div class="value">{{ $totalAppointments }}</div>
                    </div>
                    <div class="card">
                        <h3>Upcoming</h3>
                        <div class="value">{{ $upcoming }}</div>
                    </div>
                    <div class="card">
                        <h3>Completed</h3>
                        <div class="value">{{ $completed }}</div>
                    </div>
                </div>

                <div style="margin-top:12px">
                    <h3 style="margin-bottom:8px">Appointments</h3>

                    @if(isset($appointments) && $appointments->count())
                        <table>
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appt)
                                <tr>
                                    <td>{{ optional($appt->patient)->name ?? 'N/A' }}<div style="font-size:12px;color:#66748b">{{ optional($appt->patient)->email ?? '' }}</div></td>
                                    <td>{{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M, Y H:i') }}</td>
                                    <td>
                                        @php $s = $appt->status ?? 'pending'; @endphp
                                        <span class="status-pill status-{{ $s }}">{{ ucfirst($s) }}</span>
                                    </td>
                                    <td>
                                        @if($s !== 'confirmed')
                                            <form action="{{ route('doctor.appointment.update-status', $appt->id) }}" method="POST" style="display:inline;margin-right:6px">
                                                @csrf
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" style="background:#06b6d4;color:#fff;border:none;padding:6px 8px;border-radius:6px;cursor:pointer">Confirm</button>
                                            </form>
                                        @endif

                                        @if($s !== 'completed')
                                            <form action="{{ route('doctor.appointment.update-status', $appt->id) }}" method="POST" style="display:inline;margin-right:6px">
                                                @csrf
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" style="background:#10b981;color:#fff;border:none;padding:6px 8px;border-radius:6px;cursor:pointer">Complete</button>
                                            </form>
                                        @endif

                                        <a href="#" style="color:#2563eb;text-decoration:none">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="pagination">
                            {{-- default Laravel pagination links --}}
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <div style="background:#fff;padding:18px;border-radius:8px">No appointments found.</div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>
