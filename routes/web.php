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

Route::prefix('proyectos')
->name('projects.')
->group(function () {
    Route::get('/proyectos', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/proyectos/por-tipo/{slug}', [ProjectsController::class, 'filtered_projects'])->name('projects.filtered_projects');
    Route::get('/proyectos/{slug}', [ProjectsController::class, 'show'])->name('projects.projects-show');
});

Route::prefix('blog')
->name('blog.')
->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/categoria/{slug}', [BlogController::class, 'category'])->name('category');
});

Route::prefix('contacto')
->name('contact.')
->group(function (){
    Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/contacto/contacto-exitoso', [ContactController::class, 'success'])->name('contact.success');
});

// Rutas del dashboard

Route::get('/panel', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/project_types_dashboard.php';
require __DIR__.'/projects_dashboard.php';
require __DIR__.'/skill_groups_dashboard.php';
require __DIR__.'/skills_dashboard.php';
require __DIR__.'/blog_categories_dashboard.php';

