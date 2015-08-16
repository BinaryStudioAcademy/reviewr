<?php

namespace App\Repositories\Interfaces;

use App\User;

interface RequestRepositoryInterface extends BasicRepositoryInterface
{
    public function getOffersById($id);

    public function getTagsById($id);

    public function findByField($fieldName, $fieldValue, $columns = [ '*' ]);

    public function getOffered($auth_user);

    public function getPopular();

    public function getHighestRated();

    public function getByGroupId($id);
}