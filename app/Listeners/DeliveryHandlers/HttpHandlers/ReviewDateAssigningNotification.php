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
    public function getMessageText(...$arguments)
    {
        $reviewRequest = $arguments[0];
        $text = sprintf(
            "Review request %s date assigned on %s",
            [
                $reviewRequest->title,
                $reviewRequest->date
            ]
        );

        return $text;
    }
}
