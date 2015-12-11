<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\Events\UserWasAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Listeners\Contracts\HttpDeliveryHandler;


class UserAcceptingNotification extends HttpDeliveryHandler implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserWasAccepted  $event
     * @return void
     */
    public function handle(UserWasAccepted $event)
    {
        $prefix = env('SERVER_PREFIX', '');
        $url = url($prefix);

        $request = $event->request;
        $offer = $event->offer;

        $this->delivery->send([
            'title' => 'Offer accepted',
            'text'  => 'Your offer for ' . $request->title . ' was accepted',
            'url'   => $url,
            'users'=> [$offer->binary_id]
        ]);

//      Mail::send('emails.notificationForAccept',  $data, function ($message) use ($data) {
//          $message->to($data['user']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
//      });
    }
}
