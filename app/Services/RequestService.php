<?php

namespace App\Services;

use App\Services\Interfaces\RequestServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RequestRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;

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

    public function acceptUserOfferOnReviewRequest($user_id, $request_id)
    {
        return $this->userRepository->acceptOfferOnReviewRequest($user_id, $request_id);
    }

    public function declineUserOfferOnReviewRequest($user_id, $request_id)
    {
        return $this->userRepository->declineOfferOnReviewRequest($user_id, $request_id);
    }

    public function offerUserOnReviewRequest($user_id, $request_id)
    {
        return $this->userRepository->offerOnReviewRequest($user_id, $request_id);
    }
}