<?php

Route::group (['prefix' => env('APP_PREFIX', '')], function () {

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
        Route::get('reviewrequest/offered', 'ReviewRequestController@offeredReviewRequest');
        Route::get('myrequests', 'UserController@myRequests');
        Route::get('reviewrequest/offered_', 'ReviewRequestController@offeredReviewRequests');
        Route::get('reviewrequest/popular', 'ReviewRequestController@popularReviewRequests');
        Route::get('reviewrequest/high_rate', 'ReviewRequestController@highestRatedReviewRequests');
        Route::get('reviewrequest/group/{group_id}', 'ReviewRequestController@sortReviewRequestsByGroups');
        Route::get('reviewrequest/tag/{tag_id}', 'ReviewRequestController@sortReviewRequestsByTags');
        Route::get('reviewrequest/{request_id}/checkvote', 'ReviewRequestController@checkVote');
        Route::get('reputationUp/{request_id}', 'ReviewRequestController@reputationUp');
        Route::get('reputationDown/{request_id}', 'ReviewRequestController@reputationDown');
        Route::get('usersforrequest/{request_id}', 'ReviewRequestController@usersForRequest');
        Route::get('users/high_rep', 'UserController@highRept');
        Route::resource('user', 'UserController');
        Route::resource('/reviewrequest/{rid}/comment', 'CommentController');
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
        Route::get('tags/popular', 'TagController@popularTags');
        Route::resource('tag', 'TagController');
        Route::resource('badge', 'BadgeController');
        Route::post('tags/search', "TagController@search");
    });
});
