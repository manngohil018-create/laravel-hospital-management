@auth
<section class="user-profile-section" id="profile">
    <div class="profile-container">
        <div class="profile-header">
            <h2><i class="fas fa-user-circle"></i> Profile</h2>
        </div>
        
        <div class="profile-content">
            <!-- Profile Information -->
            <div class="profile-card">
                <h3><i class="fas fa-user"></i> Your Profile</h3>
                
                <div class="profile-item">
                    <div class="profile-item-label">Full Name</div>
                    <div class="profile-item-value">{{ Auth::user()->name }}</div>
                </div>
                
                <div class="profile-item">
                    <div class="profile-item-label">Email Address</div>
                    <div class="profile-item-value">{{ Auth::user()->email }}</div>
                </div>
                
                <div class="profile-item">
                    <div class="profile-item-label">Phone Number</div>
                    <div class="profile-item-value">{{ Auth::user()->phone ?? 'Not provided' }}</div>
                </div>
                
                <div class="profile-item">
                    <div class="profile-item-label">Account Type</div>
                    <div class="profile-item-value">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
                
                <div class="profile-item">
                    <div class="profile-item-label">Member Since</div>
                    <div class="profile-item-value">{{ Auth::user()->created_at->format('d M, Y') }}</div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('book-appointment') }}" class="btn-action btn-action-primary">
                        <i class="fas fa-calendar"></i> Book Appointment
                    </a>
                </div>
            </div>

            <!-- Medical Information -->
            <div class="profile-card">
                <h3><i class="fas fa-heartbeat"></i> Medical Information</h3>
                
                <div class="profile-item">
                    <div class="profile-item-label">Disease/Illness</div>
                    <div class="profile-item-value" style="white-space: pre-wrap;">{{ Auth::user()->disease_illness ?? 'Not provided' }}</div>
                </div>
                
                <div class="profile-item">
                    <div class="profile-item-label">Medical History</div>
                    <div class="profile-item-value" style="white-space: pre-wrap;">{{ Auth::user()->medical_history ?? 'Not provided' }}</div>
                </div>
            </div>

            <!-- Appointments Summary -->
            <div class="profile-card">
                <h3><i class="fas fa-calendar-check"></i> Your Appointments</h3>
                
                <div class="appointments-summary">
                    <h4>Appointment Summary</h4>
                    <div class="appointment-stat">
                        <strong>Total Appointments:</strong>
                        <span class="value">{{ \App\Models\Appointment::where('patient_id', Auth::id())->count() }}</span>
                    </div>
                    <div class="appointment-stat">
                        <strong>Pending:</strong>
                        <span class="value">{{ \App\Models\Appointment::where('patient_id', Auth::id())->where('status', 'pending')->count() }}</span>
                    </div>
                    <div class="appointment-stat">
                        <strong>Confirmed:</strong>
                        <span class="value">{{ \App\Models\Appointment::where('patient_id', Auth::id())->where('status', 'confirmed')->count() }}</span>
                    </div>
                    <div class="appointment-stat">
                        <strong>Completed:</strong>
                        <span class="value">{{ \App\Models\Appointment::where('patient_id', Auth::id())->where('status', 'completed')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth
