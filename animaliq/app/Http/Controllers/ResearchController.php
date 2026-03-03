<?php

namespace App\Http\Controllers;

use App\Models\ResearchProject;
use App\Models\SiteSetting;

class ResearchController extends Controller
{
    public function index()
    {
        $projects = ResearchProject::with('department', 'reports')
            ->orderByDesc('start_date')
            ->get();
        $sectionBanner = SiteSetting::getByKey('research_section_banner', '');

        return view('public.research.index', compact('projects', 'sectionBanner'));
    }

    public function show(ResearchProject $researchProject)
    {
        $researchProject->load('department', 'reports');

        return view('public.research.show', compact('researchProject'));
    }
}
