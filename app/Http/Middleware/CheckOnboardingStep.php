<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOnboardingStep
{
    public function handle(Request $request, Closure $next, int $requiredStep): Response
    {
        $uuid = $request->route('uuid');
        
        if (!$uuid) {
            abort(404);
        }

        $project = Project::where('uuid', $uuid)->firstOrFail();

        // Check if QR code has expired for step 1
        if ($requiredStep === 1 && $project->isQrExpired()) {
            abort(403, 'This onboarding link has expired.');
        }

        // Check if user can access this step
        if (!$project->canAccessStep($requiredStep)) {
            // Redirect to the current step they should be on
            $currentStepRoute = $this->getStepRoute($project->current_step, $uuid);
            return redirect()->route($currentStepRoute, ['uuid' => $uuid]);
        }

        // Add project to request for controller use
        $request->merge(['project' => $project]);

        return $next($request);
    }

    private function getStepRoute(int $step, string $uuid): string
    {
        return match($step) {
            1 => 'onboarding.step-one',
            2 => 'onboarding.step-two', 
            3 => 'onboarding.step-three',
            default => 'onboarding.step-one'
        };
    }
}