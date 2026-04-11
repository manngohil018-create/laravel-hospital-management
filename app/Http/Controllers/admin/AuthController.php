<?php

namespace App\Http\Controllers;

use  App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     // 🔹 REGISTER FUNCTION
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient'
        ]);

        return redirect()->route('login')
               ->with('success', 'Registration Successful! Please Login.');
    }

    // 🔹 LOGIN FUNCTION
    public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin.dashboard');
        }

        elseif(Auth::user()->role == 'doctor'){
            return redirect()->route('doctor.dashboard');
        }

        else{
            return redirect()->route('patient.dashboard');
        }
    }

    return back()->withErrors([
        'username' => 'Invalid Username or Password',
    ]);
}


    // 🔹 DASHBOARD
    public function dashboard()
    {
        return view('dashboard');
    }

    // 🔹 LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}