<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function patient()
{
    return $this->belongsTo(Patient::class);
}

protected $fillable = ['patient_id', 'medications', 'notes'];
}
