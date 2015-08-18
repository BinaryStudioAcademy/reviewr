<?php

namespace App\Services\Interfaces;

interface RequestServiceInterface
{
    public function getAllUsers();

    public function getAllRequests();

    public function getMyRequests();

    public function getOfferedRequests();

    public function getAllTags();

    public function getOneUserById($id);

    public function getOneRequestById($id);

    public function createRequest($data);

    public function updateRequest($id, $data);

    public function getSpecificRequestOffers($id);

    public function getSpecificRequestTags($id);

    public function deleteRequestById($id);

    public function searchTagsByKeyWord($keyword);

    public function getOfferedReviewRequests_();

    public function getPopularReviewRequests();

    public function getHighestRatedReviewRequests();

    public function getReviewRequestsByGroupId($id);

    public function getHighestReputationUsers();

    public function getReviewRequestsByTagId($tag_id);

    public function getPopularTags();
}