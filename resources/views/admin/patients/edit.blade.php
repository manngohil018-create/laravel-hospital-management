@extends('layouts.admin')

@section('content')
<style>
    .form-container {
        max-width: 700px;
        margin: 0 auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }

    .form-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
    }

    .form-header h2 {
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
        color: #333;
        transition: all 0.3s;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 8px rgba(102, 126, 234, 0.3);
        background: white;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
        grid-column: 1 / -1;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background: #e0e0e0;
        color: #333;
        flex: 1;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-secondary:hover {
        background: #d0d0d0;
    }

    .alert-error {
        background: #ffe8e8;
        color: #721c24;
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 20px;
        border: 1px solid #f8d7da;
    }

    .error-text {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2>
            <i class="fa-solid fa-user-edit"></i> Edit Patient
        </h2>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="margin: 8px 0 0 20px; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.patients.update', $patient->id) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="John Doe"
                    value="{{ old('name', $patient->name) }}"
                    required
                >
                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    placeholder="+1 (555) 000-0000"
                    value="{{ old('phone', $patient->phone) }}"
                >
                @error('phone')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="john@example.com"
                value="{{ old('email', $patient->email) }}"
                required
            >
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="disease_illness">Disease/Illness</label>
            <input 
                type="text" 
                id="disease_illness" 
                name="disease_illness" 
                placeholder="e.g., Diabetes, Hypertension"
                value="{{ old('disease_illness', $patient->disease_illness) }}"
            >
            @error('disease_illness')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="medical_history">Medical History</label>
            <textarea 
                id="medical_history" 
                name="medical_history" 
                placeholder="Enter patient's medical history, allergies, previous treatments, etc."
            >{{ old('medical_history', $patient->medical_history) }}</textarea>
            @error('medical_history')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Update Patient</button>
            <a href="{{ route('admin.patients') }}" class="btn btn-secondary">❌ Cancel</a>
        </div>
    </form>
</div>

@endsection
