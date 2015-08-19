<?php

namespace App\Services\Interfaces;

interface ChatServiceInterface
{
    public function getAllCommentsByRequest($rid);

    public function addComment($data, $rid);
}