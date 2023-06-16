<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'district',
        'min_price',
        'max_price',
        'parking'
    ];

    protected function getParkingAttribute($value)
    {
        return ($value == 1) ? 'Yes' : 'No';
    }
}
