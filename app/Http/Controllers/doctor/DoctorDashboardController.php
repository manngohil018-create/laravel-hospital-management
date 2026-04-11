<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();
        
        // Get doctor's appointments
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderBy('appointment_date', 'desc')
            ->paginate(8)
            ->withQueryString();

        $totalAppointments = Appointment::where('doctor_id', $doctor->id)->count();
        $pendingAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'pending')
            ->count();
        $completedAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'completed')
            ->count();

        // Map variable names used by the unified dashboard view
        $upcoming = $pendingAppointments;
        $completed = $completedAppointments;

        return view('doctor.dashboard', compact(
            'appointments',
            'totalAppointments',
            'upcoming',
            'completed'
        ));
    }

    public function updateAppointmentStatus(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $doctor = Auth::user();

        if ($appointment->doctor_id !== $doctor->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $oldStatus = $appointment->status;
        $newStatus = $request->status;

        $appointment->update(['status' => $newStatus]);

        // If status changed to completed and there's disease_illness, append to user's medical_history
        if ($oldStatus !== 'completed' && $newStatus === 'completed' && !empty($appointment->disease_illness)) {
            $user = $appointment->patient;
            $currentHistory = $user->medical_history ?? '';
            $newEntry = "\n" . now()->format('Y-m-d') . ": " . trim($appointment->disease_illness);
            $updatedHistory = $currentHistory . $newEntry;
            $user->update(['medical_history' => $updatedHistory]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Appointment status updated',
            ]);
        }

        return redirect()->back()->with('success', 'Appointment status updated.');
    }
}
