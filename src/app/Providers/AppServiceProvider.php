<?php

namespace App\Providers;

use App\Repositories\ExchangeRepository;
use App\Repositories\InMemoryExchangeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExchangeRepository::class, InMemoryExchangeRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
