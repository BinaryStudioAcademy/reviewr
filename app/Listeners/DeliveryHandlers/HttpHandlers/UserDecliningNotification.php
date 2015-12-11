<?php

namespace App\Listeners\DeliveryHandlers\HttpHandlers;

use App\Events\UserWasDeclined;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Listeners\Contracts\HttpDeliveryHandler;
use Mail;

class UserDecliningNotification extends HttpDeliveryHandler implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserWasAccept  $event
     * @return void
     */
    public function handle(UserWasDeclined $event)
    {
        $request = $event->request;
        $declinedUser = $event->declinedUser;
        $prefix = env('SERVER_PREFIX', '');
        $url = url($prefix . '#!/request/' . $request->id);

        $this->delivery->send([
            'title' => 'Offer declined',
            'text' => 'Your offer for ' . $request->title . ' was declined',
            'url'   => $url,
            'users'=> [$declinedUser->binary_id]
        ]);

//      Mail::send('emails.notificationForAccept',  $data, function ($message) use ($data) {
//          $message->to($data['user']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
//      });
    }
}
