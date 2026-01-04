<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

/**
 * Собирает модули для меню из папки Modules.
 * @return array
 */
class ModuleMenu
{
  /**
   * Возвращает массив модулей, готовых для меню.
   *
   * @return array
   */

  public static function all(): array
  {
    $modulesPath = app_path('Modules');

    if (!File::exists($modulesPath))
    {
      return [];
    }

    // читаем простой массив порядка
    $order = config('menu_items', []);

    $modules = [];

    foreach (File::directories($modulesPath) as $modulePath)
    {
      $configFile = $modulePath . '/module.php';
      if (!File::exists($configFile))
      {
        continue;
      }

      $config = require $configFile;

      // пропускаем, если модуль не в массиве
      if (!in_array($config['id'], $order))
      {
        continue;
      }

      $modules[$config['id']] = $config;
    }

    // сортируем по массиву
    $sorted = [];
    foreach ($order as $id)
    {
      if (isset($modules[$id]))
      {
        $sorted[] = $modules[$id];
      }
    }
    return $sorted;
  }

}
