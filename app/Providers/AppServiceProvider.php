<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\SystemContent;

class AppServiceProvider extends ServiceProvider
{
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
    public function boot()
    {
        // Default migrations path
        $paths = [database_path('migrations')];

        // Add custom migrations paths
        $paths[] = database_path('migrations/admin_migrations');
        $paths[] = database_path('migrations/general_migrations');
        $paths[] = database_path('migrations/moderator_migrations');

        // Register the custom paths
        $this->loadMigrationsFrom($paths);

        // Global View Composer to make sysconData available in all views
        View::composer('*', function ($view) {
            $sysconData = SystemContent::all();
            $view->with('sysconData', $sysconData);
        });
    }
}
