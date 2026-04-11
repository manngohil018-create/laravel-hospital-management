<!DOCTYPE html>
<html>
<head>
    <title>LifeCare Hospital - Best Medical Services</title>
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
    margin: 0;
}

/* Top Header Bar */
.top-header {
    background: rgba(255, 255, 255, 0.95);
    padding: 15px 20px;
    border-bottom: 1px solid #e0e0e0;
    position: sticky;
    top: 0;
    z-index: 99;
}

.top-header-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
}

.header-logo {
    display: none;
}

.header-info {
    display: flex;
    gap: 50px;
    align-items: center;
    flex: 1;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-item i {
    font-size: 20px;
    color: #3b82f6;
    width: 30px;
    text-align: center;
}

.info-item-text h4 {
    margin: 0;
    font-size: 12px;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-item-text p {
    margin: 2px 0 0 0;
    font-size: 14px;
    color: #111827;
    font-weight: 600;
}

@media (max-width: 768px) {
    .top-header-content {
        flex-direction: column;
        gap: 15px;
    }

    .header-info {
        gap: 20px;
        flex-direction: column;
        width: 100%;
    }

    .info-item-text h4 {
        font-size: 11px;
    }

    .info-item-text p {
        font-size: 13px;
    }
}

/* Navigation */
header {
    background: linear-gradient(135deg, #003D7A 0%, #0066CC 100%);
    color: white;
    padding: 15px 0;
    position: sticky;
    top: 80px;
    z-index: 98;
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
    align-items: center;
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

/* User Profile Dropdown */
.user-profile-dropdown {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
}

.user-name {
    color: white;
    font-weight: 600;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: -20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    min-width: 350px;
    max-height: 500px;
    overflow-y: auto;
    display: none;
    z-index: 1000;
    margin-top: 10px;
}

.dropdown-menu.active {
    display: block;
}

.dropdown-header {
    padding: 16px;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
    border-radius: 8px 8px 0 0;
}

.dropdown-header h4 {
    color: #111827;
    margin-bottom: 4px;
    font-size: 14px;
}

.dropdown-header p {
    color: #6b7280;
    font-size: 12px;
    margin: 0;
}

.dropdown-content {
    padding: 12px;
}

.dropdown-section {
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e5e7eb;
}

.dropdown-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.dropdown-section h5 {
    font-size: 12px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}

.dropdown-item {
    padding: 8px 12px;
    color: #374151;
    font-size: 13px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dropdown-item-label {
    font-weight: 500;
    color: #6b7280;
}

.dropdown-item-value {
    font-weight: 600;
    color: #111827;
}

.dropdown-footer {
    padding: 12px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    gap: 8px;
}

.dropdown-btn {
    flex: 1;
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    font-size: 12px;
    transition: all 0.3s;
}

.dropdown-btn-primary {
    background: #3b82f6;
    color: white;
}

.dropdown-btn-primary:hover {
    background: #2563eb;
}

.dropdown-btn-secondary {
    background: #f3f4f6;
    color: #111827;
    border: 1px solid #d1d5db;
}

.dropdown-btn-secondary:hover {
    background: #e5e7eb;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, rgba(0, 61, 122, 0.65) 0%, rgba(0, 102, 204, 0.65) 100%), url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1400&h=700&fit=crop');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: white;
    padding: 120px 20px;
    text-align: center;
    min-height: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 0;
}

.hero-content {
    max-width: 900px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.hero h1 {
    font-size: 56px;
    margin-bottom: 30px;
    font-weight: 700;
    line-height: 1.2;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
}

.hero p {
    font-size: 20px;
    margin-bottom: 40px;
    opacity: 1;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
}

/* User Profile Section */
.user-profile-section {
    background: #ffffff;
    padding: 48px 20px;
}

.profile-container {
    max-width: 1200px;
    margin: 0 auto;
}

.profile-header {
    text-align: center;
    margin-bottom: 32px;
}

.profile-header h2 {
    font-size: 30px;
    color: #111827;
    margin-bottom: 6px;
}

.profile-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    align-items: start;
}

.profile-card {
    background: #ffffff;
    color: #111827;
    padding: 28px;
    border-radius: 12px;
    box-shadow: 0 12px 30px rgba(16,24,40,0.06);
    border-left: 6px solid #667eea;
}

.profile-card h3 {
    font-size: 20px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.profile-card i {
    font-size: 20px;
    color: #3b82f6;
    background: rgba(59,130,246,0.08);
    padding: 8px;
    border-radius: 8px;
}

.profile-item {
    margin: 12px 0;
    padding: 14px;
    background: #f8fafc;
    border-radius: 8px;
}

.profile-item-label {
    font-size: 12px;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 6px;
}

.profile-item-value {
    font-size: 16px;
    font-weight: 600;
}

.appointments-summary {
    background: #ffffff;
    padding: 18px;
    border-radius: 10px;
    margin-top: 12px;
}

.appointments-summary h4 {
    color: #3b82f6;
    margin-bottom: 12px;
}

.appointment-stat {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
}

.appointment-stat:last-child {
    border-bottom: none;
}

.appointment-stat strong {
    color: #111827;
}

.appointment-stat .value {
    color: #3b82f6;
    font-weight: 700;
}

.action-buttons {
    display: flex;
    gap: 12px;
    margin-top: 16px;
}

.btn-action {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.18s ease;
}

.btn-action-primary {
    background: #3b82f6;
    color: #fff;
}

.btn-action-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(59,130,246,0.12);
}

.btn-action-secondary {
    background: transparent;
    color: #3b82f6;
    border: 2px solid #e6eefc;
}

.btn-action-secondary:hover {
    background: #f8fafc;
}

@media (max-width: 1024px) {
    .profile-content {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .profile-content {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}

.btn-primary {
    background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
    color: white;
    padding: 16px 50px;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 8px 25px rgba(26, 188, 156, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(26, 188, 156, 0.5);
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

    .hero h1 {
        font-size: 32px;
    }

    .hero p {
        font-size: 16px;
    }
    
    .dropdown-menu {
        min-width: 300px;
        right: -50px;
    }
    
    .user-name {
        display: none;
    }
}
</style>
</head>
<body>

<!-- Top Header -->
<div class="top-header">
    <div class="top-header-content">
        <div class="header-info">
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <div class="info-item-text">
                    <h4>Email Support</h4>
                    <p>info@lifecare.co.in</p>
                </div>
            </div>
            
            <div class="info-item">
                <i class="fas fa-phone"></i>
                <div class="info-item-text">
                    <h4>Call Support</h4>
                    <p>079 - 4020 4020</p>
                </div>
            </div>
            
            <div class="info-item">
                <i class="fas fa-clock"></i>
                <div class="info-item-text">
                    <h4>Working Hours</h4>
                    <p>Open 24/7</p>
                </div>
            </div>
            
            <div class="info-item">
                <i class="fas fa-heart"></i>
                <div class="info-item-text">
                    <h4>Our Promise</h4>
                    <p>Trust, comfort, and care — just like home.👨‍👩‍👧‍👦</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Bar -->
<header>
    <nav class="container">
        <div class="logo">
            <i class="fas fa-hospital"></i> LifeCare
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            @auth
                @if((Auth::user()->role ?? '') === 'doctor')
                    <li><a href="{{ route('doctor.profile') }}">Dashboard</a></li>
                @endif
            @endauth
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('doctors') }}">Doctors</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <div class="auth-buttons">
            @auth
                <div class="user-profile-dropdown" onclick="toggleProfileDropdown()">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    
                    <!-- Profile Dropdown Menu -->
                    <div class="dropdown-menu" id="profileDropdown">
                        <div class="dropdown-header">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        
                        <div class="dropdown-content">
                            <!-- Profile Info Section -->
                            <div class="dropdown-section">
                                <h5>Profile Information</h5>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Phone:</span>
                                    <span class="dropdown-item-value">{{ Auth::user()->phone ?? 'N/A' }}</span>
                                </div>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Account Type:</span>
                                    <span class="dropdown-item-value">{{ ucfirst(Auth::user()->role) }}</span>
                                </div>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Member Since:</span>
                                    <span class="dropdown-item-value">{{ Auth::user()->created_at->format('d M, Y') }}</span>
                                </div>
                            </div>
                            
                            <!-- Medical Information Section -->
                            @if(Auth::user()->role === 'patient')
                            <div class="dropdown-section">
                                <h5>Medical Information</h5>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Disease/Illness:</span>
                                    <span class="dropdown-item-value">{{ Auth::user()->disease_illness ?? 'Not provided' }}</span>
                                </div>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Medical History:</span>
                                    <span class="dropdown-item-value">{{ Auth::user()->medical_history ? substr(Auth::user()->medical_history, 0, 40) . '...' : 'Not provided' }}</span>
                                </div>
                            </div>
                            
                            <!-- Appointments Section -->
                            <div class="dropdown-section">
                                <h5>Your Appointments</h5>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Total:</span>
                                    <span class="dropdown-item-value">{{ \App\Models\Appointment::where('patient_id', Auth::id())->count() }}</span>
                                </div>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Pending:</span>
                                    <span class="dropdown-item-value" style="color: #f59e0b;">{{ \App\Models\Appointment::where('patient_id', Auth::id())->where('status', 'pending')->count() }}</span>
                                </div>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Confirmed:</span>
                                    <span class="dropdown-item-value" style="color: #3b82f6;">{{ \App\Models\Appointment::where('patient_id', Auth::id())->where('status', 'confirmed')->count() }}</span>
                                </div>
                                <div class="dropdown-item">
                                    <span class="dropdown-item-label">Completed:</span>
                                    <span class="dropdown-item-value" style="color: #10b981;">{{ \App\Models\Appointment::where('patient_id', Auth::id())->where('status', 'completed')->count() }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="dropdown-footer">
                            @if(Auth::user()->role === 'patient')
                            <a href="{{ route('book-appointment') }}" class="dropdown-btn dropdown-btn-primary" style="text-decoration: none;">Book Appointment</a>
                            @endif
                            <a href="{{ route('my-appointments') }}" class="dropdown-btn dropdown-btn-primary" style="text-decoration: none;">My Appointments</a>
                            <form action="{{ route('logout') }}" method="POST" style="flex: 1;">
                                @csrf
                                <button type="submit" class="dropdown-btn dropdown-btn-secondary" style="width: 100%;">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            @endauth
        </div>
    </nav>
</header>

<!-- Hero Section -->
@guest
<section class="hero" id="home">
    <div class="hero-content">
        <h1>Welcome to LifeCare Hospital</h1>
        <p>Your Health is Our Priority: Comprehensive Care Under One Roof</p>
        <a href="{{ route('book-appointment') }}" class="btn-primary">Book Appointment Now</a>
    </div>
</section>
@endguest

@auth
@endauth

<!-- Tagline Section -->
<section style="background: linear-gradient(135deg, rgba(0, 172, 193, 0.85) 0%, rgba(0, 151, 167, 0.85) 100%), url('{{ asset('back.jpg') }}') center/cover no-repeat; padding: 100px 20px; text-align: center; color: white; min-height: 280px; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 48px; margin-bottom: 20px; font-weight: 700; line-height: 1.4; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);">
            💚 Your Health is Our Priority 💚
        </h2>
        <p style="font-size: 22px; opacity: 1; margin: 0; font-weight: 500; letter-spacing: 0.5px; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);">Comprehensive Care Under One Roof</p>
    </div>
</section>

<!-- Featured Doctors Section -->
<section style="background: #f9f9f9; padding: 80px 20px;">
    <div class="container">
        <h2 style="font-size: 36px; text-align: center; margin-bottom: 50px; color: #333; position: relative;">
            Our Expert Doctors
        </h2>
        <style>
            .doctors-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 30px;
            }
            
            .doctor-card {
                background: white;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                transition: all 0.3s;
            }
            
            .doctor-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            }
            
            .doctor-image {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                background-size: cover;
                background-position: center;
                height: 250px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 80px;
            }
            
            .doctor-image i {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }
            
            .doctor-info {
                padding: 20px;
            }
            
            .doctor-info h4 {
                font-size: 20px;
                margin-bottom: 5px;
                color: #333;
            }
            
            .specialization {
                color: #667eea;
                font-weight: 600;
                margin-bottom: 10px;
            }
            
            .doctor-info p {
                color: #666;
                margin-bottom: 15px;
                font-size: 14px;
            }
            
            .doctor-info a {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
                display: inline-block;
                margin-top: 10px;
            }
            
            .doctor-info a:hover {
                text-decoration: underline;
            }
        </style>
        
        <div class="doctors-grid">
            @forelse($doctors as $doctor)
                <div class="doctor-card">
                    <div class="doctor-image" @if($doctor->photo) style="background-image: url('{{ asset('storage/' . $doctor->photo) }}'); background-size: cover; background-position: center;" @else style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;" @endif>
                        @if(!$doctor->photo)
                            <i class="fas fa-user-doctor"></i>
                        @endif
                    </div>
                    <div class="doctor-info">
                        <h4>{{ $doctor->name }}</h4>
                        <div class="specialization">{{ $doctor->specialization }}</div>
                        <p>{{ $doctor->about ?? 'Professional healthcare provider with years of experience' }}</p>
                        <p><strong>Contact:</strong> {{ $doctor->phone }}</p>
                        <a href="{{ route('book-appointment', ['doctor' => $doctor->id]) }}">Book Appointment →</a>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 40px; grid-column: 1 / -1; color: #999;">
                    <p>No doctors available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('doctors') }}" class="btn-primary">View All Doctors</a>
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

<script>
function toggleProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    if (dropdown) {
        dropdown.classList.toggle('active');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profileDropdown');
    const profileDropdownDiv = document.querySelector('.user-profile-dropdown');
    
    if (dropdown && profileDropdownDiv && !profileDropdownDiv.contains(event.target)) {
        dropdown.classList.remove('active');
    }
});
</script>

</body>
</html>
