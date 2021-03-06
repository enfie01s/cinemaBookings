<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['customer_id', 'showing_id', 'seats'];
    /**
     * Get the showing for the booking.
     */
    public function showing()
    {
        return $this->belongsTo('App\Showing');
    }

    protected $casts = [
        'seats' => 'array'
    ];
}
