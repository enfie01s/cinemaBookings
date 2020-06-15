<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome')->with(['title' => 'Movie list', 'active_home' => 'active']);
});

Route::resource('movies', 'MovieController');
