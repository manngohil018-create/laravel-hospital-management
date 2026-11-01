<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_doctor_analytics_displays_counts_and_monthly_chart_data(): void
    {
        $doctor = Doctor::create([
            'name' => 'Dr. Analytics',
            'specialization' => 'Cardiology',
            'email' => 'analytics-doctor@example.com',
            'phone' => '1234567890',
        ]);

        $doctorUser = User::create([
            'username' => 'analytics-doctor',
            'name' => $doctor->name,
            'email' => $doctor->email,
            'password' => 'secret-password',
            'role' => 'doctor',
        ]);

        $patient = User::create([
            'username' => 'analytics-patient',
            'name' => 'Analytics Patient',
            'email' => 'analytics-patient@example.com',
            'password' => 'secret-password',
            'role' => 'patient',
        ]);

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => now()->startOfYear()->format('Y-m-d H:i:s'),
            'status' => 'pending',
        ]);

        $response = $this->actingAs($doctorUser)->get(route('doctor.analytics'));

        $response->assertOk()
            ->assertSee('Pending Appointments')
            ->assertSee('const monthlyValues = [1,0,0,0,0,0,0,0,0,0,0,0];', false);
    }
}
