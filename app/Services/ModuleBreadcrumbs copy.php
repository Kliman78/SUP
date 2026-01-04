<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class ModuleBreadcrumbs
{
    public static function current(): ?array
    {
        $menu = ModuleMenu::all();
        $currentRoute = Route::currentRouteName();

        foreach ($menu as $module) {
            if ($module['route'] === $currentRoute) {
                return [
                    [
                        'title' => 'Главная',
                        'route' => 'home',
                    ],
                    [
                        'title' => $module['breadcrumb'] ?? $module['name'],
                        'route' => $module['route'],
                    ],
                ];
            }
        }

        return null;
    }
}
