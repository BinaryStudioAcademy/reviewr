<?php

namespace App\Repositories\Interfaces;

interface BasicRepositoryInterface
{
    public function all();

    public function OneById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}