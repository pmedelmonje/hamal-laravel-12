<?php

use App\Http\Controllers\ProjectTypesDashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('panel/project-types')->middleware(['auth', 'verified'])
->name('project-types-dashboard.')->group(function () {
    Route::get('/', [ProjectTypesDashboardController::class, 'index'])
    ->name('index');
    Route::get('/create', [ProjectTypesDashboardController::class, 'create'])
    ->name('create');
    Route::get('/info/{slug}', [ProjectTypesDashboardController::class, 'show'])
    ->name('show');
    Route::post('/create', [ProjectTypesDashboardController::class, 'store'])
    ->name('store');
    Route::patch('/info/{slug}', [ProjectTypesDashboardController::class, 'update'])
    ->name('update');
    Route::delete('/destroy/{slug}', [ProjectTypesDashboardController::class, 'destroy'])
    ->name('destroy');
});