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
        Schema::create('research_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('research_projects')->cascadeOnDelete();
            $table->string('title', 255)->nullable();
            $table->string('file_path', 255)->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_reports');
    }
};
