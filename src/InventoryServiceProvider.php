<?php

namespace Goodarzi\Inventory;

use Illuminate\Support\ServiceProvider;
use Goodarzi\Inventory\View\Components\AdminLayout;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'inventoryview');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewComponentsAs('inventoryview', [
            AdminLayout::class,
        ]);
    }
}
