<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\Events\UserWasAccept;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Listeners\Contracts\HttpDeliveryHandler;


class UserAcceptNotification extends HttpDeliveryHandler implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserWasAccept  $event
     * @return void
     */
    public function handle(UserWasAccept $event)
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
