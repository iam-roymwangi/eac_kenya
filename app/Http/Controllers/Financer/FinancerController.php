<?php

namespace App\Http\Controllers\Financer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Project;

class FinancerController extends Controller
{
    public function index(Request $request)
    {
        // For now, show projects at or past step 9 (announced for financing)
        $projects = Project::where('current_step', '>=', 9)->get();

        return Inertia::render('financer/Projects', [
            'projects' => $projects,
        ]);
    }
}
