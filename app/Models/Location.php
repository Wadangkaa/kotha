<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Kotha;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'district',
        'city',
        'street'
    ];

    function kotha(){
        return $this->belongsTo(kotha::class);
    }
}
