<?php

use App\Http\Controllers\BlogCategoriesDashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('panel/blog-categories')->middleware(['auth', 'verified'])
->name('blog-categories-dashboard.')->group(function () {
    Route::get('/', [BlogCategoriesDashboardController::class, 'index'])
    ->name('index');
    Route::get('/create', [BlogCategoriesDashboardController::class, 'create'])
    ->name('create');
    Route::get('/info/{slug}', [BlogCategoriesDashboardController::class, 'show'])
    ->name('show');
    Route::post('/create', [BlogCategoriesDashboardController::class, 'store'])
    ->name('store');
    Route::patch('/info/{slug}', [BlogCategoriesDashboardController::class, 'update'])
    ->name('update');
    Route::delete('/destroy/{slug}', [BlogCategoriesDashboardController::class, 'destroy'])
    ->name('destroy');
});