<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        
        return view('admin.calendar.index', compact('doctors', 'statuses', 'appointments'));
    }

    public function getEvents(Request $request)
    {
        $doctorId = $request->query('doctor_id');
        $status = $request->query('status');

        $query = Appointment::with(['patient', 'doctor']);

        if ($doctorId) {
            $query->where('doctor_id', $doctorId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $appointments = $query->get();
        
        $events = $appointments->map(function ($appointment) {
            $appointmentDateTime = Carbon::parse($appointment->appointment_date);
            $patientName = $appointment->patient->name ?? 'Unknown';
            $doctorName = $appointment->doctor->name ?? 'Unknown';
            $time = $appointmentDateTime->format('H:i');
            $displayStatus = method_exists($appointment, 'getDisplayStatus') ? $appointment->getDisplayStatus() : ($appointment->status ?? 'pending');
            
            return [
                'id' => $appointment->id,
                'title' => ($appointment->is_emergency ? 'EMERGENCY: ' : '') . "{$time} - {$patientName} with {$doctorName}",
                'start' => $appointment->appointment_date,
                'end' => $appointmentDateTime->copy()->addMinutes(30)->toDateTimeString(),
                'extendedProps' => [
                    'status' => $displayStatus,
                    'patient_id' => $appointment->patient_id,
                    'doctor_id' => $appointment->doctor_id,
                    'patient_name' => $patientName,
                    'patient_phone' => $appointment->patient->phone ?? 'N/A',
                    'doctor_name' => $doctorName,
                    'time' => $time,
                    'date' => $appointmentDateTime->format('d M Y'),
                    'is_emergency' => $appointment->is_emergency,
                    'emergency_details' => $appointment->emergency_details,
                ],
                'backgroundColor' => $this->getEventColor($displayStatus),
                'borderColor' => $this->getEventColor($displayStatus),
                'textColor' => '#fff',
                'className' => 'event-' . $displayStatus,
            ];
        });

        return response()->json($events);
    }

    private function getEventColor($status)
    {
        return match($status) {
            'pending' => '#ffc107',
            'confirmed' => '#17a2b8',
            'completed' => '#28a745',
            'cancelled' => '#dc3545',
            'expired' => '#6c757d',
            default => '#667eea',
        };
    }
}
