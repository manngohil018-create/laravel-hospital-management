<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lifecare Hospital - Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

/* Hospital Background */
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

/* Login Card */
.login-container{
    width:400px;
    padding:40px;
    border-radius:15px;
    background:rgba(255,255,255,0.95);
    box-shadow:0 10px 40px rgba(0,0,0,0.3);
    text-align:center;
    animation:fadeIn 1s ease-in-out;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(-20px);}
    to{opacity:1; transform:translateY(0);}
}

.login-container h2{
    margin-bottom:25px;
    color:#0072ff;
}

/* Input Fields */
.input-group{
    position:relative;
    margin-bottom:20px;
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
    top:50%;
    left:15px;
    transform:translateY(-50%);
    color:#0072ff;
}

/* Button */
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

/* Footer */
.footer-text{
    margin-top:20px;
    font-size:14px;
}

.footer-text a{
    color:#0072ff;
    text-decoration:none;
}

.footer-text a:hover{
    text-decoration:underline;
}

</style>
</head>
<body>

<div class="login-container">
    <h2><i class="fa-solid fa-hospital"></i> Lifecare Login</h2>

   <form method="POST" action="{{ route('login.store') }}">
    @csrf

    <div class="input-group">
        <i class="fa-solid fa-user"></i>
        <input type="text" name="login" placeholder="Email, Phone, or Username" value="{{ old('login') }}" required>
    </div>

    <div class="input-group">
        <i class="fa-solid fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
    </div>

    @error('login')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    @error('password')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <button type="submit">Login</button>
</form>


        <div class="footer-text">
            Don’t have an account? 
            <a href="{{ route('register') }}">Register Here</a>
        </div>
    </form>
</div>

</body>
</html>
