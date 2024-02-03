<?php

namespace App\Providers;

use App\Models\Log;
use App\Observers\LogObserver;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        Log::observe(LogObserver::class);
        moonShineAssets()->add([
            '/moonshine.css'
        ]);

    }
}
