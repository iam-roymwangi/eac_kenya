<?php

use App\Http\Controllers\Admin\ClientAdminController;
use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    // Get featured projects from database
    $dbProjects = \App\Models\Project::orderBy('created_at', 'desc')
        ->take(3)
        ->get()
        ->map(function ($project) {
            return [
                'id' => $project->id,
                'name' => $project->name,
                'location' => $project->location ?? 'Kenya',
                'capacity' => $project->capacity_mw ? $project->capacity_mw . 'MW' : 'TBD',
                'bess' => in_array($project->project_type, ['BESS', 'SOLAR_BESS']),
                'image' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=2070&auto=format&fit=crop',
                'isDatabase' => true,
            ];
        });

    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
        'dbProjects' => $dbProjects,
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/projects', [HomeController::class, 'loadProjectsPage'])->name('projects');
Route::get('/projects/{id}', [HomeController::class, 'showProject'])->name('projects.show');
Route::get('/about', [HomeController::class, 'loadAboutPage'])->name('about');
Route::get('/contact', [HomeController::class, 'loadContactPage'])->name('contact');
Route::get('/our-process', [HomeController::class, 'loadProcessPage'])->name('process');
Route::get('/privacy-policy', [HomeController::class, 'loadPrivacyPolicyPage'])->name('privacy-policy');

// Public route for initiating inception meeting
Route::post('/initiate-inception', [HomeController::class, 'initiateInception'])->name('initiate-inception');

// Public routes for project interest and questions
Route::post('/projects/record-interest', [HomeController::class, 'recordInterest'])->name('projects.record-interest');
Route::post('/projects/ask-question', [HomeController::class, 'askQuestion'])->name('projects.ask-question');

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
    Route::post('projects/{project}/schedule-inception', [ProjectAdminController::class, 'scheduleInception'])
        ->name('projects.schedule-inception');
    
    // Client management
    Route::get('clients', [ClientAdminController::class, 'index'])
        ->name('clients.index');
    Route::get('clients/{interest}', [ClientAdminController::class, 'show'])
        ->name('clients.show');
    Route::post('clients/{interest}/request-profile', [ClientAdminController::class, 'requestCompanyProfile'])
        ->name('clients.request-profile');
    
    // Project interests and questions
    Route::get('interests', [ProjectAdminController::class, 'interests'])
        ->name('interests.index');
    Route::get('questions', [ProjectAdminController::class, 'questions'])
        ->name('questions.index');
    Route::post('questions/{question}/respond', [ProjectAdminController::class, 'respondToQuestion'])
        ->name('questions.respond');
});

// Client Portal Routes
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('client/Dashboard');
    })->name('index');

    // Client project views (scoped to company on the controller)
    Route::get('/projects', [\App\Http\Controllers\Client\ClientController::class, 'index'])
        ->name('projects.index');
});

// Financer Portal Routes
Route::middleware(['auth', 'verified'])->prefix('financer')->name('financer.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('financer/Dashboard');
    })->name('index');

    Route::get('/projects', [\App\Http\Controllers\Financer\FinancerController::class, 'index'])
        ->name('projects.index');
});

// Onboarding Routes
Route::prefix('onboarding')->group(function () {
    // Step 1: Inception Meeting
    Route::get('/{uuid}', [OnboardingController::class, 'stepOne'])
        ->middleware('onboarding.step:1')
        ->name('onboarding.step-one');
    Route::post('/{uuid}/step-one', [OnboardingController::class, 'submitStepOne'])
        ->name('onboarding.submit-step-one');
    
    // Step 2: NDA Signing
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
