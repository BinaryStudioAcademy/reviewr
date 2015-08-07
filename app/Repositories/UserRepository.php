<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function OneById($id)
    {
    	return User::with('job', 'department')->find($id);
    }

    public function create($data) {}

    public function acceptOfferOnReviewRequest($user_id, $request_id)
    {
    	$user = User::find($user_id);

    	$review_requsets = $user->requests()->where('review_request_id', $request_id)->get();

    	foreach ($review_requsets as $review_requset)
    	{
    		$review_requset->pivot->isAccepted = 1;

    		$review_requset->pivot->save();
    	}
    }

    public function declineOfferOnReviewRequest($user_id, $request_id)
    {
    	$user = User::find($user_id);

    	$review_requsets = $user->requests()->where('review_request_id', $request_id)->get();

    	foreach ($review_requsets as $review_requset)
    	{
    		$review_requset->pivot->isAccepted = 0;

    		$review_requset->pivot->save();
    	}
    }

    public function offerOnReviewRequest($user_id, $request_id)
    {
    	$user = User::find($user_id);

    	$user->requests()->attach($request_id);
    }
}