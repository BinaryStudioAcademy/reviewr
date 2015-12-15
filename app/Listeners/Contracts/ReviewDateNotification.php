<?php
namespace App\Listeners\Contracts;

use App\Services\Notifications\NotificationService;


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
    public function handle(ReviewDateWasAssigned $event)
    {
        $prefix = env('APP_PREFIX', '');
        $url = url($prefix . '#!/request/' . $event->request->id);
        $text = $this->getMessageText($event->request);

        $acceptedUsersIds = array_map(
            function ($user) {
                return $user->binary_id;
            },
            $event->acceptedUsers
        );

        $this->delivery->send([
            'title' => 'New review offer',
            'text'  => $text,
            'url'   => $url,
            'users' => $acceptedUsersIds,
        ]);
    }

    abstract function getMessageText(...$arguments);
}