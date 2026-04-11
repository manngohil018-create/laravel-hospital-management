<!DOCTYPE html>
<html>
<head>
    <title>My Appointments - LifeCare Hospital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #333;
    line-height: 1.6;
    background: #f9f9f9;
}

/* Navigation */
header {
    background: linear-gradient(135deg, #003D7A 0%, #0066CC 100%);
    color: white;
    padding: 15px 0;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.logo {
    font-size: 28px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-links {
    display: flex;
    gap: 30px;
    list-style: none;
}

.nav-links a {
    color: white;
    text-decoration: none;
    transition: opacity 0.3s;
}

.nav-links a:hover {
    opacity: 0.8;
}

.auth-buttons {
    display: flex;
    gap: 15px;
}

.btn-login, .btn-register {
    padding: 10px 20px;
    border: 2px solid white;
    background: transparent;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
    display: inline-block;
}

.btn-register {
    background: white;
    color: #003D7A;
}

.btn-login:hover {
    background: white;
    color: #003D7A;
}

.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Section */
section {
    padding: 60px 20px;
    min-height: 70vh;
}

section h2 {
    font-size: 36px;
    text-align: center;
    margin-bottom: 50px;
    color: #333;
    position: relative;
}

section h2::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 15px auto 0;
}

/* Appointments Content */
.appointments-content {
    max-width: 900px;
    margin: 0 auto;
}

.appointments-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 20px;
}

.appointments-header a {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 25px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.appointments-header a:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.appointment-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-left: 4px solid #667eea;
    transition: all 0.3s;
}

.appointment-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.appointment-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.appointment-doctor {
    display: flex;
    align-items: center;
    gap: 15px;
}

.doctor-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
}

.doctor-info h3 {
    margin-bottom: 5px;
    color: #333;
}

.doctor-info p {
    color: #666;
    font-size: 14px;
}

.status-badge {
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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

.appointment-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 20px 0;
    padding: 20px 0;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.detail-icon {
    font-size: 20px;
    color: #667eea;
    width: 30px;
    text-align: center;
}

.detail-text strong {
    display: block;
    font-size: 12px;
    color: #666;
    margin-bottom: 3px;
}

.detail-text span {
    font-size: 16px;
    color: #333;
    font-weight: 600;
}

.appointment-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.btn-action {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-action-primary {
    background: #667eea;
    color: white;
}

.btn-action-primary:hover {
    background: #5568d3;
}

.btn-action-secondary {
    background: #f0f0f0;
    color: #333;
}

.btn-action-secondary:hover {
    background: #e0e0e0;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state-icon {
    font-size: 80px;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: #666;
    margin-bottom: 10px;
}

.empty-state p {
    color: #999;
    margin-bottom: 30px;
}

.empty-state a {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 30px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s;
}

.empty-state a:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

/* Footer */
footer {
    background: #1a1a2e;
    color: white;
    padding: 40px 20px;
    text-align: center;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
}

.footer-content p {
    margin-bottom: 10px;
}

.footer-links {
    margin: 20px 0;
}

.footer-links a {
    color: #667eea;
    text-decoration: none;
    margin: 0 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .nav-links {
        display: none;
    }

    section {
        padding: 40px 20px;
    }

    section h2 {
        font-size: 28px;
    }

    .appointment-details {
        grid-template-columns: 1fr;
    }

    .appointment-header {
        flex-direction: column;
    }

    .appointments-header {
        flex-direction: column;
    }

    .btn-action {
        flex: 1;
        justify-content: center;
    }
}
</style>
</head>
<body>

<!-- Navigation -->
<header>
    <nav class="container">
        <div class="logo">
            <i class="fas fa-hospital"></i> LifeCare
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('doctors') }}">Doctors</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <div class="auth-buttons">
            @auth
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-register" style="border:none; cursor:pointer;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            @endauth
        </div>
    </nav>
</header>

