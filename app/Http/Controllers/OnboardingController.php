<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OnboardingController extends Controller
{
    public function stepOne(Request $request): Response
    {
        $project = $request->get('project');
        
        return Inertia::render('Onboarding/StepOne', [
            'project' => [
                'uuid' => $project->uuid,
                'name' => $project->name,
                'description' => $project->description,
                'project_type' => $project->project_type,
                'capacity_mw' => $project->capacity_mw,
                'location' => $project->location,
                'current_step' => $project->current_step,
                'nda_signed' => !is_null($project->nda_signed_at),
            ],
            'nda_text' => $this->getNdaText(),
        ]);
    }

    public function submitStepOne(Request $request)
    {
        $request->validate([
            'signature' => 'required|string',
            'uuid' => 'required|string|exists:projects,uuid',
            'full_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'date' => 'required|date',
        ]);

        $project = Project::where('uuid', $request->uuid)->firstOrFail();

        // Ensure they're on step 1
        if ($project->current_step !== 1) {
            return redirect()->route('onboarding.step-one', ['uuid' => $project->uuid]);
        }

        // Save signature and NDA details, then update step
        $project->update([
            'nda_signature' => $request->signature,
            'nda_signed_at' => now(),
            'nda_signer_name' => $request->full_name,
            'nda_signer_company' => $request->company,
            'nda_signer_position' => $request->position,
            'nda_signer_email' => $request->email,
            'nda_signer_phone' => $request->phone,
            'current_step' => 2,
        ]);

        return redirect()->route('onboarding.step-two', ['uuid' => $project->uuid]);
    }

    public function stepTwo(Request $request): Response
    {
        $project = $request->get('project');
        
        return Inertia::render('Onboarding/StepTwo', [
            'project' => [
                'uuid' => $project->uuid,
                'name' => $project->name,
                'description' => $project->description,
                'current_step' => $project->current_step,
                'inception_completed' => !is_null($project->inception_completed_at),
            ],
        ]);
    }

    public function submitStepTwo(Request $request)
    {
        $request->validate([
            'uuid' => 'required|string|exists:projects,uuid'
        ]);

        $project = Project::where('uuid', $request->uuid)->firstOrFail();

        // Ensure they're on step 2
        if ($project->current_step !== 2) {
            return redirect()->route('onboarding.step-two', ['uuid' => $project->uuid]);
        }

        // Mark inception as complete and move to step 3
        $project->update([
            'inception_completed_at' => now(),
            'current_step' => 3,
        ]);

        return redirect()->route('onboarding.step-three', ['uuid' => $project->uuid]);
    }

    public function stepThree(Request $request): Response
    {
        $project = $request->get('project');
        
        return Inertia::render('Onboarding/StepThree', [
            'project' => [
                'uuid' => $project->uuid,
                'name' => $project->name,
                'description' => $project->description,
                'project_type' => $project->project_type,
                'capacity_mw' => $project->capacity_mw,
                'location' => $project->location,
                'current_step' => $project->current_step,
                'rfq_completed' => !is_null($project->rfq_completed_at),
                'rfq_data' => $project->rfq_data ?? [],
            ],
        ]);
    }

    public function submitStepThree(Request $request)
    {
        $request->validate([
            'uuid' => 'required|string|exists:projects,uuid',
            'technical_drawings' => 'nullable|array',
            'technical_drawings.*' => 'file|mimes:pdf,dwg,dxf,jpg,png|max:10240',
            'regulatory_requirements' => 'nullable|string|max:5000',
            'financial_assumptions' => 'nullable|array',
            'project_timeline' => 'nullable|string|max:2000',
            'environmental_considerations' => 'nullable|string|max:3000',
        ]);

        $project = Project::where('uuid', $request->uuid)->firstOrFail();

        // Ensure they're on step 3
        if ($project->current_step !== 3) {
            return redirect()->route('onboarding.step-three', ['uuid' => $project->uuid]);
        }

        // Handle file uploads
        $uploadedFiles = [];
        if ($request->hasFile('technical_drawings')) {
            foreach ($request->file('technical_drawings') as $file) {
                $path = $file->store('projects/' . $project->uuid . '/technical-drawings', 'private');
                $uploadedFiles[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
        }

        // Prepare RFQ data
        $rfqData = [
            'technical_drawings' => $uploadedFiles,
            'regulatory_requirements' => $request->regulatory_requirements,
            'financial_assumptions' => $request->financial_assumptions ?? [],
            'project_timeline' => $request->project_timeline,
            'environmental_considerations' => $request->environmental_considerations,
            'submitted_at' => now()->toISOString(),
        ];

        // Save RFQ data and complete step 3
        $project->update([
            'rfq_data' => $rfqData,
            'rfq_completed_at' => now(),
            'current_step' => 4, // Ready for next phase
        ]);

        return redirect()->route('onboarding.complete', ['uuid' => $project->uuid]);
    }

    public function complete(Request $request): Response
    {
        $uuid = $request->route('uuid');
        $project = Project::where('uuid', $uuid)->firstOrFail();
        
        return Inertia::render('Onboarding/Complete', [
            'project' => [
                'uuid' => $project->uuid,
                'name' => $project->name,
                'current_step' => $project->current_step,
            ],
        ]);
    }

    private function getNdaText(): string
    {
        return "NON-DISCLOSURE AGREEMENT

This Non-Disclosure Agreement (\"Agreement\") is entered into between EAC Green Group Limited (\"EAC\") and the undersigned party (\"Recipient\") for the purpose of protecting confidential information related to renewable energy project development.

1. CONFIDENTIAL INFORMATION
All information disclosed by EAC, including but not limited to:
- Technical specifications and project designs
- Financial projections and business models  
- Site assessments and feasibility studies
- Regulatory compliance strategies
- Proprietary methodologies and processes

2. OBLIGATIONS OF RECIPIENT
The Recipient agrees to:
- Maintain strict confidentiality of all disclosed information
- Use information solely for evaluation purposes
- Not disclose information to third parties without written consent
- Return or destroy all materials upon request

3. TERM
This Agreement remains in effect for a period of five (5) years from the date of execution.

4. GOVERNING LAW
This Agreement shall be governed by the laws of Kenya.

By signing below, the Recipient acknowledges understanding and agreement to these terms.";
    }
}