<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\ReviewDateNotificationHandler;
use App\Listeners\Exceptions\NotificationHandlerException;

class ReviewDateAssigningNotification extends ReviewDateNotificationHandler implements ShouldQueue
{
    /**
     * Returns the message for event.
     *
     * array['request'] ReviewRequest Defines the changed request.
     *
     * @var array $arguments see above
     * @return string
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
            "Review %s date was assigned on %s",
            $reviewRequest->title,
            $reviewRequest->date_review->toDateTimeString()
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
        return 'Review date was assigned';
    }
}
