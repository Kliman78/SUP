<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        if (!File::exists($modulesPath)) {
            return;
        }

        foreach (File::directories($modulesPath) as $modulePath) {

            $moduleConfigFile = $modulePath . '/module.php';
            if (!File::exists($moduleConfigFile)) {
                continue;
            }

            $config = require $moduleConfigFile;

            // routes
            $routesFile = $modulePath . '/routes.php';
            if (File::exists($routesFile)) {
                $this->loadRoutesFrom($routesFile);
            }

            // views
            $viewsPath = $modulePath . '/views';
            if (File::exists($viewsPath) && !empty($config['id'])) {
                $this->loadViewsFrom($viewsPath, $config['id']);
            }
        }
    }
}
