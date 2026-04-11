<!DOCTYPE html>
<html>
<head>
    <title>Doctors - LifeCare Hospital</title>
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
    padding: 80px 20px;
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

/* Doctors Section */
.doctors {
    background: white;
}

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
    background-size: cover;
    background-position: center;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 80px;
    overflow: hidden;
}

.doctor-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
        padding: 50px 20px;
    }

    section h2 {
        font-size: 28px;
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

<!-- Doctors Section -->
<section class="doctors">
    <div class="container">
        <h2>Our Expert Doctors</h2>
        <div class="doctors-grid">
            @forelse($doctors as $doctor)
                <div class="doctor-card">
                    <div class="doctor-image">
                        @if($doctor->photo)
                            <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}">
                        @else
                            <img src="{{ asset('lifecare.jfif') }}" alt="LifeCare Hospital">
                        @endif
                    </div>
                    <div class="doctor-info">
                        <h4>{{ $doctor->name }}</h4>
                        <div class="specialization">{{ $doctor->specialization }}</div>
                        <p>{{ $doctor->about ?? 'Professional healthcare provider with years of experience' }}</p>
                        <p><strong>Contact:</strong> {{ $doctor->phone }}</p>
                    </div>
                </div>
            @empty
                @for($i = 1; $i <= 3; $i++)
                    <div class="doctor-card">
                        <div class="doctor-image">
                            <i class="fas fa-user-doctor"></i>
                        </div>
                        <div class="doctor-info">
                            <h4>Sample Doctor {{ $i }}</h4>
                            <div class="specialization">Cardiology</div>
                            <p>Professional healthcare provider with years of experience in cardiac care</p>
                            <p><strong>Contact:</strong> +1-XXX-XXX-{{ $i }}000</p>
                        </div>
                    </div>
                @endfor
            @endforelse
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
