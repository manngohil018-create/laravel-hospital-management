<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables')->bootstrap($app);
$app->make('Illuminate\Foundation\Bootstrap\RegisterProviders')->bootstrap($app);
$app->make('Illuminate\Foundation\Bootstrap\BootProviders')->bootstrap($app);

use App\Models\Appointment;

echo "\n=== BOOKED APPOINTMENTS ===\n\n";

$appointments = Appointment::with(['patient', 'doctor'])->get();

if($appointments->isEmpty()) {
    echo "No appointments found.\n";
} else {
    echo sprintf("%-25s | %-20s | %-20s | %-12s\n", 'Patient', 'Doctor', 'Date & Time', 'Status');
    echo str_repeat("-", 85) . "\n";
    
    foreach($appointments as $apt) {
        echo sprintf("%-25s | %-20s | %-20s | %-12s\n", 
            substr($apt->patient->name, 0, 24),
            substr($apt->doctor->name, 0, 19),
            $apt->appointment_date,
            $apt->status
        );
    }
}

echo "\nTotal Appointments: " . $appointments->count() . "\n\n";
?>
