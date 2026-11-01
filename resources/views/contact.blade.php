<!DOCTYPE html>
<html>
<head>
    <title>Contact - LifeCare Hospital</title>
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

/* Contact Section */
.contact {
    background: white;
}

.contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
}

.contact-info h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.hospital-info h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.contact-item {
    margin-bottom: 20px;
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.contact-icon {
    font-size: 24px;
    color: #667eea;
    width: 30px;
}

.contact-item p {
    color: #666;
}

.contact-item strong {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
}

.contact-form {
    max-width: 820px;
    margin: 55px auto 0;
    padding: 32px;
    border: 1px solid #dce5ed;
    border-radius: 8px;
    background: #f8fafc;
}

.contact-form h3 {
    margin-bottom: 8px;
    color: #003D7A;
    font-size: 24px;
}

.contact-form-intro {
    margin-bottom: 24px;
    color: #596579;
}

.contact-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.contact-form-field {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.contact-form-field-full {
    grid-column: 1 / -1;
}

.contact-form label {
    color: #24364b;
    font-weight: 600;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #b8c5d1;
    border-radius: 5px;
    background: #fff;
    color: #263445;
    font: inherit;
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #0066CC;
    outline: 3px solid rgba(0, 102, 204, 0.18);
}

.contact-form textarea {
    min-height: 150px;
    resize: vertical;
}

.contact-form-error {
    color: #b42318;
    font-size: 14px;
}

.contact-form-status {
    margin-bottom: 20px;
    padding: 12px 16px;
    border-radius: 5px;
}

.contact-form-success {
    background: #e8f5ee;
    color: #17663a;
}

.contact-form-submit {
    margin-top: 20px;
    padding: 12px 22px;
    border: 0;
    border-radius: 5px;
    background: #003D7A;
    color: #fff;
    font: inherit;
    font-weight: 600;
    cursor: pointer;
}

.contact-form-submit:focus-visible {
    outline: 3px solid #0066CC;
    outline-offset: 3px;
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

    .contact-content {
        grid-template-columns: 1fr;
    }

    .contact-form {
        padding: 22px;
    }

    .contact-form-grid {
        grid-template-columns: 1fr;
    }

    .contact-form-field-full {
        grid-column: auto;
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
@include('partials.diwali-chat-assistant')

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

<!-- Contact Section -->
<section class="contact">
    <div class="container">
        <h2>Get In Touch</h2>
        <div class="contact-content">
            <div class="contact-info">
                <h3>Contact Information</h3>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <p>📍 Address: Sardar Patel Statue Circle, Nathalal Colony, Naranpura, Ahmedabad, Gujarat 380009, India</p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <p>📞 Phone: +91-794-0204020 (Emergency & Appointments)</p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <p>lifecare.co.in</p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <p>Mon - Fri: 9:00 AM - 6:00 PM<br>Sat - Sun: 10:00 AM - 4:00 PM<br>Emergency: 24/7</p>
                </div>
            </div>
            <div class="hospital-info">
                <h3>About LifeCare Hospital</h3>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-building"></i></div>
                    <div>
                        <strong>Established</strong>
                        <p>Founded in 2020, LifeCare Hospital has been serving the community with compassion and excellence in healthcare.</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-stethoscope"></i></div>
                    <div>
                        <strong>Departments</strong>
                        <p>Cardiology • Neurology • Orthopedics • Oncology • General Surgery • Emergency Medicine • Pediatrics</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-bed"></i></div>
                    <div>
                        <strong>Facilities</strong>
                        <p>500+ Bed Capacity • Advanced ICU • Modern OT • 24/7 Laboratory • Imaging Services • Pharmacy</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Certifications</strong>
                        <p>NABH Accredited • ISO 9001:2015 Certified • JCI International Standards • WHO Recognition</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <strong>Expert Team</strong>
                        <p>Over 200 experienced doctors • Specialized nursing staff • Paramedical professionals • Dedicated support team</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-heart"></i></div>
                    <div>
                        <strong>Our Mission</strong>
                        <p>To provide high-quality, accessible healthcare services and improve the quality of life for our patients and community.</p>
                    </div>
                </div>
            </div>
        </div>

        <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <h3>Send Us a Message</h3>
            <p class="contact-form-intro">Send your message or question to LifeCare Hospital using this form.</p>

            @if (session('success'))
                <div class="contact-form-status contact-form-success" role="status">
                    {{ session('success') }}
                </div>
            @endif

            <div class="contact-form-grid">
                <div class="contact-form-field">
                    <label for="contact-name">Name</label>
                    <input id="contact-name" name="name" type="text" value="{{ old('name') }}" maxlength="120" required autocomplete="name" @error('name') aria-describedby="contact-name-error" aria-invalid="true" @enderror>
                    @error('name')
                        <span class="contact-form-error" id="contact-name-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="contact-form-field">
                    <label for="contact-email">Email</label>
                    <input id="contact-email" name="email" type="email" value="{{ old('email') }}" maxlength="255" required autocomplete="email" @error('email') aria-describedby="contact-email-error" aria-invalid="true" @enderror>
                    @error('email')
                        <span class="contact-form-error" id="contact-email-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="contact-form-field">
                    <label for="contact-phone">Phone <span>(optional)</span></label>
                    <input id="contact-phone" name="phone" type="tel" value="{{ old('phone') }}" maxlength="30" autocomplete="tel" @error('phone') aria-describedby="contact-phone-error" aria-invalid="true" @enderror>
                    @error('phone')
                        <span class="contact-form-error" id="contact-phone-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="contact-form-field">
                    <label for="contact-subject">Subject</label>
                    <input id="contact-subject" name="subject" type="text" value="{{ old('subject') }}" maxlength="150" required @error('subject') aria-describedby="contact-subject-error" aria-invalid="true" @enderror>
                    @error('subject')
                        <span class="contact-form-error" id="contact-subject-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="contact-form-field contact-form-field-full">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" maxlength="5000" required @error('message') aria-describedby="contact-message-error" aria-invalid="true" @enderror>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="contact-form-error" id="contact-message-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button class="contact-form-submit" type="submit">Send Message</button>
        </form>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <h3>LifeCare Hospital</h3>
        <p>Providing excellent healthcare services to our community since 2020</p>
        <p>&copy; 2026 LifeCare Hospital. All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>
