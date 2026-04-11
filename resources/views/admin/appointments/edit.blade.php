@extends('layouts.admin')

@section('content')
<style>
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: 0 auto;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
    }
    input, select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
    }
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
    }
    .btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: transform 0.2s;
    }
    .btn:hover {
        transform: translateY(-2px);
    }
    .btn-secondary {
        background: #ccc;
        color: #333;
        margin-left: 10px;
    }
</style>

<div class="form-container">
    <h2>✏️ Edit Appointment</h2>

    <form method="POST" action="{{ route('admin.appointments.update', $appointment->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Patient</label>
            <input type="text" value="{{ $appointment->patient->name ?? 'N/A' }}" disabled>
        </div>

        <div class="form-group">
            <label>Doctor</label>
            <input type="text" value="{{ $appointment->doctor->name ?? 'N/A' }}" disabled>
        </div>

        <div class="form-group">
            <label>Appointment Date</label>
            <input type="text" value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y, h:i A') }}" disabled>
        </div>

        <div class="form-group">
            <label>Emergency</label>
            <input type="text" value="{{ $appointment->is_emergency ? 'Yes' : 'No' }}" disabled>
        </div>

        @if($appointment->is_emergency && $appointment->emergency_details)
            <div class="form-group">
                <label>Emergency Details</label>
                <textarea disabled style="min-height: 120px;">{{ $appointment->emergency_details }}</textarea>
            </div>
        @endif

        <div class="form-group">
            <label>Status</label>
            <select name="status" id="status" required>
                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="form-group" id="completionDescriptionGroup" style="display: {{ $appointment->status == 'completed' ? 'block' : 'none' }};">
            <label>Completion Description</label>
            <textarea name="completion_description" style="min-height: 120px;">{{ old('completion_description', $appointment->completion_description) }}</textarea>
            <p style="font-size: 13px; color: #555; margin-top: 8px;">Add a note for the patient when marking this appointment as completed.</p>
        </div>

        <button type="submit" class="btn">Update Status</button>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const status = document.getElementById('status');
        const completionGroup = document.getElementById('completionDescriptionGroup');

        status.addEventListener('change', function() {
            completionGroup.style.display = this.value === 'completed' ? 'block' : 'none';
        });
    });
</script>

@endsection
