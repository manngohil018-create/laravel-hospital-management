<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalDoctors = Doctor::count();
        $totalPatients = User::where('role', 'patient')->count();
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();

        // Monthly appointments data (DB-aware)
        $monthlyAppointments = Appointment::monthlyCounts();

        // Doctor statistics
        $doctorStats = Doctor::withCount('appointments')
            ->get();

        return view('admin.analytics.index', compact(
            'totalDoctors',
            'totalPatients',
            'totalAppointments',
            'pendingAppointments',
            'completedAppointments',
            'monthlyAppointments',
            'doctorStats'
        ));
    }
}
