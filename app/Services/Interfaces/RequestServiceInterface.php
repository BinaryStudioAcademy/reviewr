<?php

namespace App\Services\Interfaces;

interface RequestServiceInterface
{
    public function getAllUsers();

    public function getAllRequests();

    public function getAllTags();

    public function createRequest($data);
}