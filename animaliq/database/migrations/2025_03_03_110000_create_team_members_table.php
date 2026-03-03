<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('image', 255)->nullable();
            $table->string('role', 150);
            $table->text('remarks')->nullable();
            $table->text('role_description')->nullable();
            $table->json('socials')->nullable(); // e.g. {"twitter":"","instagram":"","facebook":"","linkedin":""}
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
