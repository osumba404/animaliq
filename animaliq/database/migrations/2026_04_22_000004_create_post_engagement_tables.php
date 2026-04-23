<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['post_id', 'user_id']);
        });

        Schema::create('post_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['post_id', 'user_id']);
        });

        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('post_comments')->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('post_comment_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_comment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['post_comment_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_comment_likes');
        Schema::dropIfExists('post_comments');
        Schema::dropIfExists('post_bookmarks');
        Schema::dropIfExists('post_likes');
        Schema::dropIfExists('post_views');
    }
};
