<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create($doctorId = null)
    {
        $doctors = Doctor::all();
        $selectedDoctor = null;
        if ($doctorId) {
            $selectedDoctor = Doctor::find($doctorId);
        }

        return view('book-appointment', compact('doctors', 'selectedDoctor'));
    }

    public function availableSlots(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date_format:Y-m-d',
            'is_emergency' => 'nullable|boolean',
        ]);

        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        $isEmergency = $request->boolean('is_emergency');
        $now = Carbon::now();

        $startTime = $isEmergency ? $date->copy()->setTime(0, 0, 0) : $date->copy()->setTime(9, 0, 0);
        $endTime = $isEmergency ? $date->copy()->setTime(23, 40, 0) : $date->copy()->setTime(21, 0, 0);

        $slots = [];
        for ($slot = $startTime->copy(); $slot->lte($endTime); $slot->addMinutes(20)) {
            if ($date->isToday() && $slot->lte($now)) {
                continue;
            }

            $slots[] = [
                'time' => $slot->format('H:i'),
                'label' => $slot->format('h:i A'),
                'available' => true,
            ];
        }

        $doctorAppointments = Appointment::where('doctor_id', $request->doctor_id)
            ->whereDate('appointment_date', $date->toDateString())
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        $userAppointments = collect();
        if (Auth::check()) {
            $userAppointments = Appointment::where('patient_id', Auth::id())
                ->whereDate('appointment_date', $date->toDateString())
                ->where('status', '!=', 'cancelled')
                ->get();
        }

        foreach ($slots as &$slot) {
            $slotTime = Carbon::createFromFormat('Y-m-d H:i', $date->format('Y-m-d').' '.$slot['time']);

            foreach ($doctorAppointments as $appointment) {
                $appointmentTime = Carbon::parse($appointment->appointment_date);
                if (abs($slotTime->diffInMinutes($appointmentTime, false)) <= 20) {
                    $slot['available'] = false;
                    break;
                }
            }

            if ($slot['available']) {
                foreach ($userAppointments as $appointment) {
                    $appointmentTime = Carbon::parse($appointment->appointment_date);
                    if (abs($slotTime->diffInMinutes($appointmentTime, false)) <= 20) {
                        $slot['available'] = false;
                        break;
                    }
                }
            }
        }

        return response()->json(['slots' => $slots]);
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

        if (! $isEmergency) {
            $openingTime = $appointmentCarbon->copy()->setTime(9, 0, 0);
            $closingTime = $appointmentCarbon->copy()->setTime(21, 0, 0);

            if ($appointmentCarbon->lt($openingTime) || $appointmentCarbon->gt($closingTime)) {
                return redirect()->back()
                    ->with('error', 'Regular appointments can only be booked between 9:00 AM and 9:00 PM. Please choose a time within this range.')
                    ->withInput();
            }

            if ($appointmentCarbon->isSameDay(Carbon::today()) && $appointmentCarbon->lte(Carbon::now())) {
                return redirect()->back()
                    ->with('error', 'Please choose a future time for today. Regular appointments can be booked today between 9:00 AM and 9:00 PM.')
                    ->withInput();
            }

            if ($appointmentCarbon->isAfter(Carbon::today()->setTime(21,0,0)) && $appointmentCarbon->diffInDays(Carbon::today()) === 0) {
                return redirect()->back()
                    ->with('error', 'Today’s booking window has closed. Please choose another day between 9:00 AM and 9:00 PM, or select Emergency Appointment if urgent.')
                    ->withInput();
            }
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

