<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FamiliaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\FamiliaServiceInterface',
            'App\Services\FamiliaService'
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
