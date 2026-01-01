<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\ModuleMenu;
use App\Services\ModuleBreadcrumbs;

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
    View::composer('*', function ($view) {
        $view->with('moduleMenu', ModuleMenu::all());
        $view->with('breadcrumbs', ModuleBreadcrumbs::current());
    });
    }
}
