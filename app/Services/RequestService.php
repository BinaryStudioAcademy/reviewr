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
        return $this->requestRepository->create($data);
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
                return;
            }
        }
        App::abort(404, 'Not found user or request'); 
        
    }

    public function declineReviewRequest($user_id, $req_id)
    {
        $user =  $this->getOneUserById($user_id);
        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                $request->pivot->isAccepted = 0; 
                $request->pivot->save();
                return;
            }
        }
        App::abort(404, 'Not found user or request'); 
    }

    public function offerOnReviewRequest($user_id, $req_id) {
        $this->getOneRequestById($req_id);
        $user = $this->getOneUserById($user_id);
        foreach ($user->requests as $request) {
            if ($request->id == $req_id) {
                App::abort(500, 'User already has this request');
            }
        }
        $user->requests()->attach($req_id);
    }

    public function searchTagsByKeyWord($keyword)
    {
        return $this->tagRepository->searchByKeyWord($keyword);
    }
}