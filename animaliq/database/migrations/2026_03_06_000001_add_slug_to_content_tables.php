<?php

use App\Models\Campaign;
use App\Models\Event;
use App\Models\Post;
use App\Models\Product;
use App\Models\Program;
use App\Models\ResearchProject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('slug', 200)->nullable()->unique()->after('title');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->string('slug', 200)->nullable()->unique()->after('title');
        });
        Schema::table('research_projects', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->unique()->after('title');
        });
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('slug', 200)->nullable()->unique()->after('title');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->unique()->after('title');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug', 200)->nullable()->unique()->after('name');
        });

        $this->backfillSlugs();
    }

    protected function backfillSlugs(): void
    {
        foreach ([Program::class, Event::class, ResearchProject::class, Campaign::class, Post::class, Product::class] as $model) {
            $model::whereNull('slug')->orWhere('slug', '')->chunkById(100, function ($items) {
                foreach ($items as $item) {
                    $item->slug = null;
                    $item->save();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('programs', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('events', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('research_projects', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('campaigns', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('posts', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('products', fn (Blueprint $table) => $table->dropColumn('slug'));
    }
};
