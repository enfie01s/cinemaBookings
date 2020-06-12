<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Showing extends Model
{
    /**
     * Get the movie for the showing.
     */
    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }
    /**
     * Get the screen for the showing.
     */
    public function screen()
    {
        return $this->hasOne('App\Screen');
    }
}
