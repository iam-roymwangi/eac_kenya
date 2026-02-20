<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectInterest;
use App\Models\ProjectQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProjectAdminController extends Controller
{
    public function index()
    {
        $projects = Project::with('clientCompany')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Add interests and questions count to each project
        $projects->getCollection()->transform(function ($project) {
            $project->interests_count = ProjectInterest::where('project_name', $project->name)->count();
            $project->questions_count = ProjectQuestion::where('project_name', $project->name)->count();
            return $project;
        });

        // Get recent interests and questions
        $recentInterests = ProjectInterest::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $recentQuestions = ProjectQuestion::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return Inertia::render('Admin/Projects', [
            'projects' => $projects,
            'recentInterests' => $recentInterests,
            'recentQuestions' => $recentQuestions,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/CreateProject');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'project_type' => 'required|in:SOLAR,BESS,SOLAR_BESS,OTHER',
            'capacity_mw' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
        ]);

        $project = Project::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'project_type' => $request->project_type,
            'capacity_mw' => $request->capacity_mw,
            'location' => $request->location,
            'current_step' => 1,
            'qr_expires_at' => now()->addHours(48),
        ]);

        return redirect()->route('admin.projects.show', $project->id)
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load('clientCompany');
        
        // Generate QR URL
        $qrUrl = null;
        if (!$project->isQrExpired()) {
            $qrUrl = URL::temporarySignedRoute(
                'onboarding.step-one',
                $project->qr_expires_at,
                ['uuid' => $project->uuid]
            );
        }

        // Get interests and questions for this project
        $interests = ProjectInterest::where('project_name', $project->name)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $questions = ProjectQuestion::where('project_name', $project->name)
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Admin/ProjectDetail', [
            'project' => $project,
            'qr_url' => $qrUrl,
            'interests' => $interests,
            'questions' => $questions,
            'step_names' => [
                1 => 'NDA Signing',
                2 => 'Inception Meeting',
                3 => 'RFQ & Documentation',
                4 => 'Proposal Development',
                5 => 'Contract Negotiation',
                6 => 'Project Execution',
                7 => 'Project Completion'
            ]
        ]);
    }

    public function generateQr(Project $project, Request $request)
    {
        $request->validate([
            'hours' => 'required|integer|min:1|max:168' // Max 1 week
        ]);

        $expiresAt = now()->addHours($request->hours);
        $project->update(['qr_expires_at' => $expiresAt]);

        $qrUrl = URL::temporarySignedRoute(
            'onboarding.step-one',
            $expiresAt,
            ['uuid' => $project->uuid]
        );

        return back()->with('success', 'QR code generated successfully.')
            ->with('qr_url', $qrUrl);
    }

    public function resetStep(Project $project, Request $request)
    {
        $request->validate([
            'step' => 'required|integer|min:1|max:7'
        ]);

        $project->update(['current_step' => $request->step]);

        return back()->with('success', 'Project step reset successfully.');
    }

    public function scheduleInception(Project $project, Request $request)
    {
        $data = $request->validate([
            'inception_meeting_mode' => 'nullable|in:online,physical',
            'inception_meeting_scheduled_at' => 'nullable|date',
            'inception_meeting_location' => 'nullable|string|max:255',
            'inception_meeting_link' => 'nullable|string|max:255',
            'inception_meeting_notes' => 'nullable|string|max:2000',
        ]);

        $project->update($data);

        return back()->with('success', 'Inception meeting schedule updated successfully.');
    }

    public function interests()
    {
        $interests = ProjectInterest::orderBy('created_at', 'desc')
            ->paginate(20);

        return Inertia::render('Admin/ProjectInterests', [
            'interests' => $interests
        ]);
    }

    public function questions()
    {
        $questions = ProjectQuestion::orderBy('created_at', 'desc')
            ->paginate(20);

        return Inertia::render('Admin/ProjectQuestions', [
            'questions' => $questions
        ]);
    }

    public function respondToQuestion(ProjectQuestion $question, Request $request)
    {
        $request->validate([
            'response' => 'required|string|max:2000'
        ]);

        $question->update([
            'admin_response' => $request->response,
            'responded_at' => now(),
        ]);

        return back()->with('success', 'Response submitted successfully.');
    }
}