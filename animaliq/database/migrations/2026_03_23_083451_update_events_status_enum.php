<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Relax to VARCHAR so we can freely update values
        DB::statement("ALTER TABLE events MODIFY COLUMN status VARCHAR(20) NOT NULL DEFAULT 'active'");

        // Step 2: Migrate old values
        DB::statement("UPDATE events SET status = 'archived' WHERE status IN ('completed', 'cancelled')");
        DB::statement("UPDATE events SET status = 'active' WHERE status NOT IN ('active', 'archived')");

        // Step 3: Apply the new ENUM
        DB::statement("ALTER TABLE events MODIFY COLUMN status ENUM('active','archived') NOT NULL DEFAULT 'active'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE events MODIFY COLUMN status VARCHAR(20) NOT NULL DEFAULT 'upcoming'");
        DB::statement("UPDATE events SET status = 'upcoming' WHERE status = 'active'");
        DB::statement("UPDATE events SET status = 'completed' WHERE status = 'archived'");
        DB::statement("ALTER TABLE events MODIFY COLUMN status ENUM('upcoming','completed','cancelled') NOT NULL DEFAULT 'upcoming'");
    }
};
