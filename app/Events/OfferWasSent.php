<?php

namespace App\Events;

use App\ReviewRequest;
use Illuminate\Queue\SerializesModels;

class OfferWasSent extends Event
{
    use SerializesModels;

    public $request;
    public $offeredUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReviewRequest $request, User $offeredUser)
    {
        $this->request = $request;
        $this->offeredUser = $offeredUser;
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
