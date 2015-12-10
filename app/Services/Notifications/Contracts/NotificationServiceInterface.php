<?php

namespace App\Services\Notifications\Contracts;

interface NotificationServiceInterface
{
    /**
     * @param array $data
     */
    public function send(array $data);
}