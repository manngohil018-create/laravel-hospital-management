<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if admin exists and credentials match
        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password) && $admin->is_active) {
            // Log in the admin
            Auth::login($admin, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Admin login successful!');
        }

        // Check if it's a patient/doctor using the User model
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();

            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            elseif($user->role == 'doctor'){
                return redirect()->route('doctor.dashboard');
            }
            else{
                return redirect()->route('patient.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->onlyInput('email');
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