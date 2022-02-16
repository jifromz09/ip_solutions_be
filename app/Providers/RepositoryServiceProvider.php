<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\EloquentRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\IPAddressRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\BaseRepository;
use App\Repositories\IPAddress\IPAddressRepository;

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
       $this->app->bind(IPAddressRepositoryInterface::class, IPAddressRepository::class);
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
