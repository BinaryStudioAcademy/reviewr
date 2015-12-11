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
        $this->app->singleton('App\Repositories\Contracts\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->singleton('App\Repositories\Contracts\RequestRepositoryInterface', 'App\Repositories\RequestRepository');
        $this->app->singleton('App\Repositories\Contracts\CommentRepositoryInterface', 'App\Repositories\CommentRepository');
        $this->app->singleton('App\Repositories\Contracts\GroupRepositoryInterface', 'App\Repositories\GroupRepository');
        $this->app->singleton('App\Repositories\Contracts\TagRepositoryInterface', 'App\Repositories\TagRepository');
        $this->app->singleton('App\Repositories\Contracts\DepartmentRepositoryInterface', 'App\Repositories\DepartmentRepository');
        $this->app->singleton('App\Repositories\Contracts\JobRepositoryInterface', 'App\Repositories\JobRepository');
        $this->app->singleton('App\Repositories\Contracts\BadgeRepositoryInterface', 'App\Repositories\BadgeRepository');
    }
}
