<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
