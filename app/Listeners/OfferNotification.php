<?php

namespace App\Listeners;

use App\User;
use App\Events\OfferWasSent;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\MailService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use Mail;

class OfferNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  OfferWasSent  $event
     * @return void
     */
    public function handle(OfferWasSent $event)
    {
        $request = $event->request;
        $offer = $event->offer;
        $author = User::find($request->user_id);
        $data = [
           'author' => $author,
           'request' => $request,
           'user' =>$offer,
           'hash_user' =>Crypt::encrypt($offer->id),
           'hash_req' =>Crypt::encrypt($request->id),

        ];
       
        Mail::send('emails.notificationForOffer',  $data, function ($message) use ($data) {
            $message->to($data['author']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('You have a new offer to request!');
        });
    }
}
