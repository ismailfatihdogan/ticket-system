<?php

namespace App\Providers;

use App\Repositories\Interfaces\ITagRepository;
use App\Repositories\Interfaces\ITicketRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Ticket\TagRepository;
use App\Repositories\Ticket\TicketRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ITicketRepository::class, TicketRepository::class);
        $this->app->bind(ITagRepository::class, TagRepository::class);
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
