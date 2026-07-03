<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function patient()
{
    return $this->belongsTo(Patient::class);
}

protected $fillable = ['patient_id', 'date', 'time', 'status'];

}
