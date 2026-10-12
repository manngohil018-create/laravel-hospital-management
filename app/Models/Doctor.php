<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'specialization',
        'email',
        'phone',
        'about',
        'photo',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function loginAccount()
    {
        return $this->hasOne(User::class, 'email', 'email')->where('role', 'doctor');
    }
}
