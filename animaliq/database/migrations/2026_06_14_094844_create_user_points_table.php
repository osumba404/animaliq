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
        Schema::create('user_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('action');        // blog_view, blog_like, blog_bookmark, blog_comment, blog_comment_like, forum_post, forum_like, forum_bookmark, forum_comment, forum_comment_like, event_register, donation, account_created
            $table->unsignedSmallInteger('points');
            $table->string('source_type')->nullable();  // model class shortname
            $table->unsignedBigInteger('source_id')->nullable(); // source record id
            $table->timestamp('occurred_at');  // when the action actually happened
            $table->timestamps();

            $table->index(['user_id', 'occurred_at']);
            $table->index('occurred_at');
            // Prevent duplicate scoring of the same source record
            $table->unique(['user_id', 'action', 'source_type', 'source_id'], 'user_points_unique_source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_points');
    }
};
