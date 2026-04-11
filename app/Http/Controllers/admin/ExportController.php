<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportAppointments()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        
        $filename = 'appointments_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($appointments) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['Patient', 'Doctor', 'Date', 'Status']);
            
            // Add data
            foreach ($appointments as $appointment) {
                fputcsv($file, [
                    $appointment->patient->name ?? 'N/A',
                    $appointment->doctor->name ?? 'N/A',
                    $appointment->appointment_date,
                    $appointment->status,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportDoctors()
    {
        $doctors = Doctor::all();
        
        $filename = 'doctors_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($doctors) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['Name', 'Specialization', 'Email', 'Phone']);
            
            // Add data
            foreach ($doctors as $doctor) {
                fputcsv($file, [
                    $doctor->name,
                    $doctor->specialization,
                    $doctor->email,
                    $doctor->phone,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPatients()
    {
        $patients = User::where('role', 'patient')->get();
        
        $filename = 'patients_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($patients) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['Name', 'Email', 'Username']);
            
            // Add data
            foreach ($patients as $patient) {
                fputcsv($file, [
                    $patient->name,
                    $patient->email,
                    $patient->username,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
