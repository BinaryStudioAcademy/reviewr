<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
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
        $this->app->singleton('App\Repositories\Interfaces\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->singleton('App\Repositories\Interfaces\RequestRepositoryInterface', 'App\Repositories\RequestRepository');
        $this->app->singleton('App\Repositories\Interfaces\CommentRepositoryInterface', 'App\Repositories\CommentRepository');
        $this->app->singleton('App\Repositories\Interfaces\GroupRepositoryInterface', 'App\Repositories\GroupRepository');
        $this->app->singleton('App\Repositories\Interfaces\TagRepositoryInterface', 'App\Repositories\TagRepository');
        $this->app->singleton('App\Repositories\Interfaces\DepartmentRepositoryInterface', 'App\Repositories\DepartmentRepository');
        $this->app->singleton('App\Repositories\Interfaces\JobRepositoryInterface', 'App\Repositories\JobRepository');
        $this->app->singleton('App\Repositories\Interfaces\BadgeRepositoryInterface', 'App\Repositories\BadgeRepository');
        $this->app->singleton('App\Repositories\Interfaces\NotificationRepositoryInterface', 'App\Repositories\NotificationRepository');
    }
}
