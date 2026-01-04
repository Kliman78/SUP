<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class ModuleBreadcrumbs
{
    public static function current(): array
    {
        $currentRoute = Route::currentRouteName(); // Например: contracts.create
        $breadcrumbs = [
            [
                'title' => 'Главная',
                'route' => 'home',
            ]
        ];

        $modulesPath = app_path('Modules');

        if (!File::exists($modulesPath)) {
            return $breadcrumbs;
        }

        foreach (File::directories($modulesPath) as $modulePath) {
            $configFile = $modulePath . '/module.php';
            if (!File::exists($configFile)) continue;

            $config = require $configFile;

            $moduleBaseRoute = explode('.', $config['route'])[0]; // contracts
            if (str_starts_with($currentRoute, $moduleBaseRoute)) {
                // 1️⃣ Добавляем модуль
                $breadcrumbs[] = [
                    'title' => $config['breadcrumb'] ?? $config['name'],
                    'route' => $config['route'],
                ];

                // 2️⃣ Добавляем действие, если не index
                if ($currentRoute !== $config['route']) {
                    $action = explode('.', $currentRoute)[1] ?? null;
                    $actionTitle = $config['actions'][$action] ?? ucfirst($action ?? '');
                    $breadcrumbs[] = [
                        'title' => $actionTitle,
                        'route' => $currentRoute,
                    ];
                }
                break;
            }
        }

        return $breadcrumbs;
    }
}
