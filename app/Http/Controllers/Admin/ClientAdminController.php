<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectInterest;
use Inertia\Inertia;

class ClientAdminController extends Controller
{
    public function index()
    {
        // Build "clients" from project interests so that every company
        // who has expressed interest appears here, grouped by company + email.
        $interests = ProjectInterest::orderBy('created_at', 'desc')->get();

        if ($interests->isEmpty()) {
            return Inertia::render('Admin/Clients', [
                'clients' => [],
            ]);
        }

        // Collect all project names that have interests so we can load projects once
        $projectNames = $interests->pluck('project_name')->filter()->unique()->values();

        $projects = Project::whereIn('name', $projectNames)->get()->keyBy('name');

        // Group interests by a stable client key (company + email)
        $grouped = $interests->groupBy(function (ProjectInterest $interest) {
            return mb_strtolower(trim($interest->company_name ?? '')) . '|' . mb_strtolower(trim($interest->email ?? ''));
        });

        $clients = $grouped->map(function ($group) use ($projects) {
            /** @var \App\Models\ProjectInterest $first */
            $first = $group->first();

            // Unique projects this client has expressed interest in
            $clientProjects = $group->pluck('project_name')
                ->filter()
                ->unique()
                ->map(function ($name) use ($projects) {
                    /** @var \App\Models\Project|null $project */
                    $project = $projects->get($name);
                    if (!$project) {
                        return null;
                    }

                    return [
                        'id' => $project->id,
                        'name' => $project->name,
                        'project_type' => $project->project_type,
                        'location' => $project->location,
                        'current_step' => $project->current_step,
                        'inception_meeting_mode' => $project->inception_meeting_mode,
                        'inception_meeting_scheduled_at' => optional($project->inception_meeting_scheduled_at)?->toIso8601String(),
                        'inception_meeting_location' => $project->inception_meeting_location,
                        'inception_meeting_link' => $project->inception_meeting_link,
                        'inception_meeting_notes' => $project->inception_meeting_notes,
                    ];
                })
                ->filter()
                ->values();

            return [
                'id' => $first->id,
                'name' => $first->company_name,
                'company_type' => null,
                'registration_number' => null,
                'country' => null,
                'projects' => $clientProjects,
            ];
        })->values();

        return Inertia::render('Admin/Clients', [
            'clients' => $clients,
        ]);
    }

    public function show(ProjectInterest $interest)
    {
        // Determine this "client" key
        $company = $interest->company_name;
        $email = $interest->email;

        $interests = ProjectInterest::where('company_name', $company)
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        // Collect related projects
        $projectNames = $interests->pluck('project_name')->filter()->unique()->values();
        $projects = Project::whereIn('name', $projectNames)->get();

        $client = [
            'id' => $interest->id,
            'name' => $company,
            'contact_person' => $interest->contact_person,
            'email' => $email,
            'phone' => $interest->phone,
            'interests_count' => $interests->count(),
            'first_interest_at' => optional($interests->last()?->created_at)?->toIso8601String(),
            'last_interest_at' => optional($interests->first()?->created_at)?->toIso8601String(),
        ];

        $projectPayload = $projects->map(function (Project $project) {
            return [
                'id' => $project->id,
                'uuid' => $project->uuid,
                'name' => $project->name,
                'project_type' => $project->project_type,
                'location' => $project->location,
                'current_step' => $project->current_step,
                'qr_expires_at' => optional($project->qr_expires_at)?->toIso8601String(),
                'inception_meeting_mode' => $project->inception_meeting_mode,
                'inception_meeting_scheduled_at' => optional($project->inception_meeting_scheduled_at)?->toIso8601String(),
                'inception_meeting_location' => $project->inception_meeting_location,
                'inception_meeting_link' => $project->inception_meeting_link,
                'inception_meeting_notes' => $project->inception_meeting_notes,
            ];
        })->values();

        // Generate QR URLs for each project
        $qrUrls = [];
        foreach ($projects as $project) {
            if (!$project->isQrExpired()) {
                $qrUrls[$project->id] = \Illuminate\Support\Facades\URL::temporarySignedRoute(
                    'onboarding.step-one',
                    $project->qr_expires_at,
                    ['uuid' => $project->uuid]
                );
            }
        }

        return Inertia::render('Admin/clients/ClientDetail', [
            'client' => $client,
            'projects' => $projectPayload,
            'interests' => $interests,
            'qr_urls' => $qrUrls,
        ]);
    }
}

