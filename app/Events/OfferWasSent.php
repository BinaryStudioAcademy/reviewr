<?php

namespace App\Events;

use App\ReviewRequest;
use Illuminate\Queue\SerializesModels;
use App\User;

class OfferWasSent extends Event
{
    use SerializesModels;

    public $request;
    public $offeredUser;
    public $author;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        ReviewRequest $request,
        User $offeredUser,
        User $author
    )
    {
        $this->request = $request;
        $this->offeredUser = $offeredUser;
        $this->author = $author;
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
