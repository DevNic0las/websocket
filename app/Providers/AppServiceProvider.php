<?php

namespace App\Providers;

use App\Events\testeLog;
use App\Listeners\Logteste;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
        protected $listen = [
        testeLog::class => [
            Logteste::class,
        ],
    ];
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
        //
    }
}
