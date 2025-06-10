<?php

use App\Http\Controllers\ProjectsDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('panel/projects')->middleware(['auth', 'verified'])
->name('projects-dashboard.')->group(function () {
    Route::get('/', [ProjectsDashboardController::class, 'index'])
    ->name('index');
    Route::get('/create', [ProjectsDashboardController::class, 'create'])
    ->name('create');
    Route::post('/create', [ProjectsDashboardController::class, 'store'])
    ->name('store');
    Route::get('/project/{slug}', [ProjectsDashboardController::class, 'show'])
    ->name('show');
    // Route::get('/edit/{slug}', [ProjectsDashboardController::class, 'edit'])
    // ->name('edit');
    Route::patch('/edit/{slug}', [ProjectsDashboardController::class, 'update'])
    ->name('update');
    Route::delete('/destroy/{id}', [ProjectsDashboardController::class, 'destroy'])
    ->name('destroy');
});