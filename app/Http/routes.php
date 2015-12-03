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
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
        return view('welcome');
});


Route::group(['prefix' => 'api/v1/user/'], function () {

    Route::get('confirm/{remember_token}','UsersController@confirm');
    Route::post('auth','Auth\AuthController@authenticate');
    Route::get('logout','Auth\AuthController@logout');
    Route::post('create','UsersController@storeUser');
    Route::put('my-profile/{remember_token}','UsersController@updateProfile');
    Route::post('class','ClassController@createClass');
    Route::put('class/{id}',array('uses' =>'ClassController@updateClass'));
    Route::get('class/{id}',array('uses' =>'ClassController@deleteClass'));
    Route::put('teacher-my-profile/{remember_token}','UsersController@updateTeacherProfile');//Teacher updating his own profile
    Route::put('student-my-profile/{remember_token}','UsersController@updateStudentProfile');//Student updating his own profile
    Route::put('update-student-profile/{remember_token}/{id}','UsersController@adminUpdateStudentProfile');// Admin can updateStudent profile
    Route::put('update-teacher-profile/{remember_token}/{id}','UsersController@adminUpdateTeacherProfile');//Admin can update Student profile
    Route::post('applyforleave/{remember_token}','UsersController@studentApplyForLeave');//Student can apply for date

});