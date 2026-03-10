<?php

namespace App\Http\Controllers;

use App\Models\ResearchProject;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index(Request $request)
    {
        $query = ResearchProject::with('department', 'reports');

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('summary', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->query('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('start_date');
        } else {
            $query->orderByDesc('start_date');
        }

        $projects = $query->paginate(12)->withQueryString();
        $sectionBanner = SiteSetting::getByKey('research_section_banner', '');

        return view('public.research.index', compact('projects', 'sectionBanner'));
    }

    public function show(ResearchProject $researchProject)
    {
        $researchProject->load('department', 'reports');

        return view('public.research.show', compact('researchProject'));
    }
}
