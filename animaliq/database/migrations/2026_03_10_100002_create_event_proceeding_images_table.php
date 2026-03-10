<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_proceeding_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_proceeding_id')->constrained()->cascadeOnDelete();
            $table->string('image_path', 500);
            $table->string('caption', 255)->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_proceeding_images');
    }
};
