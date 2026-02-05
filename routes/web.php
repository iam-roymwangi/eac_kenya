<?php

use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OnboardingController;
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

// Admin Routes (protected by auth middleware)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.projects.index');
    })->name('index');
    
    Route::resource('projects', ProjectAdminController::class);
    Route::post('projects/{project}/generate-qr', [ProjectAdminController::class, 'generateQr'])
        ->name('projects.generate-qr');
    Route::post('projects/{project}/reset-step', [ProjectAdminController::class, 'resetStep'])
        ->name('projects.reset-step');
});

// Onboarding Routes
Route::prefix('onboarding')->group(function () {
    // Step 1: NDA Signing
    Route::get('/{uuid}', [OnboardingController::class, 'stepOne'])
        ->middleware('onboarding.step:1')
        ->name('onboarding.step-one');
    Route::post('/{uuid}/step-one', [OnboardingController::class, 'submitStepOne'])
        ->name('onboarding.submit-step-one');
    
    // Step 2: Inception Meeting
    Route::get('/{uuid}/inception', [OnboardingController::class, 'stepTwo'])
        ->middleware('onboarding.step:2')
        ->name('onboarding.step-two');
    Route::post('/{uuid}/step-two', [OnboardingController::class, 'submitStepTwo'])
        ->name('onboarding.submit-step-two');
    
    // Step 3: RFQ & Documentation
    Route::get('/{uuid}/rfq', [OnboardingController::class, 'stepThree'])
        ->middleware('onboarding.step:3')
        ->name('onboarding.step-three');
    Route::post('/{uuid}/step-three', [OnboardingController::class, 'submitStepThree'])
        ->name('onboarding.submit-step-three');
    
    // Completion
    Route::get('/{uuid}/complete', [OnboardingController::class, 'complete'])
        ->name('onboarding.complete');
});

require __DIR__.'/settings.php';
