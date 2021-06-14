<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::namespace('Api')->middleware('api')->group(function () {

    // user registration api route
    Route::post('/register','AuthController@register')->name('user.register');

    // user login api route
    Route::post('/login','AuthController@login')->name('user.login');

    
});

Route::namespace('Api')->middleware('auth:api')->group(function () {
   
   Route::post('/khoj','KhojController@khoj')->name('user.khoj');

   Route::get('/getallinput','KhojController@getAllInput')->name('user.getinput');
    
});