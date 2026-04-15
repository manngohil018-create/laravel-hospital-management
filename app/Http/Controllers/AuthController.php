<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient',
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ]);

        $login = $request->login;
        
        // First check if it's admin email
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $admin = Admin::where('email', $login)->first();
            if ($admin && Hash::check($request->password, $admin->password) && $admin->is_active) {
                Auth::login($admin);
                $request->session()->regenerate();
                return redirect('/admin/dashboard')->with('success', 'Admin login successful!');
            }
        }

        // Then check regular user credentials (email, phone, or username)
        $credentials = [];
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $login, 'password' => $request->password];
        } elseif (preg_match('/^\+?\d+$/', $login)) { // Check if it's a phone number
            $credentials = ['phone' => $login, 'password' => $request->password];
        } else {
            $credentials = ['username' => $login, 'password' => $request->password];
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect based on role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'doctor') {
                return redirect('/doctor/dashboard');
            } else {
                return redirect('/');
            }
        }

        return back()->withErrors(['login' => 'Invalid credentials. Please check your email/phone and password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'doctor') {
            return redirect('/doctor/dashboard');
        }

        return redirect('/');
    }
}
