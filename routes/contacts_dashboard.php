<?php

use App\Http\Controllers\ContactsDashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('panel/contacts')->middleware(['auth', 'verified'])
->name('contacts-dashboard.')->group(function () {
    Route::get('/', [ContactsDashboardController::class, 'index'])
    ->name('index');
    Route::get('/{id}', [ContactsDashboardController::class, 'show'])
    ->name('show');
    Route::patch('/{id}', [ContactsDashboardController::class, 'update'])
    ->name('update');
    Route::delete('/destroy/{id}', [ContactsDashboardController::class, 'destroy'])
    ->name('destroy');
});