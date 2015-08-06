<?php

namespace App\Listeners;

use App\User;
use App\Events\OfferWasSent;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\MailService;
use Illuminate\Contracts\Queue\ShouldQueue;
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
           'first_name' => $author->first_name,
           'last_name' =>  $author->last_name,
           'email' => $author->email,
           'request_title' => $request->title,
           'offer_first_name' => $offer->first_name,
           'offer_last_name' => $offer->last_name,
           'offer_phone' => $offer->phone,
           'offer_email' => $offer->email,
           'offer_reputation' => $offer->reputation,
           'offer_job' => $offer->job->position,
           'avatar' => $offer->avatar,
        ];

        Mail::queue('emails.notificationForOffer',  $data, function ($message) use ($data) {
            $message->to($data['email'], $data['first_name'] .' ' . $data['last_name'])->subject('You have a new offer to request!');
        });
    }
}
