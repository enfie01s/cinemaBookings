<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Movie routes
Route::get('movies', 'MovieController@indexApi');
Route::get('movies/{movie}', 'MovieController@showApi');
Route::post('movies', 'MovieController@storeApi');
Route::put('movies/{movie}', 'MovieController@updateApi');
Route::delete('movies/{movie}', 'MovieController@deleteApi');

// Customer routes
Route::get('customers', 'CustomerController@indexApi');
Route::get('customers/{customer}', 'CustomerController@showApi');
Route::post('customers', 'CustomerController@storeApi');
Route::put('customers/{customer}', 'CustomerController@updateApi');
Route::delete('customers/{customer}', 'CustomerController@deleteApi');

// Showing routes
Route::get('showings', 'ShowingController@indexApi');
Route::get('showings/{showing}', 'ShowingController@showApi');
Route::post('showings', 'ShowingController@storeApi');
Route::put('showings/{showing}', 'ShowingController@updateApi');
Route::delete('showings/{showing}', 'ShowingController@deleteApi');

// Booking routes
Route::get('bookings', 'BookingController@indexApi');
Route::get('bookings/{booking}', 'BookingController@showApi');
Route::post('bookings', 'BookingController@storeApi');
Route::put('bookings/{booking}', 'BookingController@updateApi');
Route::delete('bookings/{booking}', 'BookingController@deleteApi');
