<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Clients\Controllers\ClientsController;

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientsController::class, 'index'])
        ->name('clients.index');
});
