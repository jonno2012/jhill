<?php

namespace App\Providers;

use App\Clients\ClientInterface;
use App\Clients\Reqres;
use App\Services\GuzzleHttp;
use App\Services\HttpInterface;
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
        $this->app->bind(ClientInterface::class, Reqres::class);
        $this->app->bind(HttpInterface::class, GuzzleHttp::class);
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
