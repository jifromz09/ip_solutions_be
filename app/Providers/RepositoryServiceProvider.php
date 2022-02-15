<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\EloquentRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\BaseRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
