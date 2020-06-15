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
Route::get('movies', 'MovieController@returnAll');
Route::get('movies/{movie}', 'MovieController@returnOne');
Route::post('movies', 'MovieController@storeViaApi');
Route::put('movies/{movie}', 'MovieController@updateViaApi');
Route::delete('movies/{movie}', 'MovieController@deleteViaApi');

// Customer routes
Route::get('customers', 'CustomerController@returnAll');
Route::get('customers/{customer}', 'CustomerController@returnOne');
Route::post('customers', 'CustomerController@storeViaApi');
Route::put('customers/{customer}', 'CustomerController@updateViaApi');
Route::delete('customers/{customer}', 'CustomerController@deleteViaApi');

// Showing routes
Route::get('showings', 'ShowingController@returnAll');
Route::get('showings/{showing}', 'ShowingController@returnOne');
Route::post('showings', 'ShowingController@storeViaApi');
Route::put('showings/{showing}', 'ShowingController@updateViaApi');
Route::delete('showings/{showing}', 'ShowingController@deleteViaApi');

// Booking routes
Route::get('bookings', 'BookingController@returnAll');
Route::get('bookings/{booking}', 'BookingController@returnOne');
Route::post('bookings', 'BookingController@storeViaApi');
Route::put('bookings/{booking}', 'BookingController@updateViaApi');
Route::delete('bookings/{booking}', 'BookingController@deleteViaApi');
