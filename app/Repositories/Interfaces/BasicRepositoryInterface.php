<?php

namespace App\Repositories\Interfaces;

interface BasicRepositoryInterface
{
    public function all();

    public function create($data);
}