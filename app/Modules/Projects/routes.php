<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Projects\Controllers\ProjectsController;

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'index'])
        ->name('projects.index');
});
