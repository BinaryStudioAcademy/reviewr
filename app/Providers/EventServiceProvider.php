<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\OfferWasSent' => [
            'App\Listeners\DeliveryHandlers\HttpHandlers\OfferSendingNotification',
        ],
        'App\Events\UserWasAccepted' => [
            'App\Listeners\DeliveryHandlers\HttpHandlers\UserAcceptingNotification',
        ],
        'App\Events\UserWasDeclined' => [
            'App\Listeners\DeliveryHandlers\HttpHandlers\UserDecliningNotification',
        ],
        'App\Events\ReviewDateWasAssigned' => [
            'App\Listeners\DeliveryHandlers\HttpHandlers\ReviewDateAssigningNotification',
        ],
        'App\Events\ReviewDateWasChanged' => [
            'App\Listeners\DeliveryHandlers\HttpHandlers\ReviewDateChangingNotification',
        ],
        'App\Events\ReviewDateWasCleared' => [
            'App\Listeners\DeliveryHandlers\HttpHandlers\ReviewDateClearingNotification',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
