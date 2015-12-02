<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* API Routes */
Route::group(['prefix' => 'api/v1/user/'], function () {
    Route::get('auth','UsersController@login');
    Route::put('my-profile/{remember_token}','UsersController@updateProfile');
});