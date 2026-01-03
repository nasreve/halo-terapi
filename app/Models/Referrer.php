<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referrer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id')->withDefault();
    }

    public function therapist()
    {
        return $this->hasOne(Therapist::class, 'id', 'therapist_id')->withDefault();
    }

    /**
     * Relasi one to many dengan order
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'referrer_id', 'id');
    }

    /**
     * Mengambil nama terapis
     *
     * @return string
     */
    public function getReferrerName()
    {
        if ($this->therapist()->exists()) {
            return $this->therapist->name;
        }

        if ($this->patient()->exists()) {
            return $this->patient->name;
        }

        return "No Data Available";
    }
}
