<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RemoteDataGrabberProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'App\Services\RemoteDataGrabber\Contracts\DataGrabberInterface',
            'App\Services\RemoteDataGrabber\CurlDataGrabber'
        );
    }
}
