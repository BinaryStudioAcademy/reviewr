<?php

namespace App\Listeners;

use App\User;
use App\Events\UserWasDecline;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\MailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class UserDeclineNotification implements ShouldQueue
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
     * @param  UserWasDecline  $event
     * @return void
     */
    public function handle(UserWasDecline $event)
    {
        $request = $event->request;
        $offer = $event->offer;
//       $author = User::find($request->user_id);
//       $data = [
//           'author' => $author,
//           'request' => $request,
//           'user' =>$offer,
//        ];


        $url = "http://team.binary-studio.com/app/api/notification";
        $post_data = array(
            'title' => 'Notification',
            'text' => 'Your offer for ' . $request->title . ' was declined',
            'url' => 'team.binary-studio.com/reviewr',
            'sound' => 'true',
            'serviceType'=> "Code Review Requests",
            'users'=> [$offer->id]
        );
        $content = json_encode($post_data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        curl_close($curl);


//        Mail::send('emails.notificationForDecline',  $data, function ($message) use ($data) {
//            $message->to($data['user']->email, $data['user']->first_name .' ' . $data['user']->last_name)->subject('Notification from reviewer');
//        });
    }
}
