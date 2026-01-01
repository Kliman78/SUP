<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create a module with base structure, views, and routes';

    public function handle(): int
    {
        $module = Str::studly($this->argument('name'));   // Contracts
        $moduleLower = Str::lower($module);               // contracts
        $moduleKebab = Str::kebab($module);               // contracts

        $modulePath = app_path("Modules/$module");
        $viewsPath = "$modulePath/views";

        if (File::exists($modulePath))
        {
            $this->error("Module '{$module}' already exists");
            return self::FAILURE;
        }

        // --- Директории ---
        File::ensureDirectoryExists("$modulePath/Controllers");
        File::ensureDirectoryExists("$modulePath/Models");
        File::ensureDirectoryExists("$modulePath/Requests");
        File::ensureDirectoryExists("$modulePath/Services");
        File::ensureDirectoryExists("$modulePath/Policies");
        File::ensureDirectoryExists($viewsPath);

        // --- Controller ---
        File::put(
            "$modulePath/Controllers/{$module}Controller.php",
            $this->controllerStub($module, $moduleLower)
        );

        // --- Model ---
        File::put(
            "$modulePath/Models/{$module}.php",
            $this->modelStub($module)
        );

        // --- Request ---
        File::put(
            "$modulePath/Requests/{$module}Request.php",
            $this->requestStub($module)
        );

        // --- Routes ---
        File::put(
            "$modulePath/routes.php",
            $this->routesStub($module, $moduleKebab, $moduleLower)
        );

        // --- View ---
        File::put(
            "$viewsPath/index.blade.php",
            "<h1>{$module} Module</h1>\n"
        );

        $this->info("Module '{$module}' successfully created in {$modulePath}");

        return self::SUCCESS;
    }

    /* ========================
       Stub generators
       ======================== */

    protected function controllerStub(string $module, string $moduleLower): string
    {
        return <<<PHP
<?php

namespace App\Modules\\{$module}\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class {$module}Controller extends Controller
{
    public function index(Request \$request)
    {
        return view('{$moduleLower}::index');
    }
}

PHP;
    }

    protected function modelStub(string $module): string
    {
        return <<<PHP
<?php

namespace App\Modules\\{$module}\Models;

use Illuminate\Database\Eloquent\Model;

class {$module} extends Model
{
    protected \$guarded = [];
}

PHP;
    }

    protected function requestStub(string $module): string
    {
        return <<<PHP
<?php

namespace App\Modules\\{$module}\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {$module}Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
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
    Route::get('/', [{$module}Controller::class, 'index'])
        ->name('{$moduleLower}.index');
});

PHP;
    }
}
