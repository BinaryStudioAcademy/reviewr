<?php

namespace App\Repositories;

use App;
use App\ReviewRequest;
use App\Repositories\Contracts\RequestRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// Temp Use
use DB;
// End Temp Use

class RequestRepository implements RequestRepositoryInterface
{
    public function all()
    {
        return ReviewRequest::with('user', 'group')->orderBy('created_at', 'desc')->get();
    }

    protected function attachFormattedDateTime(array $data)
    {
        if (!empty($data['date_review'])) {
            $formattedDated = (new \DateTime($data['date_review']))
                ->format('Y-m-d H:i:s');
            $data['date_review'] = $formattedDated;
        } else {
            $data['date_review'] = null;
        }

        return $data;
    }

    public function create(array $attributes)
    {
        $attributes['user_id'] = Auth::user()->id;
        $attributes = $this->attachFormattedDateTime($attributes);

        $review_request = new ReviewRequest($attributes);
        $review_request->save();
        return $review_request;
    }

    public function update(array $attributes, $id)
    {
        $review_request = ReviewRequest::findOrFail($id);
        $auth_user_id = Auth::user()->id;

        $attributes = $this->attachFormattedDateTime($attributes);
        $review_request->update($attributes);
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

    public function find($id)
    {
        return ReviewRequest::with([
            'user.job',
            'user.department',
            'group',
            'tags',
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
        return ReviewRequest::with('user', 'group')->where($fieldName, $fieldValue)->orderBy('created_at', 'desc')->get($columns);
    }

    public function getOffered($auth_user_id)
    {
        return App\User::findOrFail($auth_user_id)->requests()->with('user', 'group')->orderBy('created_at', 'desc')->get();
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
                            ->orderBy('created_at', 'desc')
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

    public function getByGroupId($id)
    {
        return ReviewRequest::with('user', 'group')->where('group_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public function upcomingReviewRequests()
    {
        return ReviewRequest::with('user', 'group', 'users')->where('date_review', '>', Carbon::now())->get();
    }

    public function lastNReviewRequests($number)
    {
        return ReviewRequest::with('user', 'group')->where('date_review', '<', Carbon::now())->take($number)->get();
    }

    public function upcomingForPeriodReviewRequests($period)
    {
        switch($period)
        {
            case 'today':
                $start = new Carbon('now');
                $end =(new Carbon('now'))->hour(23)->minute(59)->second(59);
                return ReviewRequest::with('user', 'group', 'users')->whereBetween('date_review', array($start, $end))->get();
                break;
        
            case 'week':
                return ReviewRequest::with('user', 'group', 'users')->whereBetween('date_review', array(Carbon::now(), Carbon::now()->addWeek()))->get();
            
            case 'month':
                return ReviewRequest::with('user', 'group', 'users')->whereBetween('date_review', array(Carbon::now(), Carbon::now()->addMonth()))->get();

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