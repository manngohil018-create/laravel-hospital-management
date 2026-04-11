@extends('layouts.admin')

@section('content')
<style>
    .coming-soon-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        flex-direction: column;
        text-align: center;
    }

    .coming-soon-box {
        background: var(--bg-primary);
        padding: 60px 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        max-width: 500px;
    }

    .coming-soon-icon {
        font-size: 80px;
        color: #003D7A;
        margin-bottom: 20px;
    }

    .coming-soon-box h1 {
        font-size: 36px;
        color: var(--text-primary);
        margin-bottom: 15px;
        font-weight: 700;
    }

    .coming-soon-box p {
        font-size: 16px;
        color: var(--text-secondary);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .coming-soon-btn {
        background: linear-gradient(135deg, #003D7A 0%, #0066CC 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .coming-soon-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 61, 122, 0.3);
    }
</style>

<div class="coming-soon-container">
    <div class="coming-soon-box">
        <div class="coming-soon-icon">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <h1>Coming Soon</h1>
        <p>The calendar feature is currently under development. We're working hard to bring you an amazing scheduling experience.</p>
        <p style="font-size: 14px; color: #999;">Stay tuned for updates!</p>
        <a href="{{ route('admin.dashboard') }}" class="coming-soon-btn">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>

@endsection
