<?php

namespace App\Repositories\Interfaces;

interface RequestRepositoryInterface extends BasicRepositoryInterface
{
    public function getOffersById($id);

    public function getTagsById($id);

    public function findByField($fieldName, $fieldValue, $columns = [ '*' ]);
}