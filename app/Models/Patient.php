<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function appointment()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'national_id',
        'birth_date',
    ];
}
