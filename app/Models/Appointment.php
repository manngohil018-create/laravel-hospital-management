<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'status',
        'completion_description',
        'is_emergency',
        'emergency_details',
        'disease_illness',
        'medical_history',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Check if appointment is expired (date passed and not completed/confirmed)
     */
    public function isExpired()
    {
        return now() > $this->appointment_date && 
               !in_array($this->status, ['completed', 'confirmed']);
    }

    /**
     * Get the display status (includes expired check)
     */
    public function getDisplayStatus()
    {
        if ($this->isExpired()) {
            return 'expired';
        }
        return $this->status;
    }

    /**
     * Return counts for each month (Jan..Dec) as an array of 12 integers.
     * If $doctorId provided, filter by doctor_id.
     */
    public static function monthlyCounts($doctorId = null)
    {
        $driver = DB::getDriverName();
        $monthExpr = $driver === 'sqlite' ? "strftime('%m', appointment_date)" : "DATE_FORMAT(appointment_date, '%m')";

        $query = static::selectRaw("{$monthExpr} as month, COUNT(*) as count");
        if ($doctorId) {
            $query->where('doctor_id', $doctorId);
        }

        $rows = $query->groupBy('month')->orderBy('month')->get();
        $map = [];
        foreach ($rows as $r) {
            $m = intval($r->month);
            if ($m <= 0) continue;
            $map[$m] = intval($r->count);
        }

        $out = [];
        for ($i = 1; $i <= 12; $i++) {
            $out[] = $map[$i] ?? 0;
        }

        return $out;
    }

    /**
     * Count appointments for a specific month (1-12).
     */
    public static function countForMonth($month, $doctorId = null)
    {
        $month = intval($month);
        $mm = str_pad($month, 2, '0', STR_PAD_LEFT);
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            $raw = "strftime('%m', appointment_date) = ?";
        } else {
            $raw = "DATE_FORMAT(appointment_date, '%m') = ?";
        }
        $query = static::whereRaw($raw, [$mm]);
        if ($doctorId) {
            $query->where('doctor_id', $doctorId);
        }
        return $query->count();
    }
}
