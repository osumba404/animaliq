<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_slides', function (Blueprint $table) {
            $table->string('cta_secondary_text', 100)->nullable()->after('cta_link');
            $table->string('cta_secondary_link', 255)->nullable()->after('cta_secondary_text');
        });
    }

    public function down(): void
    {
        Schema::table('homepage_slides', function (Blueprint $table) {
            $table->dropColumn(['cta_secondary_text', 'cta_secondary_link']);
        });
    }
};
