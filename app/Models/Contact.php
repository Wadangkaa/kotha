<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_no',
        'email'
    ];

    function kotha(){
        return $this->belongsTo(kotha::class);
    }
}
