<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsDashboardController;
use App\Http\Controllers\ProjectTypesDashboardController;
use App\Http\Controllers\SkillGroupsDashboardController;
use App\Http\Controllers\SkillsDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/proyectos', [ProjectsController::class, 'index'])->name('projects.index');

Route::get('/proyectos/por-tipo/{slug}', [ProjectsController::class, 'filtered_projects'])->name('projects.filtered_projects');

Route::get('/proyectos/{slug}', [ProjectsController::class, 'show'])->name('projects.projects-show');

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/categoria/{slug}', [BlogController::class, 'category'])->name('blog.category');
});

Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');

Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

Route::get('/contacto/contacto-exitoso', [ContactController::class, 'success'])->name('contact.success');

// Rutas del dashboard

Route::get('/panel', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
