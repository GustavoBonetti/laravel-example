<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = ['date', 'time', 'status_id', 'doctor_id', 'patient_id', 'user_id'];

    public function status()
    {
        return $this->belongsTo('App\StatusSchedule', 'status_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor', 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
