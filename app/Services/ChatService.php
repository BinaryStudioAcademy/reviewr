<?php

namespace App\Services;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\ChatServiceInterface;

class ChatService implements ChatServiceInterface
{
    private $userRepository;
    private $commentRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
    }

    public function getAllCommentsByRequest($rid)
    {
        return $this->commentRepository->findByField('review_request_id', $rid);
    }


    public function addComment($data, $rid)
    {
        return $this->commentRepository->addCommentToRequest($data, $rid);
    }
}