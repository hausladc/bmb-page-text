<?php

namespace Bmb\PageText\Providers;

use Illuminate\Support\ServiceProvider;

class PageTextServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Helper laden
        if (file_exists(__DIR__ . '/../../helpers.php')) {
            require_once __DIR__ . '/../../helpers.php';
        }
    }

    public function register() {}
}
