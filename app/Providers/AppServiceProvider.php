<?php

namespace App\Providers;

use App\Models\TestDeliveryModel;
use App\Observers\TestDeliveryObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TestDeliveryModel::observe(TestDeliveryObserver::class);
    }
}
