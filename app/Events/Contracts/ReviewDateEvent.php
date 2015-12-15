<?php

namespace App\Events\Contracts;

use App\ReviewRequest;

abstract class ReviewDateEvent extends Event
{
    use SerializesModels;

    public $request;
    public $acceptedUsers;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReviewRequest $request, array $acceptedUsers)
    {
        $this->request = $request;
        $this->acceptedUsers = $acceptedUsers;
    }
}
