<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrud extends Command
{
    protected $signature = 'make:crud {name}';
    protected $description = 'Generate CRUD (controller, views, routes) inside a module';

    public function handle(): int
    {
        $module = Str::studly($this->argument('name'));   // Contracts
        $moduleLower = Str::lower($module);               // contracts
        $moduleKebab = Str::kebab($module);               // contracts

        $modulePath = app_path("Modules/$module");
        $viewsPath  = "$modulePath/views";

        if (!File::exists($modulePath)) {
            $this->error("Module '{$module}' does not exist. Run make:module first.");
            return self::FAILURE;
        }

        // --- Controller ---
        $controllerFile = "$modulePath/Controllers/{$module}Controller.php";
        File::put($controllerFile, $this->controllerStub($module, $moduleLower));

        // --- Routes ---
        $routesFile = "$modulePath/routes.php";
        File::put($routesFile, $this->routesStub($module, $moduleKebab, $moduleLower));

        // --- Views ---
        File::ensureDirectoryExists($viewsPath);
        File::put("$viewsPath/index.blade.php", "<h1>{$module} List</h1>");
        File::put("$viewsPath/create.blade.php", "<h1>Create {$module}</h1>");
        File::put("$viewsPath/edit.blade.php", "<h1>Edit {$module}</h1>");

        $this->info("CRUD for module '{$module}' successfully created.");

        return self::SUCCESS;
    }

    protected function controllerStub(string $module, string $moduleLower): string
    {
        return <<<PHP
<?php

namespace App\Modules\\{$module}\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class {$module}Controller extends Controller
{
    public function index()
    {
        return view('{$moduleLower}::index');
    }

    public function create()
    {
        return view('{$moduleLower}::create');
    }

    public function store(Request \$request)
    {
        // TODO: validation and store logic
        return redirect()->route('{$moduleLower}.index');
    }

    public function edit(\$id)
    {
        return view('{$moduleLower}::edit');
    }

    public function update(Request \$request, \$id)
    {
        // TODO: validation and update logic
        return redirect()->route('{$moduleLower}.index');
    }

    public function destroy(\$id)
    {
        // TODO: delete logic
        return redirect()->route('{$moduleLower}.index');
    }
}

PHP;
    }

    protected function routesStub(string $module, string $moduleKebab, string $moduleLower): string
    {
        return <<<PHP
<?php

use Illuminate\Support\Facades\Route;
use App\Modules\\{$module}\Controllers\\{$module}Controller;

Route::prefix('{$moduleKebab}')->group(function () {
    Route::get('/', [{$module}Controller::class, 'index'])->name('{$moduleLower}.index');
    Route::get('/create', [{$module}Controller::class, 'create'])->name('{$moduleLower}.create');
    Route::post('/store', [{$module}Controller::class, 'store'])->name('{$moduleLower}.store');
    Route::get('/{id}/edit', [{$module}Controller::class, 'edit'])->name('{$moduleLower}.edit');
    Route::post('/{id}/update', [{$module}Controller::class, 'update'])->name('{$moduleLower}.update');
    Route::delete('/{id}/delete', [{$module}Controller::class, 'destroy'])->name('{$moduleLower}.destroy');
});

PHP;
    }
}
