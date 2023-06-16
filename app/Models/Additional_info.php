<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_info extends Model
{
  use HasFactory;

  protected $fillable = [
    'bedroom',
    'kitchen',
    'living_room',
    'parking',
    'toilet'
  ];
  function kotha()
  {
    return $this->belongsTo(kotha::class);
  }

  protected function getParkingAttribute($value)
  {
    return ($value == 1) ? 'Yes' : 'No';
  }
}
