<?php

namespace App\Http\Controllers;

use App\Models\DonationCampaign;

class DonationController extends Controller
{
    public function index()
    {
        $campaigns = DonationCampaign::orderByDesc('end_date')->get();
        $impactContent = null; // Can come from SiteSetting

        return view('public.donations.index', compact('campaigns', 'impactContent'));
    }

    public function show(DonationCampaign $donationCampaign)
    {
        return view('public.donations.show', compact('donationCampaign'));
    }
}
