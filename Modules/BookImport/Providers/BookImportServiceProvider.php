<?php

namespace Modules\BookImport\Providers;

use Illuminate\Support\ServiceProvider;

class BookImportServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(module_path('BookImport', '/Database/Migrations'));

        $this->loadViewsFrom(module_path('BookImport', '/Resources/views'), 'bookimport');

        $this->loadRoutesFrom(module_path('BookImport', '/Routes/web.php'));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
