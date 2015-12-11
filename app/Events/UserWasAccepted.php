<?php

namespace App\Events;

use App\ReviewRequest;
use Illuminate\Queue\SerializesModels;

class UserWasAccepted extends Event
{
    use SerializesModels;

    public $request;
    public $acceptedUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReviewRequest $request, User $acceptedUser)
    {
        $this->request = $request;
        $this->acceptedUser = $acceptedUser;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
