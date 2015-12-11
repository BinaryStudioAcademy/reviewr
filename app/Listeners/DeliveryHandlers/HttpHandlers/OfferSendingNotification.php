<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\User;
use App\Events\OfferWasSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use App\Listeners\Contracts\HttpDeliveryHandler;
use Mail;

class OfferSendingNotification extends HttpDeliveryHandler implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OfferWasSent  $event
     * @return void
     */
    public function handle(OfferWasSent $event)
    {
        $prefix = env('SERVER_PREFIX', '');
        $url = url($prefix);

        $request = $event->request;
        $author = User::find($request->user_id);

        $this->delivery->send([
            'title' => 'New offer',
            'text' => 'You have unread offer for ' . $request->title,
            'url'   => $url,
            'users'=> [$author->binary_id]
        ]);

//      Mail::send('emails.notificationForAccept',  $data, function ($message) use ($data) {
//          $message->to($data['user']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
//      });
    }
}
