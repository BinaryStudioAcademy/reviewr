<?php

namespace App\Services\Interfaces;

interface RequestServiceInterface
{
    public function getAllUsers();

    public function getAllRequests();

    public function getAllTags();

    public function getOneUserById($id);

    public function getOneRequestById($id);

    public function createRequest($data);

    public function getSpecificRequestOffers($id);

    public function getSpecificRequestTags($id);
}