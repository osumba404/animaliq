<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function index()
    {
        $founderStory = SiteSetting::getByKey('about_founder_story', '');
        $mission = SiteSetting::getByKey('mission_statement', '');
        $vision = SiteSetting::getByKey('vision_statement', '');
        $coreValues = SiteSetting::getByKey('core_values', []);
        $departments = Department::with(['departmentMembers' => fn ($q) => $q->with('user')->orderBy('display_order')])->orderBy('name')->get();
        $strategicPlanUrl = SiteSetting::getByKey('strategic_plan_file', null);
        $annualReports = SiteSetting::getByKey('annual_reports', []);

        return view('public.about', compact(
            'founderStory', 'mission', 'vision', 'coreValues',
            'departments', 'strategicPlanUrl', 'annualReports'
        ));
    }
}
