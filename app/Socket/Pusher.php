<?php
/**
 * Created by PhpStorm.
 * User: TAlex
 * Date: 13.09.2015
 * Time: 16:06
 */

namespace App\Socket;

use App\Socket\Base\BasePusher;

class Pusher extends BasePusher
{

    /**
     * Send data to server
     *
     * @param array $data
     */
    static function sendDataToServer(array $data)
    {
        $context = new \ZMQContext();
        $socket  = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
        $port = env('WEBSOCKET_PORT', 5555);
        $socket->connect('tcp://127.0.0.1:' . $port);

        $socket->send(json_encode($data));
    }


    /**
     * Send broadcast data
     *
     * @param string $jsonDataToSend JSON'ified string we'll receive from ZeroMQ
     */
    public function broadcastData($jsonDataToSend)
    {
        $entryData = json_decode($jsonDataToSend, true);
        $subscribedTopics = $this->getSubscribedTopics();

        if (!isset($entryData['topic_id']) || empty($entryData['topic_id'])) {
            return;
        }

        if (isset( $subscribedTopics[$entryData['topic_id']] )) {
            $topic = $subscribedTopics[$entryData['topic_id']];

            // re-send the data to all the clients subscribed to that category
            $topic->broadcast($entryData);
        }
    }
}