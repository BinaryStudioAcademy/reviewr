<?php

namespace App\Repositories;

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
        $review_request->user_id = $data->user_id;
        $review_request->group_id = $data->group_id;
        $review_request->save();

        return $review_request;
    }

    public function OneById($id)
    {
        return ReviewRequest::with('user', 'group', 'user.department', 'user.job')->find($id);
    }

    public function getOffersById($id)
    {
        $selection_result = ReviewRequest::with('users')->find($id);

        return $selection_result->users;
    }

    public function getTagsById($id)
    {
        $selection_result = ReviewRequest::with('tags')->find($id);

        return $selection_result->tags;
    }
}