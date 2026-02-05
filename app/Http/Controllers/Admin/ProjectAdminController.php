<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
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

        return Inertia::render('Admin/Projects', [
            'projects' => $projects
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

        return Inertia::render('Admin/ProjectDetail', [
            'project' => $project,
            'qr_url' => $qrUrl,
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
}