<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\Events\OfferWasSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\HttpDeliveryHandler;

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
        $request = $event->request;
        $author = $event->author;
        $offeredUser = $event->offeredUser;
        $prefix = env('APP_PREFIX', '');
        $url = url($prefix . '#!/request/' . $request->id);

        $text = 'User '
            . $offeredUser->first_name
            . ' '
            . $offeredUser->last_name
            . ' send you offer for request "'
            . $request->title
            . '"';

        $this->delivery->send([
            'title' => 'New review offer',
            'text' => $text,
            'url'   => $url,
            'users'=> [$author->binary_id]
        ]);

//      Mail::send('emails.notificationForAccept',  $data, function ($message) use ($data) {
//          $message->to($data['user']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
//      });
    }
}
