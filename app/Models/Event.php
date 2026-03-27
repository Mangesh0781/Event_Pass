<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'venue', 
        'event_date', 
        'total_seats', 
        'booked_seats'
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function organizer()
{
    return $this->belongsTo(User::class, 'user_id');
}
}