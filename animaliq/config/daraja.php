<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Daraja API (M-Pesa) Environment
    |--------------------------------------------------------------------------
    | Use 'sandbox' for testing and 'production' for live payments.
    */

    'environment' => env('MPESA_ENV', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | API Base URLs
    |--------------------------------------------------------------------------
    */

    'base_url' => [
        'sandbox'    => 'https://sandbox.safaricom.co.ke',
        'production' => 'https://api.safaricom.co.ke',
    ],

    /*
    |--------------------------------------------------------------------------
    | OAuth / Authentication
    |--------------------------------------------------------------------------
    | Consumer Key and Secret from Safaricom Developer Portal.
    | Used to obtain the access token for API requests.
    */

    'consumer_key'    => env('MPESA_CONSUMER_KEY', ''),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Lipa Na M-Pesa Online (STK Push / M-Pesa Express)
    |--------------------------------------------------------------------------
    | Shortcode: Till number (Buy Goods) or Paybill.
    | Passkey: Generated in the Daraja portal for the shortcode.
    | Used for STK Push to prompt user to enter PIN on phone.
    */

    'shortcode' => env('MPESA_SHORTCODE', ''),
    'passkey'   => env('MPESA_PASSKEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Callback URLs (for Daraja to send results to your server)
    |--------------------------------------------------------------------------
    | Must be HTTPS in production. Publicly reachable URLs.
    | STK callback: Safaricom POSTs STK Push result here.
    | C2B validation/confirmation: For paybill (optional).
    */

    'callback_base_url' => env('MPESA_CALLBACK_BASE_URL', env('APP_URL', 'http://localhost')),

    'stk_callback_path' => env('MPESA_STK_CALLBACK_PATH', 'api/mpesa/stk-callback'),

    /*
    |--------------------------------------------------------------------------
    | Transaction Types & References
    |--------------------------------------------------------------------------
    | Default account reference (e.g. "Donation", "Order") for callback matching.
    */

    'default_account_reference' => env('MPESA_ACCOUNT_REFERENCE', 'AnimalIQ'),

    /*
    |--------------------------------------------------------------------------
    | Timeout & Queue (for future implementation)
    |--------------------------------------------------------------------------
    | API request timeout in seconds. Option to queue callbacks for reliability.
    */

    'timeout' => (int) env('MPESA_TIMEOUT', 30),
    'queue_callback' => env('MPESA_QUEUE_CALLBACK', false),

];
