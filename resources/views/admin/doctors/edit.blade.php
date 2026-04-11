@extends('layouts.admin')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        background: var(--bg-primary);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-color);
    }

    .form-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }

    .form-header h2 {
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-primary);
        font-weight: 600;
        font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: all 0.3s;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    textarea:focus,
    select:focus {
        outline: none;
        border-color: #0072ff;
        box-shadow: 0 0 8px rgba(0, 114, 255, 0.3);
        background: var(--bg-secondary);
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
    }

    .btn {
        flex: 1;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 114, 255, 0.3);
    }

    .btn-secondary {
        background: var(--border-color);
        color: var(--text-primary);
    }

    .btn-secondary:hover {
        background: var(--bg-secondary);
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
            <i class="fa-solid fa-user-doctor"></i> Edit Doctor
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

    <form method="POST" action="{{ route('admin.doctors.update', $doctor->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Doctor Name *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="John Doe"
                value="{{ old('name', $doctor->name) }}"
                required
            >
            @error('name')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="specialization">Specialization *</label>
            <input 
                type="text" 
                id="specialization" 
                name="specialization" 
                placeholder="Cardiology, Neurology, etc."
                value="{{ old('specialization', $doctor->specialization) }}"
                required
            >
            @error('specialization')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="doctor@lifecare.com"
                value="{{ old('email', $doctor->email) }}"
                required
            >
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input 
                type="tel" 
                id="phone" 
                name="phone" 
                placeholder="+91 98765 43210"
                value="{{ old('phone', $doctor->phone) }}"
                required
            >
            @error('phone')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="about">About (Optional)</label>
            <textarea 
                id="about" 
                name="about" 
                placeholder="Enter doctor's biography or qualifications..."
            >{{ old('about', $doctor->about ?? '') }}</textarea>
            @error('about')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">Doctor Photo (optional)</label>
            @if(!empty($doctor->photo))
                <div style="margin-bottom:8px">
                    <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Doctor photo" style="max-width:120px;border-radius:6px;display:block">
                </div>
            @endif
            <input type="file" id="photo" name="photo" accept="image/*">
            @error('photo')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-check"></i> Update Doctor
            </button>
            <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Cancel
            </a>
        </div>
    </form>
</div>

@endsection
