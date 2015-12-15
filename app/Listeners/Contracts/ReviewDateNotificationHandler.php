<?php
namespace App\Listeners\Contracts;

use App\Services\Notifications\NotificationService;
use App\Events\Contracts\ReviewDateEvent;


abstract class ReviewDateNotificationHandler extends HttpDeliveryHandler
{
    /**
     * @param NotificationService $notification
     */
    public function __construct(NotificationService $notification)
    {
        $this->delivery = $notification;
    }

    /**
     * Handle the event.
     *
     * @param  ReviewDateWasAssigned  $event
     * @return void
     */
    public function handle(ReviewDateEvent $event)
    {
        $prefix = env('APP_PREFIX', '');
        $url = url($prefix . '#!/request/' . $event->request->id);
        $text = $this->getMessageText([$event->request]);

        $acceptedUsersIds = array_map(
            function ($user) {
                return $user->binary_id;
            },
            $event->acceptedUsers
        );

        $this->delivery->send([
            'title' => $this->getTitle(),
            'text'  => $text,
            'url'   => $url,
            'users' => $acceptedUsersIds,
        ]);
    }

    /**
     * Returns the message for event.
     *
     * @var array $arguments Can contain keys request and oldDate
     *
     * @return string
     */
    abstract protected function getMessageText(array $arguments);

    /**
     * Returns the notification title
     *
     * @return string
     */
    abstract protected function getTitle();
}