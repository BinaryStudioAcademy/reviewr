<?php

namespace App\Repositories\Interfaces;

interface BasicRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}