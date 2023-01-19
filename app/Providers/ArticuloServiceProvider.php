<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ArticuloServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\ArticuloServiceInterface',
            'App\Services\ArticuloService'
        );
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
