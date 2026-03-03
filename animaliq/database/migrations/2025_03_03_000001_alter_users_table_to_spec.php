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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 100)->after('id');
            $table->string('last_name', 100)->after('first_name');
            $table->string('phone', 20)->nullable()->after('last_name');
            $table->string('profile_photo', 255)->nullable()->after('password');
            $table->text('bio')->nullable()->after('profile_photo');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('bio');
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['first_name', 'last_name', 'phone', 'profile_photo', 'bio', 'status']);
        });
    }
};
