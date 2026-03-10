<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationCampaign;
use App\Services\Mpesa\DarajaService;
use Illuminate\Http\Request;

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

    /**
     * Initiate M-Pesa (Daraja) payment for a donation – structure only, not implemented yet.
     * When implemented: creates pending Donation, calls DarajaService::initiateStkPush, stores
     * CheckoutRequestID/MerchantRequestID on the donation for callback matching.
     */
    public function initiatePayment(Request $request, DonationCampaign $donationCampaign)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1|max:999999.99',
            'phone'  => 'required|string|regex:/^254\d{9}$/',
        ], [
            'phone.regex' => 'Enter M-Pesa number in format 254XXXXXXXXX (no + or spaces).',
        ]);

        $donation = Donation::create([
            'user_id'              => auth()->id(),
            'campaign_id'          => $donationCampaign->id,
            'amount'               => $validated['amount'],
            'payment_method'       => 'mpesa',
            'transaction_reference' => null,
            'donated_at'           => null,
        ]);

        $daraja = app(DarajaService::class);
        $result = $daraja->initiateStkPush(
            $validated['phone'],
            (float) $validated['amount'],
            'donation-' . $donation->id,
            'Donation: ' . $donationCampaign->title
        );

        if ($result['success'] ?? false) {
            $donation->update([
                'checkout_request_id'  => $result['checkout_request_id'] ?? null,
                'merchant_request_id'  => $result['merchant_request_id'] ?? null,
            ]);
            return redirect()->back()->with('success', 'Check your phone and enter M-Pesa PIN to complete the donation.');
        }

        return redirect()->back()->with('info', $result['message'] ?? 'M-Pesa is not available yet. Try again later.');
    }
}
