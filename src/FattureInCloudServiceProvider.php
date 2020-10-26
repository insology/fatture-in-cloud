<?php

namespace InsologyStudio\FattureInCloud;

use InsologyStudio\FattureInCloud\FattureInCloud as FIC; 

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
            __DIR__.'/../config/fatture-in-cloud.php' => config_path('fatture-in-cloud.php'),
        ], 'config');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/fatture-in-cloud.php', 'fatture-in-cloud');
        // Register the service the package provides.
        $this->app->singleton('fatture-in-cloud', function ($app) {
            return new FIC;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['fatture-in-cloud'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/fatture-in-cloud.php' => config_path('fatture-in-cloud.php'),
        ], 'fatture-in-cloud.config');

    }
}
