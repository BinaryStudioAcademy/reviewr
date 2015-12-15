<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\Events\ReviewDateWasChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\ReviewDateNotificationHandler;

class ReviewDateChangingNotification extends ReviewDateNotificationHandler implements ShouldQueue
{
    public function handle(ReviewDateWasChanged $event)
    {
        $reviewRequest = $event->request;
        $prefix = env('APP_PREFIX', '');
        $url = url($prefix . '#!/request/' . $reviewRequest->id);
        $text = $this->getMessageText(
            $reviewRequest,
            $event->oldReviewDate
        );

        $acceptedUsersIds = array_map(
            function ($user) {
                return $user->binary_id;
            },
            $event->acceptedUsers
        );

        $this->delivery->send([
            'title' => $this->getTitle(),
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
    protected function getMessageText(...$arguments)
    {
        $reviewRequest = $arguments[0];
        $oldReviewDate = $arguments[1];

        $text = sprintf(
            "Review %s date was changed from %s to %s",
            $reviewRequest->title,
            $oldReviewDate->toDateTimeString(),
            $reviewRequest->date_review->toDateTimeString()
        );

        return $text;
    }

    protected function getTitle()
    {
        return 'Review date was changed';
    }
}

