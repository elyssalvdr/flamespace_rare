<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function events()
    {
        return $this->hasMany(Schedules::class);
    }
}
