<?php

use App\Http\Controllers\SkillsDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('panel/skills')->middleware(['auth', 'verified'])
->name('skills-dashboard.')->group(function () {
    Route::get('/', [SkillsDashboardController::class, 'index'])
    ->name('index');
    Route::get('/create', [SkillsDashboardController::class, 'create'])
    ->name('create');
    Route::post('/create', [SkillsDashboardController::class, 'store'])
    ->name('store');
    Route::get('/info/{id}', [SkillsDashboardController::class, 'show'])
    ->name('show');
    Route::patch('/info/{id}', [SkillsDashboardController::class, 'update'])
    ->name('update');
    Route::delete('/destroy/{id}', [SkillsDashboardController::class, 'destroy'])
    ->name('destroy');
});