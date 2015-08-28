<?php

Route::group (['prefix' => env('APP_PREFIX', '')], function () {

    Route::get('/', [
        'as'         => 'home',
        //'middleware' => 'auth',
        'middleware' => 'auth.binary',
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

    // Registration with Binary routes...
    Route::get('/auth/binary', [
        'as' => 'login.binary',
        'uses' => 'Auth\AuthController@redirectToBinary'
    ]);
    Route::post('/auth/binary_callback', [
        'as' => 'login.binary.callback',
        'uses' => 'Auth\AuthController@handleBinaryCallback'
    ]);

    Route::group([ 'prefix' => 'api/v1' ], function () {
        Route::get('reviewrequest/my', 'ReviewRequestController@myReviewRequest');
        Route::get('reviewrequest/offered', 'ReviewRequestController@offeredReviewRequest');
        Route::get('myrequests', 'UserController@myRequests');
        Route::get('reviewrequest/offered_', 'ReviewRequestController@offeredReviewRequests');
        Route::get('reviewrequest/popular', 'ReviewRequestController@popularReviewRequests');
        Route::get('reviewrequest/last/{number}', 'ReviewRequestController@lastNReviewRequests');
        Route::get('reviewrequest/upcoming/{period}', 'ReviewRequestController@upcomingForPeriodReviewRequests');
        Route::get('reviewrequest/upcoming', 'ReviewRequestController@upcomingReviewRequests');
        Route::get('reviewrequest/high_rate', 'ReviewRequestController@highestRatedReviewRequests');
        Route::get('reviewrequest/group/{group_id}', 'ReviewRequestController@sortReviewRequestsByGroups');
        Route::get('reviewrequest/tag/{tag_id}', 'ReviewRequestController@sortReviewRequestsByTags');
        Route::get('reviewrequest/user/{user_id}', 'ReviewRequestController@sortReviewRequestsByUsers');
        Route::get('reviewrequest/{request_id}/checkvote', 'ReviewRequestController@checkVote');
        Route::get('reputationUp/{request_id}', 'ReviewRequestController@reputationUp');
        Route::get('reputationDown/{request_id}', 'ReviewRequestController@reputationDown');
        Route::get('usersforrequest/{request_id}', 'ReviewRequestController@usersForRequest');
        Route::resource('unreadnotifications', 'UserController@unreadNotifications');
        Route::get('users/high_rep', 'UserController@highRept');
        Route::get('reviewrequest/heigh_rep/{number}', 'ReviewRequestController@getHeighRept');
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
        Route::get('user/{user_id}/mailaccept/{request_id}', 'UserController@mailAcceptReviewRequest');
        Route::get('user/{user_id}/maildecline/{request_id}', 'UserController@mailDeclineReviewRequest');
        Route::resource('group', 'GroupController');
        Route::get('tags/popular', 'TagController@popularTags');
        Route::resource('tag', 'TagController');
        Route::resource('badge', 'BadgeController');
        Route::post('tags/search', 'TagController@search');
        Route::get('checknotification', 'UserController@checkNotification');
    });
});
