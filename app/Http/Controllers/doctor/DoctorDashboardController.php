<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = Doctor::where('email', Auth::user()->email)->firstOrFail();
        
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
        ))->with('user', Auth::user());
    }

    public function showAppointment($appointmentId)
    {
        $doctorUser = Auth::user();
        $doctor = Doctor::where('email', $doctorUser->email)->firstOrFail();

        $appointment = Appointment::with(['patient', 'doctor'])
            ->where('doctor_id', $doctor->id)
            ->findOrFail($appointmentId);

        return view('doctor.appointments.show', compact('appointment', 'doctorUser'));
    }

    public function updateDoctorNotes(Request $request, $appointmentId)
    {
        $doctor = Doctor::where('email', Auth::user()->email)->firstOrFail();
        $appointment = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->findOrFail($appointmentId);

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'doctor_instructions' => 'nullable|string|max:3000',
            'medicine_list' => 'nullable|string|max:3000',
        ]);

        $oldStatus = $appointment->status;
        $appointment->update([
            'status' => $request->status,
            'doctor_instructions' => $request->doctor_instructions,
            'medicine_list' => $request->medicine_list,
        ]);

        if ($oldStatus !== 'completed' && $request->status === 'completed' && !empty($appointment->disease_illness)) {
            $user = $appointment->patient;
            $currentHistory = $user->medical_history ?? '';
            $newEntry = "\n" . now()->format('Y-m-d') . ": " . trim($appointment->disease_illness);
            $updatedHistory = $currentHistory . $newEntry;
            $user->update(['medical_history' => $updatedHistory]);
        }

        return redirect()->route('doctor.appointment.show', $appointment->id)
            ->with('success', 'Appointment updated successfully.');
    }

    public function updateAppointmentStatus(Request $request, $appointmentId)
    {
        $doctor = Doctor::where('email', Auth::user()->email)->firstOrFail();
        $appointment = Appointment::where('doctor_id', $doctor->id)->findOrFail($appointmentId);

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
