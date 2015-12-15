<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\Events\ReviewDateWasChanged;
use App\Listeners\Exceptions\NotificationHandlerException;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\ReviewDateNotificationHandler;

class ReviewDateChangingNotification extends ReviewDateNotificationHandler implements ShouldQueue
{
    public function handle(ReviewDateWasChanged $event)
    {
        $reviewRequest = $event->request;
        $prefix = env('APP_PREFIX', '');
        $url = url($prefix . '#!/request/' . $reviewRequest->id);
        $text = $this->getMessageText([
            'request' => $reviewRequest,
            'oldDate' => $event->oldReviewDate
        ]);

        $acceptedUsersIds = array_map(
            function ($user) {
                return $user['binary_id'];
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
     * Returns the message for event.
     *
     * array['request'] ReviewRequest Defines the changed request.
     * array['oldDate'] DateTime Defines an old date of review.
     *
     * @var array $arguments see above
     * @return string
     */
    protected function getMessageText(array $arguments)
    {
        if (!isset($arguments['request']) || !isset($arguments['oldDate'])) {
            throw new NotificationHandlerException(
                "Necessary argument in missing."
            );
        }

        $reviewRequest = $arguments['request'];
        $oldReviewDate = $arguments['oldDate'];

        $text = sprintf(
            "Review %s date was changed from %s to %s",
            $reviewRequest->title,
            $oldReviewDate->toDateTimeString(),
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
        return 'Review date was changed';
    }
}

