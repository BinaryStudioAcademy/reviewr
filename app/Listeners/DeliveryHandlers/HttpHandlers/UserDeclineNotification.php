<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\Events\UserWasDecline;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\HttpDeliveryHandler;
use Mail;

class UserDeclineNotification extends HttpDeliveryHandler implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserWasAccept  $event
     * @return void
     */
    public function handle(UserWasDecline $event)
    {
        $prefix = env('SERVER_PREFIX', '');
        $url = url($prefix);

        $request = $event->request;
        $offer = $event->offer;

        $this->delivery->send([
            'title' => 'Offer declined',
            'text' => 'Your offer for ' . $request->title . ' was declined',
            'url'   => $url,
            'users'=> [$offer->binary_id]
        ]);

//      Mail::send('emails.notificationForAccept',  $data, function ($message) use ($data) {
//          $message->to($data['user']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
//      });
    }
}
