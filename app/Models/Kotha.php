<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kotha extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description',
        'price',
        'additionalInfo',
        'user_id'
    ];

    function location()
    {
        return $this->hasOne(Location::class);
    }

    function contact()
    {
        return $this->hasOne(Contact::class);
    }

    function map()
    {
        return $this->hasOne(Map::class);
    }

    function additionalInfo()
    {
        return $this->hasOne(Additional_info::class);
    }
    
    function images()
    {
        return $this->hasMany(Image::class);
    }

    function payment(){
        return $this->hasOne(Payment::class);
    }
}
