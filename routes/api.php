<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Movie;

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

Route::get('movies', 'MovieApiController@index');
Route::get('movies/{movie}', 'MovieApiController@show');
Route::post('movies', 'MovieApiController@store');
Route::put('movies/{movie}', 'MovieApiController@update');
Route::delete('movies/{movie}', 'MovieApiController@delete');
