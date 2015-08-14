<?php

namespace App\Services\Interfaces;

interface RequestServiceInterface
{
    public function getAllUsers();

    public function getAllRequests();

    public function getMyRequests();

    public function getAllTags();

    public function getOneUserById($id);

    public function getOneRequestById($id);

    public function createRequest($data);

    public function updateRequest($id, $data);

    public function getSpecificRequestOffers($id);

    public function getSpecificRequestTags($id);

    public function deleteRequestById($id);

    public function searchTagsByKeyWord($keyword);

    public function getOfferedReviewRequests();

    public function getPopularReviewRequests();

    public function getHighestRatedReviewRequests();

    public function getReviewRequestsByGroupId($id);
}