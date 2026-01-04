<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function therapists()
    {
        return $this->belongsToMany(Therapist::class, 'therapist_services', 'service_id', 'therapist_id')
            ->withPivot([
                'rate',
                'status'
            ]);
    }
}
