<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Contracts\RepositoryInterface;

abstract class PrettusRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * @param $id
     * @param array $relations
     * @return model
     */
    public function findWithRelations($id, array $relations)
    {
        return $this->with($relations)->find($id);
    }
}