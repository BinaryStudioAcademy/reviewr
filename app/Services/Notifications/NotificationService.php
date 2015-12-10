<?php

namespace App\Services\Notifications;

use App\Services\Notifications\Contracts\NotificationServiceInterface;
use App\Services\RemoteDataGrabber\Exceptions\RemoteServerException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use App\Services\RemoteDataGrabber\Contracts\DataGrabberInterface;

class NotificationService implements NotificationServiceInterface
{
    protected $dataGrabber;

    public function __construct(DataGrabberInterface $dataGrabber) {
        $this->dataGrabber = $dataGrabber;
    }

    public function send(array $data)
    {
        $notificationInfo = [
            'title'       => $data['title'],
            'text'        => $data['text'],
            'url'         => $data['url'],
            'sound'       => true,
            'serviceType' => 'Reviewr',
            'users'       => $data['users'],
        ];
        $notificationInfo = json_encode($notificationInfo);
        $cookie = Cookie::get('x-access-token');
        $options = [
            CURLOPT_COOKIE         => 'x-access-token=' . $cookie,
            CURLOPT_POSTFIELDS     => $notificationInfo,
            CURLOPT_HEADER         => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-type: application/json',
                'Content-Length: ' . strlen($notificationInfo)
            ],
        ];

        try {
            $result = $this->dataGrabber->getRaw(
                url(env('NOTIFICATIONS')),
                $options
            );
        } catch (RemoteServerException $e) {
            $info = 'Notification request fails.'
                  . PHP_EOL
                  . $e->getMessage()
                  . 'Curl options: '
                  . var_export($options, true);
            Log::error($info);
        }

        if (empty($result)) {
            Log::error(
                'Notification request does not receive any response.'
                . PHP_EOL
                . 'Curl options: '
                . var_export($options, true)
            );
        }
    }
}