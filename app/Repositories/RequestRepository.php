<?php

namespace App\Repositories;

use App;
use App\ReviewRequest;
use App\Repositories\Interfaces\RequestRepositoryInterface;

class RequestRepository implements RequestRepositoryInterface
{
    public function all()
    {
        return ReviewRequest::with('user', 'group')->get();
    }

    public function create($data)
    {
        $review_request = new ReviewRequest;
        $review_request->title = $data->title;
        $review_request->details = $data->details;
        $review_request->user_id = 1; // TODO id for login user
        $review_request->group_id = $data->group_id;
        $review_request->save();

        return $review_request;
    }

    public function OneById($id)
    {
        return ReviewRequest::with('user', 'group', 'user.department', 'user.job')->findOrFail($id);
    }

    public function getOffersById($id)
    {
        $review_request = ReviewRequest::findOrFail($id);

        return $review_request->users()->get();
    }

    public function getTagsById($id)
    {
        $review_request = ReviewRequest::findOrFail($id);

        return $review_request->tags()->get();
    }
}