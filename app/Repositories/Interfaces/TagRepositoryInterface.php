<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface extends BasicRepositoryInterface
{
    public function searchByKeyWord($keyword);

    public function getPopular();
}