<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Show the doctor's dashboard with their details and appointments summary.
     */
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        if (! $user || ($user->role ?? '') !== 'doctor') {
            abort(403, 'Unauthorized.');
        }

        // Basic stats for doctor
        $totalAppointments = \App\Models\Appointment::where('doctor_id', $user->id)->count();
        $upcoming = \App\Models\Appointment::where('doctor_id', $user->id)->whereIn('status', ['pending','confirmed'])->count();
        $completed = \App\Models\Appointment::where('doctor_id', $user->id)->where('status', 'completed')->count();

        // Paginated appointments list (most recent first)
        $appointments = \App\Models\Appointment::with('patient')
            ->where('doctor_id', $user->id)
            ->orderBy('appointment_date', 'desc')
            ->paginate(8)
            ->withQueryString();

        return view('doctor.dashboard', compact('user', 'totalAppointments', 'upcoming', 'completed', 'appointments'));
    }
}
