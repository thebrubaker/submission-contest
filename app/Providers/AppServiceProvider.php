<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\UserRepository',
            'App\Repositories\Eloquent\UserRepositoryContract'
        );

        $this->app->bind(
            'App\Repositories\SubmissionRepository',
            'App\Repositories\Eloquent\SubmissionRepositoryContract'
        );

        $this->app->bind(
            'App\Repositories\ProfileRepository',
            'App\Repositories\Eloquent\ProfileRepositoryContract'
        );

        $this->app->bind(
            'App\Repositories\VoteRepository',
            'App\Repositories\Eloquent\VoteRepositoryContract'
        );

        $this->app->bind(
            'App\Services\FacebookService',
            'App\Services\FacebookSDK\FacebookServiceContract'
        );
    }
}
