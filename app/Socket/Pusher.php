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
        $socket->connect("tcp://localhost:5555");

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

        if (isset( $subscribedTopics[$entryData['topic_id']] )) {
            $topic = $subscribedTopics[$entryData['topic_id']];

            // re-send the data to all the clients subscribed to that category
            $topic->broadcast($entryData);
        }

    }
}