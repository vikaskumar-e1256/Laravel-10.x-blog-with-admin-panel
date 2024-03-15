<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Paginator::useBootstrap();

        $menuItems = [
            ['route' => 'site.home', 'label' => 'Home'],
            ['route' => 'site.pricing', 'label' => 'Pricing'],
            ['route' => 'site.about', 'label' => 'About'],
            ['route' => 'site.contact', 'label' => 'Contact'],
        ];

        // Share menu items with all views
        View::composer('*', function ($view) use ($menuItems) {
            $view->with('menuItems', $menuItems);
        });
    }
}
