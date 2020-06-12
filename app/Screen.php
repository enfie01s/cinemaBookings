<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    /**
     * Get the showings for the screen.
     */
    public function showings()
    {
        return $this->belongsTo('App\Showing');
    }
}
