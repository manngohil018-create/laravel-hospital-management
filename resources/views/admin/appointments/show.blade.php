@extends('layouts.admin')

@section('content')
<div style="max-width:900px;margin:20px auto">
    <h2>Appointment Details</h2>

    @if(session('success'))
        <div style="background:#d1fae5;padding:12px;border-radius:6px;margin-bottom:12px;color:#065f46">{{ session('success') }}</div>
    @endif

    <div style="background:#fff;padding:16px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.05)">
        <p><strong>ID:</strong> {{ $appointment->id }}</p>
        <p><strong>Patient:</strong> {{ optional($appointment->patient)->name ?? 'N/A' }} ({{ optional($appointment->patient)->email ?? '' }})</p>
        <p><strong>Doctor:</strong> {{ optional($appointment->doctor)->name ?? 'N/A' }} ({{ optional($appointment->doctor)->email ?? '' }})</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
        <p><strong>Emergency:</strong> {{ $appointment->is_emergency ? 'Yes' : 'No' }}</p>
        @if($appointment->is_emergency && $appointment->emergency_details)
            <p><strong>Emergency Details:</strong> {{ $appointment->emergency_details }}</p>
        @endif

        @if($appointment->completion_description)
            <p><strong>Completion Description:</strong> {{ $appointment->completion_description }}</p>
        @endif
        
        @if($appointment->disease_illness)
            <p><strong>Disease/Illness:</strong> {{ $appointment->disease_illness }}</p>
        @endif
        
        @if($appointment->medical_history)
            <p><strong>Medical History:</strong> {{ $appointment->medical_history }}</p>
        @endif

        <div style="margin-top:12px">
            <a href="{{ route('admin.appointments.index') }}" class="btn">Back to list</a>
        </div>
    </div>
</div>
@endsection
