<!DOCTYPE html>
<html>
<head>
    <title>Services - LifeCare Hospital</title>
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

/* Services Section */
.services {
    background: #f9f9f9;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.service-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.service-icon {
    font-size: 50px;
    color: #667eea;
    margin-bottom: 15px;
}

.service-card h4 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
}

.service-card p {
    color: #666;
    font-size: 14px;
}

/* Diseases Section */
.diseases {
    background: white;
}

.diseases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.disease-card {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #667eea;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s;
}

.disease-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transform: translateX(5px);
}

.disease-card h4 {
    color: #667eea;
    margin-bottom: 8px;
    font-size: 16px;
}

.disease-card p {
    color: #666;
    font-size: 13px;
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

<!-- Services Section -->
<section class="services">
    <div class="container">
        <h2>Our Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-heartbeat"></i></div>
                <h4>Cardiology</h4>
                <p>Advanced heart and cardiovascular care by experienced cardiologists</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-lungs"></i></div>
                <h4>Pulmonology</h4>
                <p>Comprehensive respiratory disease treatment and management</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-brain"></i></div>
                <h4>Neurology</h4>
                <p>Specialized neurological care and brain disorder treatment</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-eye"></i></div>
                <h4>Ophthalmology</h4>
                <p>Eye care services including surgery and vision correction</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-tooth"></i></div>
                <h4>Dental Care</h4>
                <p>Complete dental services and oral health management</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-person"></i></div>
                <h4>General Medicine</h4>
                <p>Primary healthcare and general medical consultation</p>
            </div>
        </div>
    </div>
</section>

<!-- Diseases Section -->
<section class="diseases">
    <div class="container">
        <h2>Common Conditions We Treat</h2>
        <div class="diseases-grid">
            <div class="disease-card">
                <h4>Diabetes</h4>
                <p>Comprehensive diabetes management and treatment programs</p>
            </div>
            <div class="disease-card">
                <h4>Hypertension</h4>
                <p>Blood pressure control and cardiovascular disease prevention</p>
            </div>
            <div class="disease-card">
                <h4>Asthma</h4>
                <p>Respiratory management and breathing disorder treatment</p>
            </div>
            <div class="disease-card">
                <h4>Arthritis</h4>
                <p>Joint pain relief and arthritis management programs</p>
            </div>
            <div class="disease-card">
                <h4>Migraine</h4>
                <p>Headache treatment and migraine prevention strategies</p>
            </div>
            <div class="disease-card">
                <h4>Thyroid Disorder</h4>
                <p>Thyroid disease diagnosis and comprehensive treatment</p>
            </div>
            <div class="disease-card">
                <h4>Skin Conditions</h4>
                <p>Dermatological care and skin disorder treatment</p>
            </div>
            <div class="disease-card">
                <h4>Anxiety & Depression</h4>
                <p>Mental health support and psychological counseling</p>
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
