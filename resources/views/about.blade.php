<!DOCTYPE html>
<html>
<head>
    <title>About - LifeCare Hospital</title>
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

/* About Section */
.about {
    background: #f9f9f9;
}

.about-content {
    display: grid;
    grid-template-columns: 45% 55%;
    gap: 40px;
    align-items: center;
    align-content: center;
}

.about-text h3 {
    font-size: 32px;
    margin-bottom: 18px;
    color: #2b6cb0;
}

.about-text ul {
    list-style: none;
    margin: 20px 0;
}

.about-text li {
    padding: 10px 0;
    padding-left: 34px;
    position: relative;
}

.about-text li::before {
    content: '\2713';
    position: absolute;
    left: 0;
    top: 0;
    color: #2b6cb0;
    font-weight: 700;
    background: rgba(43,108,176,0.08);
    width: 26px;
    height: 26px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
}

.about-text p {
    color: #4a5568;
    font-size: 16px;
    margin-bottom: 16px;
}

.about-cta {
    margin-top: 22px;
}
.btn-cta {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 8px 20px rgba(118,75,162,0.12);
}

.about-image {
    background: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(102,126,234,0.12);
    overflow: hidden;
}

.about-image img {
    width: 100%;
    height: auto;
    max-width: 420px;
    max-height: 360px;
    object-fit: cover;
    border-radius: 10px;
    display: block;
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

    .about-content {
        grid-template-columns: 1fr;
        gap: 24px;
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

<!-- About Section -->
<section class="about">
    <div class="container">
        <h2>About LifeCare Hospital</h2>
        <div class="about-content">
            <div class="about-image">
                <img src="{{ asset('lifecare.png') }}" alt="LifeCare Hospital">
            </div>
            <div class="about-text">
                <h3>Excellence in Healthcare</h3>
                <p>LifeCare Hospital is committed to providing comprehensive healthcare services with state-of-the-art facilities and experienced medical professionals.</p>
                <ul>
                    <li>24/7 Emergency Services</li>
                    <li>Expert Medical Staff</li>
                    <li>Modern Medical Equipment</li>
                    <li>Affordable Treatment Plans</li>
                    <li>Patient-Centric Care</li>
                    <li>Advanced Diagnostics</li>
                </ul>
                <div class="about-cta">
                    <a href="{{ route('contact') }}" class="btn-cta">Contact Us</a>
                </div>
            </div>
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
