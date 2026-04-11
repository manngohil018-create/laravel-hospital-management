<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'completion_description' => 'nullable|string|max:2000',
        ]);

        $oldStatus = $appointment->status;
        $newStatus = $request->status;

        $appointment->update([
            'status' => $newStatus,
            'completion_description' => $request->completion_description,
        ]);

        // If status changed to completed and there's disease_illness, append to user's medical_history
        if ($oldStatus !== 'completed' && $newStatus === 'completed' && !empty($appointment->disease_illness)) {
            $user = $appointment->patient;
            $currentHistory = $user->medical_history ?? '';
            $newEntry = now()->format('Y-m-d') . ": " . trim($appointment->disease_illness);
            // Check if this entry already exists to prevent duplicates
            if (strpos($currentHistory, $newEntry) === false) {
                $updatedHistory = empty($currentHistory) ? $newEntry : $currentHistory . "\n" . $newEntry;
                $user->update(['medical_history' => $updatedHistory]);
            }
        }

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->back()->with('success', 'Appointment deleted successfully');
    }
}
