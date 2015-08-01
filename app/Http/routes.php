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

Route::resource('user', 'UserController');
Route::resource('comment', 'CommentController');
Route::resource('job', 'JobController');
Route::resource('department', 'DepartmentController');
Route::resource('reviewrequest', 'ReviewRequestController');
Route::resource('group', 'GroupController');
Route::resource('tag', 'TagController');
Route::resource('badge', 'BadgeController');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');