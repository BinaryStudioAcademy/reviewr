<?php

Route::group (['prefix' => env('APP_PREFIX', '')], function () {
    Route::get('/', [
        'as' => 'home',
//        'middleware' => 'auth',
        function () {
            return view('application');
        }
    ]);

    // Auth routes
    Route::get('/users/login', [
        'as'   => 'login.get',
        'uses' => 'Auth\AuthController@getLogin'
    ]);
    
    Route::get('/users/logout', [
        'as'   => 'logout',
        'uses' => 'Auth\AuthController@getLogout'
    ]);

    // Auth mockups
    Route::get('/auth-mock', 'Mockups\AuthController@auth');
    Route::get('/auth-mock/logout', 'Mockups\AuthController@logout');
    Route::get('/auth-mock/me/{binary_id}', 'Mockups\AuthController@profile');

    Route::group([ 'prefix' => 'api/v1' ], function () {
        Route::get(
            'reviewrequest/my',
            'ReviewRequestController@myReviewRequest'
        );
        Route::get(
            'reviewrequest/offered',
            'ReviewRequestController@offeredReviewRequest'
        );
        Route::get(
            'myrequests',
            'UserController@myRequests'
        );
        Route::get(
            'reviewrequest/offered_',
            'ReviewRequestController@offeredReviewRequests'
        );
        Route::get(
            'reviewrequest/popular',
            'ReviewRequestController@popularReviewRequests'
        );
        Route::get(
            'reviewrequest/last/{number}',
            'ReviewRequestController@lastNReviewRequests'
        );
        Route::get(
            'reviewrequest/upcoming/{period}',
            'ReviewRequestController@upcomingForPeriodReviewRequests'
        );
        Route::get(
            'reviewrequest/upcoming',
            'ReviewRequestController@upcomingReviewRequests'
        );
        Route::get(
            'reviewrequest/group/{group_id}',
            'ReviewRequestController@sortReviewRequestsByGroups'
        );
        Route::get(
            'reviewrequest/tag/{tag_id}',
            'ReviewRequestController@sortReviewRequestsByTags'
        );
        Route::get(
            'reviewrequest/user/{user_id}',
            'ReviewRequestController@sortReviewRequestsByUsers'
        );
        Route::get(
            'usersforrequest/{request_id}',
            'ReviewRequestController@usersForRequest'
        );
        Route::resource(
            'unreadnotifications',
            'UserController@unreadNotifications'
        );
        Route::get(
            'users/high_rep',
            'UserController@highRept'
        );
        Route::get(
            'reviewrequest/heigh_rep/{number}',
            'ReviewRequestController@getHeighRept'
        );
        Route::resource(
            'user',
            'UserController',
            ['only' => ['index', 'show']]
        );
        Route::resource(
            '/reviewrequest/{rid}/comment',
            'CommentController',
            ['only' => ['index', 'store', 'show']]
        );
        Route::resource(
            'job',
            'JobController',
            ['only' => ['index']]
        );
        Route::resource(
            'department',
            'DepartmentController',
            ['only' => ['index']]
        );
        Route::resource(
            'reviewrequest',
            'ReviewRequestController',
            ['except' => ['create', 'edit']]
        );
        Route::get(
            'reviewrequest/{id}/offers',
            'ReviewRequestController@offers'
        );
        Route::get(
            'reviewrequest/{id}/tags',
            'ReviewRequestController@tags'
        );
        Route::get(
            'user/{user_id}/accept/{request_id}',
            'UserController@acceptReviewRequest'
        );
        Route::get(
            'user/{user_id}/decline/{request_id}',
            'UserController@declineReviewRequest'
        );
        Route::get(
            'user/{user_id}/offeron/{request_id}',
            'UserController@offerOnReviewRequest'
        );
        Route::get(
            'user/offeroff/{request_id}',
            'UserController@offerOffReviewRequest'
        );
        Route::get(
            'user/{user_id}/mailaccept/{request_id}',
            'UserController@mailAcceptReviewRequest'
        );
        Route::get(
            'user/{user_id}/maildecline/{request_id}',
            'UserController@mailDeclineReviewRequest'
        );
        Route::resource(
            'group',
            'GroupController',
            ['only' => ['index']]
        );
        Route::get(
            'tags/popular',
            'TagController@popularTags'
        );
        Route::resource(
            'tag',
            'TagController',
            ['only' => ['index']]
        );
        Route::resource(
            'badge',
            'BadgeController',
            ['only' => ['index']]
        );
        Route::post(
            'tags/search',
            'TagController@search'
        );
        Route::get(
            'checknotification',
            'UserController@checkNotification'
        );
    });
});
