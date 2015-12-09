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

    public function updateFirstOrCreate(array $keyAttributes, array $attributes=[])
    {
        $attrs = array_merge($keyAttributes, $attributes);
        $collection = $this->findWhere($keyAttributes);

        if (!$collection->isEmpty()) {
            $instance = $collection->first();
            return $this->update($attrs, $instance->id);
        }

        return $this->create($attrs);
    }
}