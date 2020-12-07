<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader;

use Illuminate\Support\ServiceProvider;

class PackageEnvLoaderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'solumdesignum');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'solumdesignum');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
        $this->mergeConfigFrom(__DIR__.'/../config/package-env-loader.php', 'package-env-loader');

        // Register the service the package provides.
        $this->app->singleton('package-env-loader', function ($app) {
            return new PackageEnvLoader;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['package-env-loader'];
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
            __DIR__.'/../config/package-env-loader.php' => config_path('package-env-loader.php'),
        ], 'package-env-loader.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/solumdesignum'),
        ], 'package-env-loader.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/solumdesignum'),
        ], 'package-env-loader.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/solumdesignum'),
        ], 'package-env-loader.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
