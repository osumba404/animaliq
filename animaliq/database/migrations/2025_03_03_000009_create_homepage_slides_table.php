<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homepage_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->nullable();
            $table->text('subtitle')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->string('cta_text', 100)->nullable();
            $table->string('cta_link', 255)->nullable();
            $table->integer('display_order')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_slides');
    }
};
