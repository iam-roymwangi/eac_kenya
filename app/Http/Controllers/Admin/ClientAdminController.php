<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectInterest;
use App\Notifications\CompanyProfileRequestNotification;
use App\Models\Company;
use App\Models\CompanyRepresentative;
use App\Models\User;
use App\Mail\ClientCredentialsMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
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

    public function create()
    {
        return Inertia::render('Admin/clients/RegisterClient');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:50',
        ]);

        $password = Str::password(12);

        // Create the user
        $user = User::create([
            'name' => $request->contact_person,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'client',
        ]);

        // Find or create the company
        $company = Company::firstOrCreate(
            ['name' => $request->company_name],
            ['company_type' => 'CLIENT']
        );

        // Bind the representative
        CompanyRepresentative::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'full_name' => $request->contact_person,
            'title' => $request->title,
            'email' => $request->email,
            'can_sign' => true,
        ]);

        // Dispatch Email
        Mail::to($user->email)->send(new ClientCredentialsMail($user, $password));

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client registered successfully and credentials emailed.');
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
            'is_registered' => \App\Models\User::where('email', $email)->exists(),
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

    public function requestCompanyProfile(Request $request, ProjectInterest $interest)
    {
        $request->validate([
            'email' => 'required|email',
            'contact_person' => 'required|string',
            'company_name' => 'required|string',
        ]);

        // Send notification to the client
        Notification::route('mail', 'rafaelmalakwen@gmail.com')
            ->notify(new CompanyProfileRequestNotification(
                $request->company_name,
                $request->contact_person
            ));

        return back()->with('success', 'Company profile request sent successfully to ' . $request->email);
    }
}