<!-- Appointments Section -->
<section>
    <div class="container">
        <h2><i class="fas fa-calendar-check"></i> My Appointments</h2>
        
        <div class="appointments-content">
            <div class="appointments-header">
                <p style="color: #666;">
                    <strong>Total Appointments:</strong> {{ $appointments->count() }}
                </p>
                <a href="{{ route('book-appointment') }}">
                    <i class="fas fa-plus"></i> Book New Appointment
                </a>
            </div>

            @forelse($appointments as $appointment)
                <div class="appointment-card">
                    <div class="appointment-header">
                        <div class="appointment-doctor">
                            <div class="doctor-avatar">
                                <i class="fas fa-user-doctor"></i>
                            </div>
                            <div class="doctor-info">
                                <h3>{{ $appointment->doctor->name ?? 'Unknown' }}</h3>
                                <p>{{ $appointment->doctor->specialization ?? 'Specialist' }}</p>
                            </div>
                        </div>
                        <span class="status-badge status-{{ strtolower($appointment->status) }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>

                    <div class="appointment-details">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="detail-text">
                                <strong>Date</strong>
                                <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}</span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="detail-text">
                                <strong>Time</strong>
                                <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="detail-text">
                                <strong>Doctor Phone</strong>
                                <span>{{ $appointment->doctor->phone ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    @if($appointment->patient->disease_illness || $appointment->patient->medical_history)
                    <div style="background: #f0f7ff; border-left: 4px solid #0072ff; padding: 20px; border-radius: 5px; margin-top: 15px;">
                        <h4 style="color: #0072ff; margin-bottom: 10px;"><i class="fas fa-heartbeat"></i> Medical Information</h4>
                        
                        @if($appointment->patient->disease_illness)
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #333;">Current Disease/Illness:</strong>
                            <p style="color: #666; margin: 5px 0 0 0;">{{ $appointment->patient->disease_illness }}</p>
                        </div>
                        @endif

                        @if($appointment->patient->medical_history)
                        <div>
                            <strong style="color: #333;">Medical History:</strong>
                            <p style="color: #666; margin: 5px 0 0 0;">{{ $appointment->patient->medical_history }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($appointment->is_emergency)
                    <div style="margin-top: 15px; padding: 15px; background: #fff5f5; border-left: 4px solid #dc3545; border-radius: 8px;">
                        <h4 style="color: #c81e1e; margin-bottom: 10px;"><i class="fas fa-exclamation-triangle"></i> Emergency Appointment</h4>
                        <p style="color: #5f2121; margin: 0;">This appointment is marked as urgent. Please keep your phone available for quick updates.</p>
                        @if($appointment->emergency_details)
                        <p style="margin: 10px 0 0 0; color: #333;"><strong>Emergency Details:</strong> {{ $appointment->emergency_details }}</p>
                        @endif
                    </div>
                    @endif

                    @if($appointment->completion_description)
                    <div style="margin-top: 15px; padding: 15px; background: #f0fdf4; border-left: 4px solid #16a34a; border-radius: 8px;">
                        <h4 style="color: #166534; margin-bottom: 10px;"><i class="fas fa-file-medical"></i> Doctor's Notes</h4>
                        <p style="color: #134e4a; margin: 0;">{{ $appointment->completion_description }}</p>
                    </div>
                    @endif

                    <div class="appointment-actions">
                        <a href="{{ route('book-appointment') }}" class="btn-action btn-action-primary">
                            <i class="fas fa-calendar-plus"></i> Book Another Appointment
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h3>No Appointments Yet</h3>
                    <p>You haven't booked any appointments. Schedule your first appointment with our experienced doctors.</p>
                    <a href="{{ route('book-appointment') }}">
                        <i class="fas fa-calendar-plus"></i> Book Your First Appointment
                    </a>
                </div>
            @endforelse

            @if($appointments->count() > 0)
                <div style="margin-top: 30px;">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <h3>LifeCare Hospital</h3>
        <p>Providing excellent healthcare services to our community since 2020</p>
        <div class="footer-links">
            <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
        </div>
        <p>&copy; 2026 LifeCare Hospital. All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>
