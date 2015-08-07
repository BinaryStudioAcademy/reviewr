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
        $this->app->bind('App\Repositories\Interfaces\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\Interfaces\RequestRepositoryInterface', 'App\Repositories\RequestRepository');
        $this->app->bind('App\Repositories\Interfaces\CommentRepositoryInterface', 'App\Repositories\CommentRepository');
        $this->app->bind('App\Repositories\Interfaces\GroupRepositoryInterface', 'App\Repositories\GroupRepository');
        $this->app->bind('App\Repositories\Interfaces\TagRepositoryInterface', 'App\Repositories\TagRepository');
        $this->app->bind('App\Repositories\Interfaces\DepartmentRepositoryInterface', 'App\Repositories\DepartmentRepository');
        $this->app->bind('App\Repositories\Interfaces\JobRepositoryInterface', 'App\Repositories\JobRepository');
        $this->app->bind('App\Repositories\Interfaces\BadgeRepositoryInterface', 'App\Repositories\BadgeRepository');
    }
}
