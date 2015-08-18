<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface extends BasicRepositoryInterface
{
    public function addCommentToRequest($data, $rid);

    public function findByField($fieldName, $fieldValue, $columns=['*']);
}