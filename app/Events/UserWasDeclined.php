<?php

namespace App\Events;

use App\ReviewRequest;
use Illuminate\Queue\SerializesModels;
use App\User;

class UserWasDeclined extends Event
{
    use SerializesModels;

    public $request;
    public $declinedUser;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReviewRequest $request, User $declinedUser)
    {
        $this->request = $request;
        $this->declinedUser = $declinedUser;
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
