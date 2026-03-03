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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('location', 255)->nullable();
            $table->dateTime('start_datetime')->nullable();
            $table->dateTime('end_datetime')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('banner_image', 255)->nullable();
            $table->enum('status', ['upcoming', 'completed', 'cancelled'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
