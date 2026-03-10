<?php

namespace App\Services\Mpesa;

use Illuminate\Support\Facades\Log;

/**
 * Daraja API (M-Pesa) integration – structure only, not implemented yet.
 *
 * When implemented, this service will:
 * - Obtain OAuth access token from Safaricom
 * - Initiate Lipa Na M-Pesa Online (STK Push) for donations and store orders
 * - Rely on MpesaCallbackController to receive and process callbacks
 *
 * @see https://developer.safaricom.co.ke/APIs
 */
class DarajaService
{
    protected string $baseUrl;

    protected ?string $accessToken = null;

    public function __construct()
    {
        $env = config('daraja.environment', 'sandbox');
        $this->baseUrl = config("daraja.base_url.{$env}", config('daraja.base_url.sandbox'));
    }

    /**
     * Get OAuth access token from Daraja (not implemented).
     * When implemented: POST oauth/v1/generate?grant_type=client_credentials with Basic auth.
     */
    public function getAccessToken(): string
    {
        // TODO: Implement: GET/POST oauth/v1/generate?grant_type=client_credentials
        // with Basic auth (consumer_key:consumer_secret), cache token until expiry.
        throw new \RuntimeException('Daraja API is not implemented yet. Configure MPESA_* in .env and implement getAccessToken().');
    }

    /**
     * Initiate STK Push (Lipa Na M-Pesa Online) – not implemented.
     *
     * @param  string  $phone  MSISDN (254XXXXXXXXX)
     * @param  float|string  $amount  Amount to charge
     * @param  string  $reference  Unique reference (e.g. donation campaign id, order id)
     * @param  string  $description  Short description shown to user
     * @return array{success: bool, checkout_request_id?: string, merchant_request_id?: string, message?: string}
     */
    public function initiateStkPush(string $phone, $amount, string $reference, string $description = 'Payment'): array
    {
        // TODO: Implement:
        // 1. getAccessToken()
        // 2. Build callback URL from config('daraja.callback_base_url') . '/' . config('daraja.stk_callback_path')
        // 3. POST /mpesa/stkpush/v1/processrequest with:
        //    BusinessShortCode, Password (base64 encoded timestamp + passkey), Timestamp,
        //    TransactionType (CustomerPayBillOnline or CustomerBuyGoodsOnline), Amount, PartyA, PartyB,
        //    PhoneNumber, CallBackURL, AccountReference, TransactionDesc
        // 4. Return success + CheckoutRequestID / MerchantRequestID for polling or callback matching
        Log::info('DarajaService::initiateStkPush called (not implemented)', [
            'phone' => $phone,
            'amount' => $amount,
            'reference' => $reference,
        ]);

        return [
            'success' => false,
            'message' => 'M-Pesa Daraja integration is not implemented yet.',
        ];
    }

    /**
     * Query STK Push status by CheckoutRequestID (not implemented).
     * When implemented: POST /mpesa/stkpushquery/v1/query with CheckoutRequestID.
     */
    public function queryStkStatus(string $checkoutRequestId): array
    {
        // TODO: Implement STK push query API.
        throw new \RuntimeException('Daraja API is not implemented yet.');
    }

    /**
     * Full URL to which Safaricom will POST the STK Push result.
     */
    public function getStkCallbackUrl(): string
    {
        $base = rtrim(config('daraja.callback_base_url', ''), '/');
        $path = ltrim(config('daraja.stk_callback_path', 'api/mpesa/stk-callback'), '/');

        return $base . '/' . $path;
    }
}
