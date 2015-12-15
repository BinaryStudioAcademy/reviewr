<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\ReviewDateNotificationHandler;

class ReviewDateClearingNotification extends ReviewDateNotificationHandler implements ShouldQueue
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
            "Review %s was postponed for undetermined time.",
            $reviewRequest->title
        );

        return $text;
    }

    protected function getTitle()
    {
        return 'Review was postponed';
    }
}
