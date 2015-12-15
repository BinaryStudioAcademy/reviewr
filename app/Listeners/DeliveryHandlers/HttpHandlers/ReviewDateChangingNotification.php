<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\ReviewDateNotificationHandler;

class ReviewDateChangingNotification extends ReviewDateNotificationHandler implements ShouldQueue
{
    public function handle(ReviewDateWasAssigned $event)
    {
        $prefix = env('APP_PREFIX', '');
        $url = url($prefix . '#!/request/' . $reviewRequest->id);
        $text = $this->getMessageText(
            $event->request,
            $event->oldReviewDate
        );

        $acceptedUsersIds = array_map(
            function ($user) {
                return $user->binary_id;
            },
            $event->acceptedUsers
        );

        $this->delivery->send([
            'title' => 'New review offer',
            'text' => $text,
            'url'   => $url,
            'users'=> $acceptedUsersIds,
        ]);
    }

    /**
     * Create the event listener.
     *
     * @return string
     */
    public function getMessageText(...$arguments)
    {
        $reviewRequest = $arguments[0];
        $oldReviewDate = $arguments[1];

        $text = sprintf(
            "Review request %s date changed from %s to %s",
            [
                $reviewRequest->title,
                $oldReviewDate,
                $reviewRequest->date
            ]
        );

        return $text;
    }
}

