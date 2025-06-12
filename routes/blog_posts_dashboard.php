<?php

use App\Http\Controllers\BlogPostsDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('panel/blog-posts')->middleware(['auth', 'verified'])
->name('blog-posts-dashboard.')->group(function () {
    Route::get('/', [BlogPostsDashboardController::class, 'index'])
    ->name('index');
    Route::get('/create', [BlogPostsDashboardController::class, 'create'])
    ->name('create');
    Route::get('/info/{slug}', [BlogPostsDashboardController::class, 'show'])
    ->name('show');
    Route::post('/create', [BlogPostsDashboardController::class, 'store'])
    ->name('store');
    Route::patch('/info/{slug}', [BlogPostsDashboardController::class, 'update'])
    ->name('update');
    Route::delete('/destroy/{slug}', [BlogPostsDashboardController::class, 'destroy'])
    ->name('destroy');
});