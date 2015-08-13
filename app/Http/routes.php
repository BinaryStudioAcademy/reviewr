<?php

Route::group (['prefix' => ''], function () {

    Route::get('/', [
        'as'         => 'home',
        'middleware' => 'auth',
        function () {
            return view('application');
        }
    ]);

    Route::get('/auth/login', [
        'as'   => 'login.get',
        'uses' => 'Auth\AuthController@getLogin'
    ]);
    Route::post('/auth/login', [
        'as'   => 'login.post',
        'uses' => 'Auth\AuthController@postLogin'
    ]);
    Route::get('/auth/logout', [
        'as'   => 'logout',
        'uses' => 'Auth\AuthController@getLogout'
    ]);

    Route::group([ 'prefix' => 'api/v1' ], function () {
        Route::get('reviewrequest/my', 'ReviewRequestController@myReviewRequest');
        Route::get('myrequests', 'UserController@myRequests');
        Route::get('usersforrequest/{request_id}', 'ReviewRequestController@usersForRequest');
        Route::resource('user', 'UserController');
        Route::resource('comment', 'CommentController');
        Route::resource('job', 'JobController');
        Route::resource('department', 'DepartmentController');
        Route::resource('reviewrequest', 'ReviewRequestController');
        Route::get('reviewrequest/{id}/offers', 'ReviewRequestController@offers');
        Route::get('reviewrequest/{id}/tags', 'ReviewRequestController@tags');
        Route::get('user/{user_id}/accept/{request_id}', 'UserController@acceptReviewRequest');
        Route::get('user/{user_id}/decline/{request_id}', 'UserController@declineReviewRequest');
        Route::get('user/{user_id}/offeron/{request_id}', 'UserController@offerOnReviewRequest');
        Route::get('user/offeroff/{request_id}', 'UserController@offerOffReviewRequest');
        Route::resource('group', 'GroupController');
        Route::resource('tag', 'TagController');
        Route::resource('badge', 'BadgeController');
        Route::post('tags/search', "TagController@search");
    });
});
