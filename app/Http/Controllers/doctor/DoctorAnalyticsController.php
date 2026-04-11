<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAnalyticsController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();

        $totalAppointments = Appointment::where('doctor_id', $doctor->id)->count();
        $completedAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'completed')
            ->count();
        $pendingAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'pending')
            ->count();
        $cancelledAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'cancelled')
            ->count();

        // Monthly appointments data (DB-aware)
        $monthlyAppointments = Appointment::monthlyCounts($doctor->id);

        return view('doctor.analytics', compact(
            'totalAppointments',
            'completedAppointments',
            'pendingAppointments',
            'cancelledAppointments',
            'monthlyAppointments'
        ));
    }
}
