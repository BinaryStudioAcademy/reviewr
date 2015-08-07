<?php

namespace App\Listeners;

use App\User;
use App\Events\UserWasAccept;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\MailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class UserAcceptNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasAccept  $event
     * @return void
     */
    public function handle(UserWasAccept $event)
    {
        $request = $event->request;
        $offer = $event->offer;
        $author = User::find($request->user_id);
        $data = [
           'author' => $author,
           'request' => $request,
           'user' =>$offer,
        ];

        Mail::send('emails.notificationForAccept',  $data, function ($message) use ($data) {
            $message->to($data['author']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
        });
    }
}
