<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Interfaces\AchieveServiceInterface', 'App\Services\AchieveService');
        $this->app->bind('App\Services\Interfaces\ChatServiceInterface', 'App\Services\ChatService');
        $this->app->bind('App\Services\Interfaces\MailServiceInterface', 'App\Services\MailService');
        $this->app->bind('App\Services\Interfaces\RequestServiceInterface', 'App\Services\RequestService');
    }
}
