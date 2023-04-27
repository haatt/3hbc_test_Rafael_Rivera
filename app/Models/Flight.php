<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'departure_time',
        'arrival_time',
        'departure_id',
        'destination_id',
        'airline_id',
    ];
}
