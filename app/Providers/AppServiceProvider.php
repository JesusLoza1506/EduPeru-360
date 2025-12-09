<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrar Google Drive ServiceProvider si existe
        if (class_exists(\Masbug\Flysystem\GoogleDrive\GoogleDriveServiceProvider::class)) {
            $this->app->register(\Masbug\Flysystem\GoogleDrive\GoogleDriveServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
