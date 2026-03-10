<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_proceedings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->text('content')->nullable()->comment('Post-event summary / what happened');
            $table->text('learning_points')->nullable()->comment('Key learning areas or takeaways');
            $table->text('activities_description')->nullable()->comment('Activities of the day');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_proceedings');
    }
};
