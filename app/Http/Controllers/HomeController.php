<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectInterest;
use App\Models\ProjectQuestion;
use App\Models\User;
use App\Notifications\InceptionMeetingRequestNotification;
use App\Notifications\ProjectInterestNotification;
use App\Notifications\ProjectQuestionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function loadProjectsPage()
    {
        // Get all projects from database
        $dbProjects = Project::with('clientCompany')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($project) {
                return [
                    'id' => $project->id,
                    'name' => $project->name,
                    'type' => $this->mapProjectType($project->project_type),
                    'description' => $project->description ?? 'A cutting-edge renewable energy project.',
                    'capacity' => $project->capacity_mw ? $project->capacity_mw . ' MW' : 'TBD',
                    'location' => $project->location ?? 'Kenya',
                    'project_type' => $project->project_type,
                    'isDatabase' => true,
                ];
            });

        return Inertia::render('Projects', [
            'dbProjects' => $dbProjects
        ]);
    }

    private function mapProjectType($type)
    {
        $mapping = [
            'SOLAR' => 'Solar',
            'BESS' => 'Solar',
            'SOLAR_BESS' => 'Solar',
            'OTHER' => 'Solar',
        ];
        return $mapping[$type] ?? 'Solar';
    }

    public function showProject($id)
    {
        $project = Project::with('clientCompany')->findOrFail($id);
        
        return Inertia::render('ProjectDetail', [
            'project' => $project
        ]);
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
            'questions' => 'nullable|array',
            'questions.*' => 'string|max:1000',
        ]);

        // Create a new project
        $project = Project::create([
            'uuid' => Str::uuid(),
            'name' => $request->project_name,
            'description' => 'Project initiated from public process page',
            'current_step' => 1,
            'qr_expires_at' => now()->addHours(48),
        ]);

        // Store questions if provided
        $questions = [];
        if ($request->has('questions') && is_array($request->questions)) {
            foreach ($request->questions as $questionText) {
                if (!empty($questionText)) {
                    $question = ProjectQuestion::create([
                        'project_name' => $request->project_name,
                        'company_name' => $request->company_name,
                        'contact_person' => $request->contact_person,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'question' => $questionText,
                    ]);
                    $questions[] = $questionText;
                }
            }
        }

        // Notify admins
        $admins = User::all(); // You may want to filter by role
        if ($admins->count() > 0) {
            Notification::send($admins, new InceptionMeetingRequestNotification(
                $request->only(['company_name', 'contact_person', 'email', 'phone', 'project_name']),
                $questions
            ));
        }

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

    public function recordInterest(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'interest_type' => 'required|in:general,investor,partner,other',
            'message' => 'nullable|string|max:1000',
        ]);

        $interest = ProjectInterest::create($request->all());

        // Notify admins
        $admins = User::all(); // You may want to filter by role
        if ($admins->count() > 0) {
            Notification::send($admins, new ProjectInterestNotification($interest));
            $interest->update([
                'admin_notified' => true,
                'notified_at' => now(),
            ]);
        }

        return back()->with('success', 'Thank you for your interest! We will contact you shortly.');
    }

    public function askQuestion(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'question' => 'required|string|max:1000',
        ]);

        $question = ProjectQuestion::create($request->all());

        // Notify admins
        $admins = User::all(); // You may want to filter by role
        if ($admins->count() > 0) {
            Notification::send($admins, new ProjectQuestionNotification($question));
            $question->update([
                'admin_notified' => true,
                'notified_at' => now(),
            ]);
        }

        return back()->with('success', 'Your question has been submitted. We will respond shortly.');
    }
}

