<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function province()
    {
        return $this->hasOne(Province::class, 'province_id', 'id')->withDefault();
    }
    public function districts()
    {
        return $this->hasMany(District::class, 'id', 'regency_id');
    }
}
