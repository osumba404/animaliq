<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Used by Daraja STK Push callback to match incoming result to an order.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('checkout_request_id', 100)->nullable()->after('transaction_reference');
            $table->string('merchant_request_id', 100)->nullable()->after('checkout_request_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['checkout_request_id', 'merchant_request_id']);
        });
    }
};
