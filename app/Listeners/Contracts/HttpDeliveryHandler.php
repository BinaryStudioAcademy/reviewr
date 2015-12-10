<?php

namespace App\Listeners\Contracts;

use App\Services\Notifications\NotificationService;


class HttpDeliveryHandler extends DeliveryHandler
{
    /**
     * @param NotificationService $notification
     */
    public function __construct(NotificationService $notification)
    {
        $this->delivery = $notification;
    }
}