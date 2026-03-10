# M-Pesa Daraja API – Implementation Notes

The codebase is **prepared** for Safaricom Daraja API (M-Pesa) but **not implemented yet**. No live API calls are made.

## What’s in place

- **Config** – `config/daraja.php`: environment, base URLs, consumer key/secret, shortcode, passkey, callback URL.
- **.env** – `.env.example` documents `MPESA_*` variables. Copy and fill when you go live.
- **Service** – `App\Services\Mpesa\DarajaService`:
  - `getAccessToken()` – stub (TODO: OAuth with consumer key/secret).
  - `initiateStkPush($phone, $amount, $reference, $description)` – stub; currently logs and returns `success => false`.
  - `queryStkStatus($checkoutRequestId)` – stub.
  - `getStkCallbackUrl()` – returns the URL Safaricom should POST to.
- **Callback** – `App\Http\Controllers\Api\MpesaCallbackController::stkCallback()`:
  - Route: `POST /api/mpesa/stk-callback` (no CSRF; registered in `routes/api.php`).
  - Stub: logs request and returns `{ "ResultCode": 0, "ResultDesc": "Accepted" }`.
  - TODO: parse `Body.stkCallback`, match by `CheckoutRequestID`/`MerchantRequestID`, update Donation/Order and send receipt.
- **Donations** – Donation campaign page has a “Pay with M-Pesa” form (amount + phone). `DonationController::initiatePayment()` creates a pending `Donation`, calls `DarajaService::initiateStkPush()` (stub returns “not implemented”), and redirects back with a message. DB: `donations.checkout_request_id` and `donations.merchant_request_id` for callback matching.
- **Orders** – `orders` table has `checkout_request_id` and `merchant_request_id` for future store checkout. Store product page mentions Daraja; no checkout flow yet.

## When you implement

1. **Credentials** – Get consumer key/secret, shortcode, passkey from [Safaricom Developer Portal](https://developer.safaricom.co.ke) (sandbox then production). Set `MPESA_*` in `.env`.
2. **Callback URL** – Ensure `MPESA_CALLBACK_BASE_URL` is the public base (e.g. `https://yourdomain.com`). Full callback is `{base}/{MPESA_STK_CALLBACK_PATH}` (default `.../api/mpesa/stk-callback`). Must be HTTPS in production.
3. **DarajaService** – Implement `getAccessToken()` (cache until expiry), then `initiateStkPush()`: build password from timestamp + passkey, POST to `/mpesa/stkpush/v1/processrequest`, return `checkout_request_id` and `merchant_request_id` and store them on the Donation/Order.
4. **MpesaCallbackController** – Parse `$request->input('Body.stkCallback')`. If `ResultCode === 0`, get `CallbackMetadata` (Amount, MpesaReceiptNumber, etc.), find Donation/Order by `CheckoutRequestID` or `MerchantRequestID`, set `transaction_reference`, `payment_status`, `donated_at` (for donations). Optionally queue the work and send receipt email.
5. **Store checkout** – Create order, call `initiateStkPush()` with order reference, store request IDs on the order; callback updates order and (e.g.) redirects to a thank-you page or sends email.

## Migrations

Run:

```bash
php artisan migrate
```

Migrations added:

- `add_mpesa_request_ids_to_donations` – `checkout_request_id`, `merchant_request_id`.
- `add_mpesa_request_ids_to_orders` – same for orders.
