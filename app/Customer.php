<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email'];
    /**
     * Get the bookings for the Customer.
     */
    public function bookings()
    {
        return $this->belongsTo('App\Booking');
    }
}
