<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapistArea extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function regency()
    {
        return $this->hasOne(Regency::class, 'id', 'regency_id');
    }
}
