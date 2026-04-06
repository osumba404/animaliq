<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SiteSetting;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $founderStory = SiteSetting::getByKey('about_founder_story', '');
        $mission = SiteSetting::getByKey('mission_statement', '');
        $missionImage = SiteSetting::getByKey('mission_image', '');
        $vision = SiteSetting::getByKey('vision_statement', '');
        $visionImage = SiteSetting::getByKey('vision_image', '');
        $missionImageUrl = $missionImage ? asset('storage/' . $missionImage) : null;
        $visionImageUrl  = $visionImage  ? asset('storage/' . $visionImage)  : null;
        $coreValues = SiteSetting::getByKey('core_values', []);
        $departments = Department::with(['departmentMembers' => fn ($q) => $q->with('user')->orderBy('display_order')])->orderBy('name')->get();
        $strategicPlanUrl = SiteSetting::getByKey('strategic_plan_file', null);
        $annualReports = SiteSetting::getByKey('annual_reports', []);
        $teamMembers = TeamMember::orderBy('display_order')->orderBy('name')->get();
        $mediaKitUrl = SiteSetting::getByKey('media_kit_url', null);
        $proposalTemplateUrl = SiteSetting::getByKey('partnership_proposal_template', null);

        return view('public.about', compact(
            'founderStory', 'mission', 'missionImage', 'vision', 'visionImage', 'coreValues',
            'departments', 'strategicPlanUrl', 'annualReports', 'teamMembers', 'mediaKitUrl', 'proposalTemplateUrl',
            'missionImageUrl', 'visionImageUrl'
        ));
    }
}
