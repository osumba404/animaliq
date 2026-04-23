<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
        });

        Schema::create('forum_post_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['forum_post_id', 'user_id']);
        });

        Schema::create('forum_post_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['forum_post_id', 'user_id']);
        });

        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('forum_comments')->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('forum_comment_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_comment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['forum_comment_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_comment_likes');
        Schema::dropIfExists('forum_comments');
        Schema::dropIfExists('forum_post_bookmarks');
        Schema::dropIfExists('forum_post_likes');
        Schema::dropIfExists('forum_posts');
    }
};
