<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function appointment()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function workingHours()
    {
        return $this->hasMany('App\Models\WorkingHours');
    }

    public $timestamps = false;

    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'specialty',
    ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password',
    //     'role',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
