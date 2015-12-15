<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\ReviewDateNotificationHandler;

class ReviewDateAssigningNotification extends ReviewDateNotificationHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return string
     */
    protected function getMessageText(...$arguments)
    {
        $reviewRequest = $arguments[0];
        $text = sprintf(
            "Review %s date was assigned on %s",
            $reviewRequest->title,
            $reviewRequest->date_review->toDateTimeString()
        );

        return $text;
    }

    protected function getTitle()
    {
        return 'Review date was assigned';
    }
}
