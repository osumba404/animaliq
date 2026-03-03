<?php

namespace App\Http\Controllers;

use App\Models\ResearchProject;

class ResearchController extends Controller
{
    public function index()
    {
        $projects = ResearchProject::with('department', 'reports')
            ->orderByDesc('start_date')
            ->get();

        return view('public.research.index', compact('projects'));
    }

    public function show(ResearchProject $researchProject)
    {
        $researchProject->load('department', 'reports');

        return view('public.research.show', compact('researchProject'));
    }
}
