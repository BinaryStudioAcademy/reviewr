<?php

namespace App\Repositories\Contracts;

interface CommentRepositoryInterface extends BasicRepositoryInterface
{
    public function addCommentToRequest($data, $rid);

    public function findByField($fieldName, $fieldValue, $columns=['*']);
}