<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['name', 'phone', 'age', 'notes'];
    public function appointments()
{
    return $this->hasMany(Appointment::class);
}

public function prescriptions()
{
    return $this->hasMany(Prescription::class);
}
}
