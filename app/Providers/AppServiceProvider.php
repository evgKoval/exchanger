<?php

namespace App\Providers;

use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CurrencyInterface;
use App\Interfaces\ArrayCurrencyRepository;
use App\Interfaces\ChargeInterface;
use App\Interfaces\ChargeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningUnitTests()) {
            Schema::defaultStringLength(191);
        }

        $this->app->bind(CurrencyInterface::class, 
            ArrayCurrencyRepository::class);

        $this->app->bind(ChargeInterface::class, 
            ChargeRepository::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
