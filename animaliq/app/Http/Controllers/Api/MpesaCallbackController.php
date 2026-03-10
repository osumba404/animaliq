<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * M-Pesa Daraja API callbacks – structure only, not implemented yet.
 *
 * Safaricom sends POST requests to these endpoints. They must:
 * - Be publicly reachable (no auth required from Daraja)
 * - Return 200 quickly; process payload asynchronously if needed
 * - Respond with the expected JSON so Daraja does not retry unnecessarily
 *
 * When implemented:
 * - Validate payload (e.g. verify source if needed)
 * - Parse ResultCode, CallbackMetadata (Amount, MpesaReceiptNumber, etc.)
 * - Update Donation or Order with transaction_reference and payment_status
 * - Optionally queue the job for reliability (config daraja.queue_callback)
 */
class MpesaCallbackController extends Controller
{
    /**
     * STK Push result callback (Lipa Na M-Pesa Online).
     * Daraja POSTs here after the user completes or cancels the prompt on their phone.
     *
     * Expected body (example success):
     * {
     *   "Body": {
     *     "stkCallback": {
     *       "MerchantRequestID": "...",
     *       "CheckoutRequestID": "...",
     *       "ResultCode": 0,
     *       "ResultDesc": "The service request is processed successfully.",
     *       "CallbackMetadata": {
     *         "Item": [
     *           {"Name": "Amount", "Value": 100.00},
     *           {"Name": "MpesaReceiptNumber", "Value": "..."},
     *           ...
     *         ]
     *       }
     *     }
     *   }
     * }
     */
    public function stkCallback(Request $request): JsonResponse
    {
        Log::info('MpesaCallbackController::stkCallback received (not implemented)', [
            'payload_keys' => array_keys($request->all()),
        ]);

        // TODO: Implement:
        // 1. Parse $request->input('Body.stkCallback')
        // 2. If ResultCode === 0, extract CallbackMetadata (Amount, MpesaReceiptNumber, etc.)
        // 3. Match MerchantRequestID/CheckoutRequestID to pending Donation or Order (store these IDs when initiating STK)
        // 4. Update record: transaction_reference = MpesaReceiptNumber, payment_status = 'paid', etc.
        // 5. Optionally send receipt email
        // 6. Return 200 with empty or minimal JSON so Daraja does not retry

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Accepted',
        ]);
    }
}
