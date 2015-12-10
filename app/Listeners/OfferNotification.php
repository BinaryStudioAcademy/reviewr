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
        $author = User::find($request->user_id);

        $url = "http://team.binary-studio.com/app/api/notification";
        $post_data = array(
            'title' => 'Notification',
            'text' => 'You have unread offer for ' . $request->title,
            'url' => 'team.binary-studio.com/reviewr',
            'sound' => 'true',
            'serviceType'=> "Code Review Requests",
            'users'=> [$author->id]

        );
        $cookie = $_COOKIE['x-access-token'];
        $content = json_encode($post_data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_COOKIE, "x-access-token=".$cookie);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        curl_close($curl);

//        Mail::send('emails.notificationForOffer',  $data, function ($message) use ($data) {
//            $message->to($data['author']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('You have a new offer to request!');
//        });
    }
}
