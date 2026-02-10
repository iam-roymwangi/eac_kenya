<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function loadProjectsPage()
    {
        return Inertia::render('Projects');
    }

    public function loadAboutPage()
    {
        return Inertia::render('About');
    }

    public function loadProcessPage()
    {
        return Inertia::render('Process');
    }

    public function loadContactPage()
    {
        return Inertia::render('Contact');
    }
    
    public function loadPrivacyPolicyPage()
    {
        return Inertia::render('PrivacyPolicy');
    }

    public function initiateInception(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'project_name' => 'required|string|max:255',
        ]);

        // Create a new project
        $project = Project::create([
            'uuid' => Str::uuid(),
            'name' => $request->project_name,
            'description' => 'Project initiated from public process page',
            'current_step' => 1,
            'qr_expires_at' => now()->addHours(48),
        ]);

        // Generate QR URL
        $qrUrl = URL::temporarySignedRoute(
            'onboarding.step-one',
            $project->qr_expires_at,
            ['uuid' => $project->uuid]
        );

        return Inertia::render('InceptionQR', [
            'project' => $project,
            'qr_url' => $qrUrl,
            'contact_info' => [
                'company_name' => $request->company_name,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
            ]
        ]);
    }
}

