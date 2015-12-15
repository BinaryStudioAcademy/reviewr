<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\ReviewDateNotificationHandler;

class ReviewDateClearingNotification extends ReviewDateNotificationHandler implements ShouldQueue
{
    /**
     * Returns the message for event.
     *
     * @var array $arguments Contains key request
     */
    protected function getMessageText(array $arguments)
    {
        if (!isset($arguments['request'])) {
            throw new NotificationHandlerException(
                "Necessary argument in missing."
            );
        }

        $reviewRequest = $arguments['request'];
        $text = sprintf(
            "Review %s was postponed for undetermined time.",
            $reviewRequest->title
        );

        return $text;
    }

    /**
     * Returns the notification title
     *
     * @return string
     */
    protected function getTitle()
    {
        return 'Review was postponed';
    }
}
