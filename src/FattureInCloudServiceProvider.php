<?php

namespace InsologyStudio\FattureInCloud;

use Illuminate\Support\ServiceProvider;

class FattureInCloudServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/fatture-in-cloud.php' => config_path('fatture-in-cloud.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/fatture-in-cloud.php', 'fatture-in-cloud'
        );

        $this->app->singleton(FattureInCloud::class, fn() => new FattureInCloud());
    }
}
