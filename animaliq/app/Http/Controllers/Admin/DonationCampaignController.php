<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCampaign;
use Illuminate\Http\Request;

class DonationCampaignController extends Controller
{
    public function index()
    {
        $campaigns = DonationCampaign::withSum('donations', 'amount')->withCount('donations')->orderByDesc('end_date')->paginate(15);
        return view('admin.donations.campaigns', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        DonationCampaign::create($validated);
        return redirect()->route('admin.donations.campaigns')->with('success', 'Campaign created.');
    }

    public function edit(DonationCampaign $donation)
    {
        return view('admin.donations.edit', ['donationCampaign' => $donation]);
    }

    public function update(Request $request, DonationCampaign $donation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $donation->update($validated);
        return redirect()->route('admin.donations.campaigns')->with('success', 'Campaign updated.');
    }

    public function destroy(DonationCampaign $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.campaigns')->with('success', 'Campaign deleted.');
    }
}
