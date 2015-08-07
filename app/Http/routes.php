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
    return view('application');
});

Route::group (['prefix' => 'api/v1'], function () {
    Route::resource('user', 'UserController');
    Route::resource('comment', 'CommentController');
    Route::resource('job', 'JobController');
    Route::resource('department', 'DepartmentController');
    Route::resource('reviewrequest', 'ReviewRequestController');
    Route::get('reviewrequest/{id}/offers', 'ReviewRequestController@offers');
    Route::get('reviewrequest/{id}/tags', 'ReviewRequestController@tags');
    Route::get('user/{user_id}/offeredon/{request_id}/accept', 'UserController@acceptOfferOnReviewRequest');
    Route::get('user/{user_id}/offeredon/{request_id}/decline', 'UserController@declineOfferOnReviewRequest');
    Route::get('user/{user_id}/offeron/{request_id}', 'UserController@offerOnReviewRequest');
    Route::resource('group', 'GroupController');
    Route::resource('tag', 'TagController');
    Route::resource('badge', 'BadgeController');
});


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');