<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\User;
use App\Events\OfferWasSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use App\Listeners\Contracts\HttpDeliveryHandler;
use Mail;
use App\Repositories\Contracts\UserRepositoryInterface;

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
        $prefix = env('SERVER_PREFIX', '');
        $url = url($prefix . '#!/request/' . $request->id);

        $text = 'User '
            . $offeredUser->first_name
            . ' '
            . $offeredUser->last_name
            . ' send you offer for request "'
            . $request->title
            . '"';

        $this->delivery->send([
            'title' => 'New offer',
            'text' => $text,
            'url'   => $url,
            'users'=> [$author->binary_id]
        ]);

//      Mail::send('emails.notificationForAccept',  $data, function ($message) use ($data) {
//          $message->to($data['user']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
//      });
    }
}
