<?php

namespace App\Repositories\Interfaces;

interface BasicRepositoryInterface
{
    public function all();

    public function OneById($id);

    public function create($data);
}