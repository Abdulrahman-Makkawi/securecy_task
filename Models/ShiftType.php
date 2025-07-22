<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftType extends Model
{
    protected $fillable = [
        'shift_type', 'description',
        'rate_day', 'rate_night', 'rate_sat', 'rate_sun', 'rate_public_holiday'
    ];
}

