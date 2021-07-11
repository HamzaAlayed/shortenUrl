<?php

namespace App\Providers;

use App\Contracts\ShortenUrlInterface;
use App\Repositories\ShortenUrlRepository;
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
        $this->app->bind(ShortenUrlInterface::class, ShortenUrlRepository::class);
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
