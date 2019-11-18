<?php

namespace App\Providers;

use Riak\Connection;
use Illuminate\Support\ServiceProvider;
use App\Coinbase;

class CoinbaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Coinbase::class, function ($app) {
            return new Coinbase();
        });
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
