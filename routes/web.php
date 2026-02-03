<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/projects', [HomeController::class, 'loadProjectsPage'])->name('projects');
Route::get('/about', [HomeController::class, 'loadAboutPage'])->name('about');
Route::get('/contact', [HomeController::class, 'loadContactPage'])->name('contact');
Route::get('/our-process', [HomeController::class, 'loadProcessPage'])->name('process');
Route::get('/privacy-policy', [HomeController::class, 'loadPrivacyPolicyPage'])->name('privacy-policy');

require __DIR__.'/settings.php';
