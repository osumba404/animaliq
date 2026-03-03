<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class PartnershipsController extends Controller
{
    public function index()
    {
        $partners = SiteSetting::getByKey('partnerships_list', []);
        $mediaKitUrl = SiteSetting::getByKey('media_kit_url', null);
        $proposalTemplateUrl = SiteSetting::getByKey('partnership_proposal_template', null);

        return view('public.partnerships.index', compact('partners', 'mediaKitUrl', 'proposalTemplateUrl'));
    }
}
