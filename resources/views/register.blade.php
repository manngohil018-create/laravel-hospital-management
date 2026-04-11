<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lifecare Hospital - Register</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: 
    linear-gradient(rgba(0, 114, 255, 0.6), rgba(0, 198, 255, 0.6)),
    url('https://images.unsplash.com/photo-1586773860418-d37222d8fce3');
    background-size:cover;
    background-position:center;
}

.register-container{
    width:420px;
    padding:40px;
    border-radius:15px;
    background:rgba(255,255,255,0.95);
    box-shadow:0 10px 40px rgba(0,0,0,0.3);
    text-align:center;
}

.register-container h2{
    margin-bottom:20px;
    color:#0072ff;
}

.input-group{
    position:relative;
    margin-bottom:18px;
}

.input-group input{
    width:100%;
    padding:12px 40px;
    border:1px solid #ccc;
    border-radius:30px;
    outline:none;
    transition:0.3s;
}

.input-group input:focus{
    border-color:#0072ff;
    box-shadow:0 0 5px rgba(0,114,255,0.5);
}

.input-group i{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    color:#0072ff;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:30px;
    background:linear-gradient(to right,#00c6ff,#0072ff);
    color:#fff;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    transform:scale(1.05);
}

.footer-text{
    margin-top:15px;
    font-size:14px;
}

.footer-text a{
    color:#0072ff;
    text-decoration:none;
}

.is-invalid{
    border:2px solid red !important;
}

</style>
</head>
<body>

<div class="register-container">
    <h2><i class="fa-solid fa-hospital"></i> Lifecare Register</h2>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <!-- Username -->
        <div class="input-group">
            <i class="fa-solid fa-id-card"></i>
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
        </div>
        @error('username')
           <small style="color:red;">{{ $message }}</small>
        @enderror

        <!-- Email -->
        <div class="input-group">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
        </div>
        @error('email')
           <small style="color:red;">{{ $message }}</small>
        @enderror

        <!-- Password -->
        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        @error('password')
           <small style="color:red;">{{ $message }}</small>
        @enderror

        <!-- Confirm Password -->
        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        @error('password_confirmation')
           <small style="color:red;">{{ $message }}</small>
        @enderror

        <button type="submit">Create Account</button>

        <div class="footer-text">
            Already have an account?
            <a href="{{ route('login') }}">Login Here</a>
        </div>

    </form>
</div>

</body>
</html>
