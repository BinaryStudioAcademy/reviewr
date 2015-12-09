<?php

namespace App\Repositories\Contracts;

interface TagRepositoryInterface extends BasicRepositoryInterface
{
    public function searchByKeyWord($keyword);

    public function getPopular();
}