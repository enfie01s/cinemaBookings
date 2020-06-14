<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Get the showings for the screen.
     */
    public function bookings()
    {
        return $this->belongsTo('App\Booking');
    }
}
