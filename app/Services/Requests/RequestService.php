<?php

namespace App\Services\Requests;

use App;
use App\Services\Requests\Contracts\RequestServiceInterface;
use App\Notification;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\RequestRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use App\Services\Requests\Exceptions\RequestServiceException;
use Illuminate\Support\Facades\Event;
use App\Events\UserWasAccepted;
use App\Events\UserWasDeclined;
use App\Events\OfferWasSent;
use App\Events\ReviewDateWasAssigned;
use App\Events\ReviewDateWasChanged;
use App\Events\ReviewDateWasCleared;

class RequestService implements RequestServiceInterface
{
    protected $userRepository;
    protected $requestRepository;
    protected $tagRepository;
    protected $guard;

    public function __construct(
    UserRepositoryInterface $userRepository,
    RequestRepositoryInterface $requestRepository,
    TagRepositoryInterface $tagRepository,
    Guard $guard
    ) {
        $this->userRepository = $userRepository;
        $this->requestRepository = $requestRepository;
        $this->tagRepository = $tagRepository;
        $this->guard = $guard;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getAllRequests()
    {
        return $this->requestRepository->all();
    }

    public function getMyRequests()
    {
        return $this->requestRepository->findByField('user_id', $this->guard->user()->id);
    }

    public function getOfferedRequests()
    {
        return $this->requestRepository->getOffered($this->guard->user()->id);
    }

    public function getAllTags()
    {
        return $this->tagRepository->all();
    }

    public function createRequest($data)
    {
        $request = $this->requestRepository->create($data);

//        if (!is_null($data['date_review'])) {
//            $data['date_review'] = date_create($data['date_review']);
//        }

        if (isset($data['tags'])) {
            foreach ($data['tags'] as $tag) {
                $tag = $this->tagRepository->create(['title' => $tag]);
                $request->tags()->attach($tag->id);
                $request->save();
            }
        }

        return $request;
    }

    public function deleteRequestById($id)
    {
        return $this->requestRepository->delete($id);
    }

    public function updateRequest($id, $data)
    {
        $request = $this->requestRepository->find($id);
        $savedRequest = $this->requestRepository->update($data, $id);
        $acceptedUsers = $this->getUsersForRequest($id)->toArray();

        if(empty($acceptedUsers)) {
            return $savedRequest;
        }

        $oldRequestDate = $request->date_review;

        if (!is_null($oldRequestDate) && is_null($savedRequest->date_review)) {
            Event::fire(new ReviewDateWasCleared(
                $savedRequest,
                $acceptedUsers
            ));
        } elseif (is_null($oldRequestDate) && !is_null($savedRequest->date_review)) {
            Event::fire(new ReviewDateWasAssigned(
                $savedRequest,
                $acceptedUsers
            ));
        } elseif ($savedRequest->date_review != $oldRequestDate) {
            Event::fire(new ReviewDateWasChanged(
                $savedRequest,
                $oldRequestDate,
                $acceptedUsers
            ));
        }

        return $savedRequest;
    }

    public function getSpecificRequestOffers($id)
    {
        return $this->requestRepository->getOffersById($id);
    }

    public function getSpecificRequestTags($id)
    {
        return $this->requestRepository->getTagsById($id);
    }

    public function getOneUserById($id)
    {   
        return $this->userRepository->findWithRelations($id, ['job', 'department']);
          
    }

    public function getOneRequestById($id)
    {
        return $this->requestRepository->find($id);
    }

    public function acceptReviewRequest($user_id, $req_id)
    {
        $acceptedUser = $this->getOneUserById($user_id);
        $request = $this->requestRepository->find($req_id);

        // Marking the offer as accepted
        $request->users()->updateExistingPivot(
            $user_id,
            ['isAccepted' => 1],
            false
        );

        Event::fire(new UserWasAccepted($request, $acceptedUser));
        return response()->json(['message'=> 'success'], 200);
    }

    public function declineReviewRequest($user_id, $req_id)
    {
        $declinedUser = $this->getOneUserById($user_id);
        $reviewRequest = $this->requestRepository->find($req_id);

        // Marking the offer as declined
        $declinedUser->requests()->detach($req_id);
        $declinedUser->save();

        Event::fire(new UserWasDeclined($reviewRequest, $declinedUser));
        return $reviewRequest;
    }

    public function offerOnReviewRequest($user_id, $req_id)
    {
        $request = $this->getOneRequestById($req_id);
        $user = $this->getOneUserById($user_id); // internal id
        $author = $this->getOneUserById($request->user['id']);

        //TODO: Add a check if user and author are different people
        if ($user->id === $author->id) {
            throw new RequestServiceException('User cannot offer a review for'
            . 'his own request');
        }

        // Check if this user offered a review for this request
        //TODO: change to the repo usage
        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                throw new RequestServiceException('User have already offered '
                    . 'a review for this request');
            }
        }

        $user->requests()->attach($req_id);

        // Sending notification
        $author = $this->userRepository->find($request->user_id);
        Event::fire(new OfferWasSent($request, $user, $author));

        return $request;
    }

    public function checkUserForRequest($user_id, $req_id) {
        $user = $this->getOneUserById($user_id);

        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                return response()->json(['message'=> 'success'], 200);
            }
        }
    }

    public function offerOffReviewRequest($user, $req_id) {
        $user = $this->getOneUserById($user->id);
        $user->requests()->detach($req_id);

        $reviewRequest = $this->requestRepository->find($req_id);
        return $reviewRequest;
    }

    public function getUsersForRequest($request_id) {
        $request = $this->getOneRequestById($request_id);
        return $request->users()->wherePivot('isAccepted', 1)->get();
    }

    public function searchTagsByKeyWord($keyword)
    {
        return $this->tagRepository->searchByKeyWord($keyword);
    }

    public function getOfferedReviewRequests_()
    {
        return $this->requestRepository->getOffered_($this->guard->user()->id);
    }

    public function getPopularReviewRequests()
    {
        return $this->requestRepository->getPopular();
    }

    public function getReviewRequestsByGroupId($id)
    {
        return $this->requestRepository->getByGroupId($id);
    }

    public function upcomingReviewRequests()
    {
        return $this->requestRepository->upcomingReviewRequests();
    }
    
    public function lastNReviewRequests($number)
    {
        return $this->requestRepository->lastNReviewRequests($number);
    }

    public function upcomingForPeriodReviewRequests($period)
    {
        return $this->requestRepository->upcomingForPeriodReviewRequests($period);
    }

    public function getReviewRequestsByTagId($tag_id)
    {
        return $this->requestRepository->getByTagId($tag_id);
    }

    public function getPopularTags()
    {
        return $this->tagRepository->getPopular();
    }
    
    public function getReviewRequestsByUserId($user_id)
    {
        return $this->requestRepository->getByUserId($user_id);
    }
}