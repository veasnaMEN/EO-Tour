<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'price',
        'description',
        'status',

    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
