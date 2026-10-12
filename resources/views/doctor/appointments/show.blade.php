@extends('layouts.doctor')

@section('content')
<div style="max-width:980px;margin:0 auto">
    <h1 style="margin-bottom:20px">Appointment Details</h1>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px">
        <div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.05)">
            <h2 style="margin-top:0;font-size:20px">Patient Information</h2>
            <p><strong>Name:</strong> {{ optional($appointment->patient)->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ optional($appointment->patient)->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ optional($appointment->patient)->phone ?? 'N/A' }}</p>
            <p><strong>Medical History:</strong></p>
            <p style="white-space:pre-wrap;color:#475569">{{ optional($appointment->patient)->medical_history ?? 'No history provided.' }}</p>
        </div>

        <div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.05)">
            <h2 style="margin-top:0;font-size:20px">Appointment</h2>
            <p><strong>Doctor:</strong> {{ optional($appointment->doctor)->name ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y H:i') }}</p>
            <p><strong>Status:</strong> <span style="padding:5px 10px;background:#eef2ff;color:#4338ca;border-radius:999px">{{ ucfirst($appointment->status) }}</span></p>
            <p><strong>Emergency:</strong> {{ $appointment->is_emergency ? 'Yes' : 'No' }}</p>
            @if($appointment->emergency_details)
                <p><strong>Emergency Notes:</strong> {{ $appointment->emergency_details }}</p>
            @endif
            <p><strong>Symptoms:</strong> {{ $appointment->disease_illness ?? 'Not provided' }}</p>
            <p><strong>Patient Notes:</strong> {{ $appointment->medical_history ?? 'Not provided' }}</p>
        </div>
    </div>

    <div style="background:#fff;padding:24px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.05)">
        <h2 style="margin-top:0;font-size:22px;margin-bottom:16px">Doctor Instructions and Prescription</h2>

        <form action="{{ route('doctor.appointment.update-notes', $appointment->id) }}" method="POST">
            @csrf

            <div style="margin-bottom:16px">
                <label for="status" style="display:block;font-weight:600;margin-bottom:8px">Appointment Status</label>
                <select name="status" id="status" style="width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:10px">
                    @foreach(['pending','confirmed','completed','cancelled'] as $statusOption)
                        <option value="{{ $statusOption }}" {{ $appointment->status === $statusOption ? 'selected' : '' }}>{{ ucfirst($statusOption) }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:16px">
                <label for="doctor_instructions" style="display:block;font-weight:600;margin-bottom:8px">Instructions for Patient</label>
                <textarea id="doctor_instructions" name="doctor_instructions" rows="5" style="width:100%;padding:14px;border:1px solid #cbd5e1;border-radius:10px">{{ old('doctor_instructions', $appointment->doctor_instructions) }}</textarea>
            </div>

            <div style="margin-bottom:16px">
                <label for="medicine_list" style="display:block;font-weight:600;margin-bottom:8px">Medicine List / Prescription</label>
                <textarea id="medicine_list" name="medicine_list" rows="4" placeholder="Example: Paracetamol 500mg, twice daily" style="width:100%;padding:14px;border:1px solid #cbd5e1;border-radius:10px">{{ old('medicine_list', $appointment->medicine_list) }}</textarea>
            </div>

            <button type="submit" style="background:#4f46e5;color:#fff;border:none;padding:14px 18px;border-radius:12px;cursor:pointer">Save Appointment Notes</button>
            <a href="{{ route('doctor.appointments') }}" style="margin-left:12px;color:#4f46e5;text-decoration:none;font-weight:600">Back to Appointments</a>
        </form>
    </div>
</div>
@endsection
