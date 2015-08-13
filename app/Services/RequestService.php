<?php

namespace App\Services;

use App\Services\Interfaces\RequestServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RequestRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App;
use Illuminate\Support\Facades\Auth;

class RequestService implements RequestServiceInterface
{
    private $userRepository;
    private $requestRepository;
    private $tagRepository;
    
    public function __construct(
        UserRepositoryInterface $userRepository,
        RequestRepositoryInterface $requestRepository,
        TagRepositoryInterface $tagRepository
    ) {
        $this->userRepository = $userRepository;
        $this->requestRepository = $requestRepository;
        $this->tagRepository = $tagRepository;
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
        return $this->requestRepository->findByField('user_id', Auth::user()->id);
    }

    public function getAllTags()
    {
        return $this->tagRepository->all();
    }

    public function createRequest($data)
    {
        $request = $this->requestRepository->create($data);
        foreach ($data->tags as $tag) {
            $tag = $this->tagRepository->create($tag);
            $request->tags()->attach($tag->id);
            $request->save();
        }
        return $request;
    }

    public function deleteRequestById($id)
    {
        return $this->requestRepository->delete($id);
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
        return $this->userRepository->OneById($id);
          
    }

    public function getOneRequestById($id)
    {
        return $this->requestRepository->OneById($id);
    }

    public function acceptReviewRequest($user_id, $req_id)
    {
        $user =  $this->getOneUserById($user_id);
        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                $request->pivot->isAccepted = 1; 
                $request->pivot->save();
                return response()->json(['message'=> 'fail'], 500);
            }
        }
        return response()->json(['message'=> 'success'], 200);
        
    }

    public function declineReviewRequest($user_id, $req_id)
    {
        $user =  $this->getOneUserById($user_id);
        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                $request->pivot->isAccepted = 0; 
                $request->pivot->save();
                return response()->json(['message'=> 'success'], 200);
            }
        }
        return response()->json(['message'=> 'fail'], 500);
    }

    public function offerOnReviewRequest($user_id, $req_id) {
        $this->getOneRequestById($req_id);
        $user = $this->getOneUserById($user_id);
        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                return response()->json(['message'=> 'fail'], 500);
            }
        }
        $user->requests()->attach($req_id);
        return response()->json(['message'=> 'success'], 200);
    }


    public function checkUserForRequest($user_id, $req_id) {
        $user = $this->getOneUserById($user_id);
        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                return response()->json(['message'=> 'success'], 200);
            }
        }
      //  return response()->json(['message'=> 'fail'], 500);
    }

    public function offerOffReviewRequest($user, $request_id) {
        $user->requests()->detach($request_id);
        return response()->json(['message'=> 'success'], 200);
    }

    public function usersForRequest($request_id) {

        $request = $this->getOneRequestById($request_id);
        $users = $request->users()->wherePivot('isAccepted', 1)->get();
        return $users;
    }
 
    public function searchTagsByKeyWord($keyword)
    {
        return $this->tagRepository->searchByKeyWord($keyword);
    }
}

