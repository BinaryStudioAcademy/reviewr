<?php

namespace App\Events;

use App\Events\Contracts\ReviewDateEvent;
use App\ReviewRequest;

class ReviewDateWasChanged extends ReviewDateEvent
{
    public $oldReviewDate;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        ReviewRequest $request,
        $oldReviewDate,
        array $acceptedUsers
    ) {
        parent::__construct($request, $acceptedUsers);
        $this->oldReviewDate = $oldReviewDate;
    }
}
