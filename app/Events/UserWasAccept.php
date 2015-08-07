<?php

namespace App\Events;

use App\ReviewRequest;
use App\User;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWasAccept extends Event
{
    use SerializesModels;

    public $request;
    public $offer;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReviewRequest $request, User $offer)
    {
        $this->request = $request;
        $this->offer = $offer;
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
