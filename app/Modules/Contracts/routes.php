<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Contracts\Controllers\ContractsController;

Route::prefix('contracts')->group(function ()
{
    Route::get('/', [ContractsController::class, 'index'])->name('contracts.index');
    Route::get('/create', [ContractsController::class, 'create'])->name('contracts.create');
    Route::post('/store', [ContractsController::class, 'store'])->name('contracts.store');
    // Route::get('/{id}/edit', [ContractsController::class, 'edit'])->name('contracts.edit');
    // Route::post('/{id}/update', [ContractsController::class, 'update'])->name('contracts.update');
    // Route::delete('/{id}/delete', [ContractsController::class, 'destroy'])->name('contracts.destroy');
    Route::get('/edit', [ContractsController::class, 'edit'])->name('contracts.edit');
    Route::get('/show', [ContractsController::class, 'edit'])->name('contracts.show');
    Route::post('/update', [ContractsController::class, 'update'])->name('contracts.update');
    Route::delete('/delete', [ContractsController::class, 'destroy'])->name('contracts.destroy');

});
