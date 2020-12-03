<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    public $timestamps = false;

    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor');
    }

    public function patient()
    {
        return $this->hasOne('App\Models\Patient');
    }


    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'start_time',
        'end_time',
        'extra_info',
    ];
}
