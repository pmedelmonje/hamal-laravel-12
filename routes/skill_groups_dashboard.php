<?php

use App\Http\Controllers\SkillGroupsDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('panel/skill-gropus')->middleware(['auth', 'verified'])
->name('skill-groups-dashboard.')->group(function () {
    Route::get('/', [SkillGroupsDashboardController::class, 'index'])
    ->name('index');
    Route::get('/create', [SkillGroupsDashboardController::class, 'create'])
    ->name('create');
    Route::post('/create', [SkillGroupsDashboardController::class, 'store'])
    ->name('store');
    Route::get('/info/{id}', [SkillGroupsDashboardController::class, 'show'])
    ->name('show');
    Route::patch('/info/{id}', [SkillGroupsDashboardController::class, 'update'])
    ->name('update');
    Route::delete('/destroy/{id}', [SkillGroupsDashboardController::class, 'destroy'])
    ->name('destroy');
});