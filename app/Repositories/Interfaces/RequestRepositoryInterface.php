<?php

namespace App\Repositories\Interfaces;

interface RequestRepositoryInterface extends BasicRepositoryInterface
{
    public function getOffersById($id);

    public function getTagsById($id);

    public function findByField($fieldName, $fieldValue, $columns = [ '*' ]);

    public function getOffered($user_id);

    public function getPopular();

    public function getHighestRated();

    public function getByGroupId($id);
}