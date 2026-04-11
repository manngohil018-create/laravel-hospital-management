<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appointments = \App\Models\Appointment::with(['patient', 'doctor'])->latest()->take(5)->get();

        $this->info('Latest 5 Appointments:');
        $this->table(
            ['ID', 'Date', 'Status', 'Patient', 'Doctor', 'Emergency'],
            $appointments->map(function ($appointment) {
                return [
                    $appointment->id,
                    $appointment->appointment_date,
                    $appointment->status,
                    $appointment->patient ? $appointment->patient->name : 'NULL',
                    $appointment->doctor ? $appointment->doctor->name : 'NULL',
                    $appointment->is_emergency ? 'Yes' : 'No'
                ];
            })->toArray()
        );
    }
}
