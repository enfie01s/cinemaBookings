<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Showing extends Model
{
    protected $fillable = ['movie_id', 'start_at'];
    /**
     * Get the movie for the showing.
     */
    public function movie()
    {
        return $this->hasOne('App\Movie');
    }
}
