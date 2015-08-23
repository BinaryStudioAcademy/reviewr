<?php

namespace App\Repositories;

use App;
use App\ReviewRequest;
use App\Repositories\Interfaces\RequestRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// Temp Use
use DB;
// End Temp Use

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
        $review_request->user_id = Auth::user()->id;
        $review_request->group_id = $data->group_id;
        $review_request->date_review = $data->date_review.':00';
        $review_request->save();
        return $review_request;
    }

    public function update($id, $data)
    {
        $review_request = ReviewRequest::findOrFail($id);
        $auth_user_id = Auth::user()->id;

        // Check if the reputation change and Up or Down
        if ($data->has('reputation')) {
            $isReputationUp =  ($data->reputation > $review_request->reputation);
            $isReputationDown = ($data->reputation < $review_request->reputation);
            $review_request->reputation = $data->reputation;

            // If reputation change save user vote  or delete his vote
            if ($isReputationUp) {
                $review_request->votes()->detach($auth_user_id); // temp solution, for removing dubl votes
                $review_request->votes()->attach($auth_user_id);
            } elseif ($isReputationDown) {
                $review_request->votes()->detach($auth_user_id);
            }
        }

        // Fill only existing fields (see http://ryanchenkie.com/laravel-put-requests/)
        if ($review_request->user_id == $auth_user_id) {
            $review_request->title = $data->title ? $data->title : $review_request->title;
            $review_request->details = $data->has('details') ? $data->details: $review_request->details;
            // Another fields witch are need to update ...
        }

        $review_request->save();

        return $review_request;

    }

    public function delete($id)
    {
        $review_request = ReviewRequest::findOrFail($id);
        if ($review_request->user_id == Auth::user()->id) {
            $removed = $review_request; // store removed item for returning
            $review_request->delete();
            return ['status' => 'Ok', 'message' => 'Request removed', $removed];
        } else {
            return ['error' => ['message' => 'You can not remove not yours request']];
        }
    }

    public function OneById($id)
    {
        return ReviewRequest::with([
            'user.job',
            'user.department',
            'group',
            'tags',
            'votes',
            'users'
        ])->findOrFail($id);
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


    public function findByField($fieldName, $fieldValue, $columns=['*'])
    {
        return ReviewRequest::with('user', 'group')->where($fieldName, $fieldValue)->get($columns);
    }

    public function getOffered($auth_user_id)
    {
        return App\User::findOrFail($auth_user_id)->requests()->with('user', 'group')->get();
    }

    //---------------------------------------------------------------------------------------------
    // Temp Solution
    //---------------------------------------------------------------------------------------------

    public function getOffered_($auth_user_id)
    {
        return ReviewRequest::with('user', 'group')
                            ->whereIn('id', DB::table('review_request_user')
                                              ->where('user_id', $auth_user_id)
                                              ->lists('review_request_id'))
                            ->get();
    }

    public function getPopular()
    {
        $review_requests = $this->all();
        $review_requests_sorted = $review_requests->sortByDesc('offers_count');
        return $review_requests_sorted->values()->all();
    }

    //---------------------------------------------------------------------------------------------
    // End Temp Solution
    //---------------------------------------------------------------------------------------------

    public function getHighestRated()
    {
        return ReviewRequest::with('user', 'group')->orderBy('reputation', 'desc')->get();
    }

    public function getByGroupId($id)
    {
        return ReviewRequest::with('user', 'group')->where('group_id', $id)->get();
    }
   
    public function checkVote($request_id, $user_id) {
        $review_request = ReviewRequest::findOrFail($request_id);
        foreach ($review_request->votes as $vote) {
            if ($vote->id == $user_id) {
                return true;
            }
        }
        return false;
    }

    public function reputationUp($request_id, $user_id)
    {
        $review_request = ReviewRequest::findOrFail($request_id);
        $review_request->reputation = $review_request->reputation + 1;
        $review_request->votes()->attach($user_id);
        $review_request->save();
  
    }

    public function reputationDown($request_id, $user_id)
    {
        $review_request = ReviewRequest::findOrFail($request_id);
        $review_request->reputation = $review_request->reputation - 1;
        $review_request->votes()->detach($user_id);
        $review_request->save();
    }

    public function getHighRept($number)
    {
        return ReviewRequest::orderBy('reputation','descs')->take($number)->get();
    }

    public function upcomingReviewRequests()
    {
        return ReviewRequest::where('date_review', '>', Carbon::now())->get();
    }

    public function lastNReviewRequests($number)
    {
        return ReviewRequest::where('date_review', '<', Carbon::now())->take($number)->get();
    }

    public function upcomingForPeriodReviewRequests($period)
    {
        switch($period)
        {
            case 'today':
                return ReviewRequest::where('date_review', '=', Carbon::today())->get();
                break;
        
            case 'week':
                return ReviewRequest::whereBetween('date_review', array(Carbon::now(), Carbon::now()->addWeek()))->get();
            
            case 'month':
                return ReviewRequest::whereBetween('date_review', array(Carbon::now(), Carbon::now()->addMonth()))->get();

            default:
                return 'exception!';
                break;
        }
    }

    public function getByTagId($tag_id)
    {
        return ReviewRequest::with('user', 'group')
                            ->whereIn('id', DB::table('tag_review_request')
                                              ->where('tag_id', $tag_id)
                                              ->lists('review_request_id'))
                            ->get();
    }

    public function getByUserId($user_id)
    {
        return ReviewRequest::with('user', 'group')->where('user_id', $user_id)->get();
    }
}