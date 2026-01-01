<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        if (!File::exists($modulesPath)) {
            return;
        }

        $modules = File::directories($modulesPath);

        foreach ($modules as $modulePath) {
            $moduleName = basename($modulePath); // Contracts
            $moduleLower = Str::lower($moduleName); // contracts

            // --- Подключаем routes.php ---
            $routesFile = $modulePath . '/routes.php';
            if (File::exists($routesFile)) {
                $this->loadRoutesFrom($routesFile);
            }

            // --- Подключаем views ---
            $viewsPath = $modulePath . '/views';
            if (File::exists($viewsPath)) {
                $this->loadViewsFrom($viewsPath, $moduleLower);
            }

            // --- Можно добавить migrations, translations и assets ---
        }
    }
}
