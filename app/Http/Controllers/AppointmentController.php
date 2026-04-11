<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create()
    {
        $doctors = Doctor::all();
        return view('patient.appointment.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date_format:Y-m-d\TH:i',
            'phone' => 'required|digits:10',
            'is_emergency' => 'nullable|boolean',
            'emergency_details' => 'nullable|string|max:2000|required_if:is_emergency,1',
            'disease_illness' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        // Update user's information including phone
        Auth::user()->update([
            'phone' => $request->phone,
        ]);

        // Convert datetime-local format to datetime
        $appointmentDateTime = Carbon::parse($request->appointment_date)->format('Y-m-d H:i:s');
        $appointmentCarbon = Carbon::parse($appointmentDateTime);
        $isEmergency = $request->boolean('is_emergency');

        // Block Sunday bookings only for non-emergency requests
        $appointmentDay = $appointmentCarbon->format('l');
        if (! $isEmergency && strtolower($appointmentDay) === 'sunday') {
            return redirect()->back()
                ->with('error', 'Appointments cannot be booked on Sunday unless it is marked as an emergency. Please choose another day or select Emergency Appointment.')
                ->withInput();
        }

        // Regular appointments may only be booked from tomorrow 9:00 AM onward.
        $regularBookingStart = Carbon::now()->copy()->addDay()->setTime(9, 0, 0);
        if (! $isEmergency && $appointmentCarbon->lt($regularBookingStart)) {
            return redirect()->back()
                ->with('error', 'Regular appointments can only be booked from tomorrow 9:00 AM onward. For urgent care, select Emergency Appointment.')
                ->withInput();
        }

        // Do not allow appointments within 20 minutes of another appointment for the same user
        $windowStart = $appointmentCarbon->copy()->subMinutes(20);
        $windowEnd = $appointmentCarbon->copy()->addMinutes(20);

        $userAppointmentAtTime = Appointment::where('patient_id', Auth::id())
            ->whereBetween('appointment_date', [$windowStart, $windowEnd])
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($userAppointmentAtTime) {
            return redirect()->back()
                ->with('error', 'You already have an appointment within 20 minutes of this time. Please choose another time.')
                ->withInput();
        }

        // Do not allow the doctor to have another appointment within 20 minutes
        $doctorAppointmentAtTime = Appointment::where('doctor_id', $request->doctor_id)
            ->whereBetween('appointment_date', [$windowStart, $windowEnd])
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($doctorAppointmentAtTime) {
            return redirect()->back()
                ->with('error', 'This doctor already has an appointment within 20 minutes of the selected time. Please choose a different time.')
                ->withInput();
        }

        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $appointmentDateTime,
            'status' => 'pending',
            'is_emergency' => $isEmergency,
            'emergency_details' => $request->emergency_details,
            'disease_illness' => $request->disease_illness,
            'medical_history' => $request->medical_history,
        ]);

        // Get the doctor details for the success message
        $doctor = Doctor::find($request->doctor_id);
        $formattedDate = Carbon::parse($appointmentDateTime)->format('d M, Y h:i A');
        
        return redirect()->route('my-appointments')
            ->with('success', "Appointment successfully booked with Dr. {$doctor->name} on {$formattedDate}");
    }

    public function myAppointments()
    {
        $appointments = Appointment::where('patient_id', Auth::id())
            ->with(['doctor'])
            ->paginate(10);

        return view('patient.appointments.index', compact('appointments'));
    }

    public function doctorAppointments()
    {
        $doctor = Auth::user();
        
        if ($doctor->role !== 'doctor') {
            abort(403, 'Unauthorized');
        }

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->with(['patient'])
            ->paginate(10);

        return view('doctor.appointments.index', compact('appointments'));
    }
}

