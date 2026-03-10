<?php

use App\Http\Controllers\Api\MpesaCallbackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| M-Pesa Daraja API callbacks (no CSRF; called by Safaricom servers)
|--------------------------------------------------------------------------
*/

Route::post('/mpesa/stk-callback', [MpesaCallbackController::class, 'stkCallback'])
    ->name('mpesa.stk-callback');
