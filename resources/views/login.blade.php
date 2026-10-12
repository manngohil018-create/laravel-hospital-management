<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifecare Hospital - Login</title>
    <style>
        :root {
            --navy-900: #0f172a;
            --navy-800: #16213e;
            --teal-700: #0f5438;
            --teal-600: #1d7a66;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-500: #64748b;
            --white: #ffffff;
            --danger: #b91c1c;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-800) 48%, var(--teal-700) 100%);
            font-family: Arial, Helvetica, sans-serif;
            color: var(--navy-900);
        }

        .auth-card {
            width: min(100%, 440px);
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 32px 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #eaf7f3;
            color: var(--teal-700);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .brand-copy {
            line-height: 1.2;
        }

        .brand-copy strong {
            display: block;
            font-size: 1.15rem;
        }

        .brand-copy span {
            color: var(--gray-500);
            font-size: 0.8rem;
        }

        h1 {
            margin: 0 0 22px;
            font-size: 2rem;
            color: var(--teal-700);
            text-align: center;
        }

        .message-text {
            margin: 0 0 16px;
            padding: 10px 12px;
            border-radius: 10px;
            background: #ecfdf5;
            color: #166534;
            font-size: 0.95rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--navy-800);
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 10px;
            font-size: 1rem;
            background: var(--white);
            color: var(--navy-900);
        }

        input:focus {
            border-color: var(--teal-600);
            outline: 3px solid rgba(29, 122, 102, 0.12);
        }

        .error-message {
            margin: -6px 0 0;
            color: var(--danger);
            font-size: 0.85rem;
        }

        .button-primary {
            width: 100%;
            border: none;
            border-radius: 10px;
            background: var(--teal-700);
            color: var(--white);
            padding: 12px 16px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
        }

        .button-primary:hover,
        .button-primary:focus {
            background: var(--teal-600);
        }

        .footer-text {
            margin: 20px 0 0;
            text-align: center;
            color: var(--gray-500);
            font-size: 0.95rem;
        }

        .footer-text a {
            color: var(--teal-700);
            font-weight: 700;
            text-decoration: none;
        }

        .footer-text a:hover,
        .footer-text a:focus {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand" aria-label="Lifecare branding">
            <div class="brand-mark">+</div>
            <div class="brand-copy">
                <strong>Lifecare</strong>
                <span>Hospital Access</span>
            </div>
        </div>

        <h1>Login</h1>

        @if (session('success'))
            <p class="message-text">{{ session('success') }}</p>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="field">
                <label for="login">Email, phone, or username</label>
                <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus>
            </div>
            @error('login')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <button type="submit" class="button-primary">Login</button>
        </form>

        <p class="footer-text">
            Don’t have an account? <a href="/register">Register</a>
        </p>
    </div>
</body>
</html>
