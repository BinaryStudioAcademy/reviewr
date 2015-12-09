<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
        $this->app->singleton(
            'App\Services\Auth\Contracts\AuthServiceInterface',
            'App\Services\Auth\AuthService'
        );

        $this->app->bind(
            'App\Services\Auth\Contracts\UserUpdater',
            'App\Services\Auth\ProfileAPIUserUpdater'
        );
    }
}
