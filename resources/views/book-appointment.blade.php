<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment - LifeCare Hospital</title>
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

/* Booking Section */
.booking {
    background: white;
}

.booking-content {
    max-width: 600px;
    margin: 0 auto;
}

.user-info {
    background: #f9f9f9;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
    border-left: 4px solid #667eea;
}

.user-info h3 {
    margin-bottom: 15px;
    color: #333;
}

.user-detail {
    margin: 10px 0;
    color: #666;
}

.user-detail strong {
    color: #333;
}

.login-prompt {
    background: #f0f0f0;
    padding: 40px;
    border-radius: 10px;
    text-align: center;
}

.login-prompt p {
    margin-bottom: 20px;
    font-size: 16px;
    color: #666;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.form-group select {
    background: white;
    cursor: pointer;
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

    .slot-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .slot-button {
        border: 1px solid #ddd;
        background: white;
        color: #333;
        padding: 10px 14px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 90px;
        text-align: center;
        font-weight: 600;
    }

    .slot-button.available:hover {
        border-color: #667eea;
        background: #eef2ff;
    }

    .slot-button.selected {
        background: #667eea;
        color: white;
        border-color: #5050d4;
    }

    .slot-button.unavailable {
        background: #f8f9fa;
        color: #999;
        border-color: #dee2e6;
        cursor: not-allowed;
    }

    .slot-placeholder {
        color: #666;
        margin: 10px 0;
    }

    .slot-message {
        margin-top: 10px;
        color: #555;
        font-size: 14px;
    }

    .slot-selected-label {
        margin-top: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    gap: 10px;
    font-weight: 600;
    font-size: 15px;
}

.emergency-checkbox input[type="checkbox"] {
    width: auto;
    margin: 0;
    transform: scale(1.05);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 32px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    max-width: 320px;
    margin: 0 auto;
    display: inline-flex;
    justify-content: center;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 10px rgba(102, 126, 234, 0.2);
}

.btn-secondary {
    background: white;
    color: #667eea;
    padding: 12px 20px;
    border: 2px solid #667eea;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-block;
    margin-right: 10px;
}

.btn-secondary:hover {
    background: #667eea;
    color: white;
}

.button-group {
    display: flex;
    gap: 10px;
    justify-content: center;
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

    .button-group {
        flex-direction: column;
    }

    .btn-secondary {
        margin-right: 0;
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

<!-- Booking Section -->
<section class="booking">
    <div class="container">
        <h2>Book an Appointment</h2>
        <div class="booking-content">

            @auth
                <!-- User Profile Info -->
                <div class="user-info">
                    <h3><i class="fas fa-user-circle"></i> Your Profile</h3>
                    <div class="user-detail">
                        <strong>Name:</strong> {{ Auth::user()->name }}
                    </div>
                    <div class="user-detail">
                        <strong>Email:</strong> {{ Auth::user()->email }}
                    </div>
                    <div class="user-detail">
                        <strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not provided' }}
                    </div>
                </div>

                <!-- Appointment Booking Form -->
                <form action="{{ route('appointment.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="doctor_id">Select Doctor</label>
                        <select name="doctor_id" id="doctor_id" required>
                            <option value="">-- Choose a Doctor --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ isset($selectedDoctor) && $selectedDoctor->id == $doctor->id ? 'selected' : '' }}>
                                     {{ $doctor->name }} - {{ $doctor->specialization }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="emergency-row">
                        <label class="emergency-checkbox">
                            <input type="checkbox" name="is_emergency" id="is_emergency" value="1" {{ old('is_emergency') ? 'checked' : '' }}>
                            Emergency Appointment
                        </label>
                        <p style="font-size: 14px; color: #555; margin-top: 0;">Select this if your condition requires urgent attention. Our team will prioritize review and response.</p>
                    </div>

                    <div class="form-group">
                        <label for="appointment_date_date">Select Date</label>
                        <input type="date" name="appointment_date_date" id="appointment_date_date" required
                               value="{{ old('appointment_date_date', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                               min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label>Select Time Slot</label>
                        <div id="slot-container" class="slot-container">
                            <p class="slot-placeholder">Choose a doctor and date to see available 20-minute slots.</p>
                        </div>
                        <input type="hidden" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" value="{{ Auth::user()->phone ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="disease_illness">Disease/Illness (if any)</label>
                        <textarea name="disease_illness" id="disease_illness" placeholder="Describe any current diseases or illnesses..." style="min-height: 80px;">{{ Auth::user()->disease_illness ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="medical_history">Medical History (Optional)</label>
                        <textarea name="medical_history" id="medical_history" placeholder="Previous surgeries, medications, allergies, etc..." style="min-height: 80px;">{{ Auth::user()->medical_history ?? '' }}</textarea>
                    </div>

                    <div class="form-group" id="emergencyDetailsGroup" style="display: {{ old('is_emergency') ? 'block' : 'none' }};">
                        <label for="emergency_details">Emergency Details</label>
                        <textarea name="emergency_details" id="emergency_details" placeholder="Describe your emergency symptoms or reason for urgent care..." style="min-height: 100px;">{{ old('emergency_details') }}</textarea>
                    </div>

                    @if ($errors->any())
                        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                            <strong><i class="fas fa-exclamation-circle"></i> Error:</strong>
                            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                            <strong><i class="fas fa-exclamation-circle"></i> Booking Error:</strong> {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div style="background: #d4edda; color: #155724; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 2px solid #28a745; border-left: 4px solid #28a745;">
                            <h4 style="margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-check-circle" style="font-size: 24px;"></i> Booking Successful!
                            </h4>
                            <p style="margin: 10px 0;">{{ session('success') }}</p>
                            <p style="margin: 10px 0; font-size: 14px;">Your appointment has been confirmed. A confirmation email has been sent to your registered email address.</p>
                            <a href="{{ route('my-appointments') }}" style="display: inline-block; margin-top: 10px; background: #155724; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 600;">
                                View My Appointments
                            </a>
                        </div>
                    @endif

                    <div style="background: #e3f2fd; color: #1565c0; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #1565c0;">
                        <i class="fas fa-info-circle"></i> <strong>Note:</strong> Regular appointments show available 20-minute slots between 9:00 AM and 9:00 PM. Emergency appointments are available around the clock and will show any open slot after the current time.
                    </div>

                    <button type="submit" class="btn-primary">Book Appointment</button>
                </form>

                <div style="margin-top: 20px; text-align: center;">
                    <a href="{{ route('my-appointments') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">
                        View My Appointments →
                    </a>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const emergencyCheckbox = document.getElementById('is_emergency');
                        const emergencyGroup = document.getElementById('emergencyDetailsGroup');
                        const appointmentDate = document.getElementById('appointment_date');
                        const appointmentDateInput = document.getElementById('appointment_date_date');
                        const doctorSelect = document.getElementById('doctor_id');
                        const slotContainer = document.getElementById('slot-container');
                        const slotUrl = '{{ route('appointment.available-slots') }}';
                        const selectedAppointment = appointmentDate.value;

                        function toggleEmergencyDetails() {
                            emergencyGroup.style.display = emergencyCheckbox.checked ? 'block' : 'none';
                        }

                        function pad(value) {
                            return value.toString().padStart(2, '0');
                        }

                        function setDateMin() {
                            const now = new Date();
                            const minDate = new Date(now);
                            if (now.getHours() >= 21) {
                                minDate.setDate(minDate.getDate() + 1);
                            }
                            appointmentDateInput.min = minDate.toISOString().split('T')[0];
                            if (!appointmentDateInput.value) {
                                appointmentDateInput.value = appointmentDateInput.min;
                            }
                        }

                        function renderSlots(slots) {
                            slotContainer.innerHTML = '';
                            if (!slots.length) {
                                slotContainer.innerHTML = '<p class="slot-placeholder">No available slots for the selected date and doctor. Please choose another day or select Emergency Appointment.</p>';
                                appointmentDate.value = '';
                                return;
                            }

                            let foundSelected = false;
                            const [oldDate, oldTime] = selectedAppointment ? selectedAppointment.split('T') : [null, null];

                            slots.forEach(function(slot) {
                                const button = document.createElement('button');
                                button.type = 'button';
                                button.className = 'slot-button ' + (slot.available ? 'available' : 'unavailable');
                                button.textContent = slot.label;
                                button.dataset.time = slot.time;

                                if (!slot.available) {
                                    button.disabled = true;
                                } else {
                                    button.addEventListener('click', function() {
                                        selectSlot(button);
                                    });
                                }

                                if (oldDate === appointmentDateInput.value && oldTime === slot.time && slot.available) {
                                    selectSlot(button);
                                    foundSelected = true;
                                }

                                slotContainer.appendChild(button);
                            });

                            if (!foundSelected) {
                                appointmentDate.value = '';
                            }
                        }

                        function selectSlot(button) {
                            const buttons = slotContainer.querySelectorAll('.slot-button');
                            buttons.forEach(function(btn) {
                                btn.classList.remove('selected');
                            });
                            button.classList.add('selected');
                            appointmentDate.value = appointmentDateInput.value + 'T' + button.dataset.time;
                        }

                        function showLoading() {
                            slotContainer.innerHTML = '<p class="slot-placeholder">Loading available slots...</p>';
                        }

                        function fetchSlots() {
                            if (!doctorSelect.value || !appointmentDateInput.value) {
                                slotContainer.innerHTML = '<p class="slot-placeholder">Choose a doctor and date to see available 20-minute slots.</p>';
                                appointmentDate.value = '';
                                return;
                            }

                            showLoading();
                            const params = new URLSearchParams({
                                doctor_id: doctorSelect.value,
                                date: appointmentDateInput.value,
                                is_emergency: emergencyCheckbox.checked ? 1 : 0,
                            });

                            fetch(`${slotUrl}?${params.toString()}`)
                                .then(function(response) {
                                    if (!response.ok) {
                                        throw new Error('Unable to load slots');
                                    }
                                    return response.json();
                                })
                                .then(function(data) {
                                    renderSlots(data.slots || []);
                                })
                                .catch(function() {
                                    slotContainer.innerHTML = '<p class="slot-placeholder">Unable to load slots. Please try again later.</p>';
                                });
                        }

                        appointmentDateInput.addEventListener('change', fetchSlots);
                        doctorSelect.addEventListener('change', fetchSlots);
                        emergencyCheckbox.addEventListener('change', function() {
                            toggleEmergencyDetails();
                            fetchSlots();
                        });

                        toggleEmergencyDetails();
                        setDateMin();
                        fetchSlots();
                    });
                </script>

            @else
                <!-- Login/Register Prompt -->
                <div class="login-prompt">
                    <i class="fas fa-lock" style="font-size: 50px; color: #667eea; margin-bottom: 20px; display: block;"></i>
                    <h3 style="margin-bottom: 15px;">Sign In to Book Appointment</h3>
                    <p>You need to be logged in to book an appointment. Please sign in or create a new account.</p>
                    
                    <div class="button-group">
                        <a href="{{ route('login') }}" class="btn-secondary">Login</a>
                        <a href="{{ route('register') }}" class="btn-secondary">Register</a>
                    </div>
                </div>
            @endauth

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
// Set minimum datetime to tomorrow at 9:00 AM for normal appointments.
// Emergency appointments can be booked immediately in the current datetime.
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('appointment_date');
    const emergencyCheckbox = document.getElementById('is_emergency');

    function formatDateTimeLocal(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    function setNormalMin() {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(9, 0, 0, 0);
        input.setAttribute('min', formatDateTimeLocal(tomorrow));
    }

    function setEmergencyMin() {
        const now = new Date();
        now.setMinutes(now.getMinutes() + 0);
        input.setAttribute('min', formatDateTimeLocal(now));
    }

    emergencyCheckbox.addEventListener('change', function() {
        if (emergencyCheckbox.checked) {
            setEmergencyMin();
        } else {
            setNormalMin();
        }
    });

    setNormalMin();
});
</script>

</body>
</html>
