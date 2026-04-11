<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentAppointments = Appointment::with(['doctor', 'patient'])
            ->orderBy('appointment_date', 'desc')
            ->limit(10)
            ->get();
            
        return view('admin.dashboard', compact('recentAppointments'));
    }
}
