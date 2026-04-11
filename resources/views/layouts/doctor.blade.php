<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard - Lifecare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    --text-primary: #333;
    --text-secondary: #666;
    --border-color: #e0e0e0;
}

body.dark-mode {
    --bg-primary: #1a1a1a;
    --bg-secondary: #2d2d2d;
    --text-primary: #e2e2e2;
    --text-secondary: #b0b0b0;
    --border-color: #444;
}

body {
    background-color: var(--bg-secondary);
    color: var(--text-primary);
    transition: background-color 0.3s, color 0.3s;
}

.container-fluid {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    width: 250px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    z-index: 1000;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.sidebar-menu {
    list-style: none;
}

.sidebar-menu li {
    margin: 10px 0;
}

.sidebar-menu a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 15px;
    border-radius: 5px;
    transition: all 0.3s;
}

.sidebar-menu a:hover,
.sidebar-menu a.active {
    background: rgba(255,255,255,0.2);
    padding-left: 20px;
}

.main-content {
    margin-left: 250px;
    width: calc(100% - 250px);
    display: flex;
    flex-direction: column;
}

.navbar {
    background: var(--bg-primary);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 1px solid var(--border-color);
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.navbar-brand {
    font-size: 18px;
    color: var(--text-primary);
    font-weight: 600;
}

.toggle-dark-mode {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: var(--text-primary);
    transition: transform 0.3s;
}

.toggle-dark-mode:hover {
    transform: rotate(20deg);
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-profile .dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 40px;
    right: 0;
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    min-width: 200px;
    display: none;
    z-index: 1000;
}

.dropdown-menu.active {
    display: block;
}

.dropdown-menu a {
    display: block;
    padding: 10px 15px;
    color: var(--text-primary);
    text-decoration: none;
    transition: background 0.3s;
}

.dropdown-menu a:hover {
    background: var(--bg-secondary);
}

.content {
    flex: 1;
    padding: 30px;
    background: var(--bg-secondary);
}

.logout-btn {
    background: #dc3545;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

.logout-btn:hover {
    background: #c82333;
}

.hamburger-menu {
    display: none;
    background: none;
    border: none;
    font-size: 24px;
    color: var(--text-primary);
    cursor: pointer;
}

@media(max-width: 768px) {
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: 250px;
        transform: translateX(-100%);
        transition: transform 0.3s;
        z-index: 999;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .main-content {
        margin-left: 0;
        width: 100%;
    }

    .hamburger-menu {
        display: block;
    }

    .content {
        padding: 15px;
    }

    .navbar {
        padding: 15px;
    }
}

/* Alert Messages */
.alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

body.dark-mode .alert-success {
    background: #1e4620;
    color: #90ee90;
    border-color: #2d5a2d;
}

body.dark-mode .alert-error {
    background: #4a1f1f;
    color: #ff6b6b;
    border-color: #6b2f2f;
}
</style>
</head>
<body>

<div class="container-fluid">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-hospital"></i> Lifecare
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('doctor.dashboard') }}" class="{{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('doctor.analytics') }}" class="{{ request()->routeIs('doctor.analytics') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i> Analytics
                </a>
            </li>
            <li>
                <a href="{{ route('doctor.appointments') }}" class="{{ request()->routeIs('doctor.appointments') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Appointments
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <button class="hamburger-menu" id="hamburger" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="navbar-brand">Doctor Portal</div>
            <div class="navbar-right">
                <button class="toggle-dark-mode" onclick="toggleDarkMode()">
                    <i class="fas fa-moon"></i>
                </button>
                <div class="user-profile">
                    <span>{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="content">
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
}

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode') ? 'true' : 'false');
}

// Check dark mode preference on page load
window.addEventListener('DOMContentLoaded', function() {
    if(localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }
});

// Close sidebar when clicking outside
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburger');
    
    if(!sidebar.contains(event.target) && !hamburger.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});
</script>

</body>
</html>
