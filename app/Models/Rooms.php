<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building',
        'capacity',
        'description',
        'room_number',
        'status',
    ];

    public function events()
    {
        return $this->hasMany(Schedules::class);
    }
}
