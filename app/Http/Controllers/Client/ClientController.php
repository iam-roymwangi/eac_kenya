<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Project;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $companyId = $user->company_id ?? null;

        $projects = collect();
        if ($companyId) {
            $projects = Project::where('client_company_id', $companyId)->get();
        }

        return Inertia::render('client/Projects', [
            'projects' => $projects,
        ]);
    }
}
