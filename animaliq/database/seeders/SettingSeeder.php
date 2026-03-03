<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            ['setting_key' => 'site_name', 'setting_value' => config('app.name'), 'type' => 'text'],
            ['setting_key' => 'mission_statement', 'setting_value' => 'To educate and inspire communities in wildlife and environmental conservation.', 'type' => 'text'],
            ['setting_key' => 'mission_image', 'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'vision_statement', 'setting_value' => 'A world where people and wildlife thrive together.', 'type' => 'text'],
            ['setting_key' => 'vision_image', 'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'about_founder_story', 'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'core_values', 'setting_value' => json_encode(['Education', 'Community', 'Conservation', 'Integrity']), 'type' => 'json'],
            ['setting_key' => 'homepage_hero_title', 'setting_value' => 'Welcome to Animal IQ', 'type' => 'text'],
            ['setting_key' => 'homepage_hero_subtitle', 'setting_value' => 'Wildlife & Environmental Education', 'type' => 'text'],
            ['setting_key' => 'homepage_mission_teaser', 'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'strategic_plan_file', 'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'research_section_banner', 'setting_value' => '', 'type' => 'text'],
        ];

        foreach ($defaults as $row) {
            SiteSetting::firstOrCreate(
                ['setting_key' => $row['setting_key']],
                ['setting_value' => $row['setting_value'], 'type' => $row['type']]
            );
        }
    }
}
