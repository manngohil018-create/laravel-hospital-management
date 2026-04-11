<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Lifecare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

:root {
    --bg-primary: #ffffff;
    --bg-secondary: #f4f7fc;
    --text-primary: #333333;
    --text-secondary: #666666;
    --border-color: #e0e0e0;
    --sidebar-bg: linear-gradient(to bottom,#003D7A,#0066CC);
    --sidebar-hover: rgba(255,255,255,0.2);
}


body{
    display:flex;
    background: var(--bg-secondary);
    transition: background 0.3s, color 0.3s;
    color: var(--text-primary);
}

.sidebar{
    width:260px;
    height:100vh;
    background: var(--sidebar-bg);
    padding:25px;
    position:fixed;
    color:white;
    overflow-y:auto;
    transition: all 0.3s;
    z-index: 999;
}



.sidebar h2{
    margin-bottom:30px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-left: 60px;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px;
    margin-bottom:10px;
    text-decoration:none;
    border-radius:8px;
    transition:0.3s;
}

.sidebar a:hover{
    background: var(--sidebar-hover);
}

.sidebar a.active{
    background:white;
    color:#003D7A;
    font-weight:600;
}

.toggle-btn {
    display: none !important;
}

.main{
    margin-left:260px;
    width:100%;
    padding:30px;
    background: var(--bg-secondary);
    transition: all 0.3s;
    color: var(--text-primary);
}

.main.expanded {
    margin-left: 0;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.topbar h1{
    font-size:24px;
}

.topbar-right {
    display: flex;
    gap: 15px;
    align-items: center;
}

.logout-btn{
    background:#ff4d4d;
    color:white;
    padding:8px 15px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    transition: all 0.3s;
}

.logout-btn:hover {
    background: #ff2020;
    transform: translateY(-2px);
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom: 40px;
}

.card{
    background: var(--bg-primary);
    padding:25px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
    border: 1px solid var(--border-color);
    color: var(--text-primary);
}

.card:hover{
    transform:translateY(-5px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
}

.card i{
    font-size:30px;
    color:#003D7A;
    margin-bottom:10px;
}

.card h3 {
    color: var(--text-primary);
    margin-bottom: 5px;
}

.card p {
    color: var(--text-secondary);
}

.charts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.chart-box {
    background: var(--bg-primary);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border: 1px solid var(--border-color);
}

.chart-box h3 {
    margin-bottom: 20px;
    color: var(--text-primary);
    font-size: 18px;
}

canvas {
    max-height: 300px;
}

@media (max-width: 768px) {
    .cards {
        grid-template-columns: 1fr;
    }

    .charts-container {
        grid-template-columns: 1fr;
    }

    .topbar {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }

    .topbar-right {
        width: 100%;
    }
}

</style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <h2><i class="fa-solid fa-hospital"></i> Lifecare</h2>

    <a href="{{ route('admin.dashboard') }}" 
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-chart-line"></i> Dashboard
    </a>

    <a href="{{ route('admin.doctors.index') }}"
       class="{{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
        <i class="fa-solid fa-user-doctor"></i> Doctors
    </a>

    <a href="{{ route('admin.appointments.index') }}"
       class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
        <i class="fa-solid fa-calendar-check"></i> Appointments
    </a>

    <a href="{{ route('admin.patients') }}"
       class="{{ request()->routeIs('admin.patients*') ? 'active' : '' }}">
        <i class="fa-solid fa-users"></i> Patients
    </a>

    <a href="{{ route('admin.calendar') }}"
       class="{{ request()->routeIs('admin.calendar') ? 'active' : '' }}">
        <i class="fa-solid fa-calendar"></i> Calendar
    </a>
</div>

<div class="main" id="main">

    <div class="topbar">
        <h1>Welcome Admin 👋</h1>

        <div class="topbar-right">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

   
    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

</script>

</body>
</html>
