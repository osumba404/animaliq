<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            ['setting_key' => 'mission_statement',   'setting_value' => "To educate and empower people to protect flora and\nfauna by fostering awareness, conservation, and deeper\nconnection with nature", 'type' => 'text'],
            ['setting_key' => 'mission_image',        'setting_value' => '', 'type' => 'image'],
            ['setting_key' => 'vision_statement',     'setting_value' => "A world where every person values animals, protects\ntheir habitats, and champions a future of\nconservation and coexistence.", 'type' => 'text'],
            ['setting_key' => 'vision_image',         'setting_value' => '', 'type' => 'image'],
            ['setting_key' => 'about_founder_story',  'setting_value' => "Animal IQ is a youth-led conservation initiative founded in October 2024 by Tabitha Wanjira Waigwa, inspired by her upbringing near Lake Nakuru National Park. It is a movement born from passion and purpose, created to bridge the gap between people and wildlife.\nWe exist to create awareness, inspire appreciation, and encourage action toward protecting animals, their habitats, and the environment. We believe that once people understand how animals live, hunt, and survive, they begin to respect them.", 'type' => 'text'],
            ['setting_key' => 'about_founder_image',  'setting_value' => '', 'type' => 'image'],
            ['setting_key' => 'core_values',          'setting_value' => json_encode(['Education & Awareness', 'Youth Empowerment', 'Respect for all Life', 'Community Engagement']), 'type' => 'text'],
            ['setting_key' => 'homepage_hero_title',  'setting_value' => 'Welcome to Animal IQ', 'type' => 'text'],
            ['setting_key' => 'homepage_hero_subtitle','setting_value' => 'Learn. Protect. Conserve.', 'type' => 'text'],
            ['setting_key' => 'homepage_mission_teaser','setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'strategic_plan_file',  'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'research_section_banner','setting_value' => '', 'type' => 'image'],
            ['setting_key' => 'site_logo',            'setting_value' => '', 'type' => 'image'],
            ['setting_key' => 'contact_email1',       'setting_value' => 'info@animaliq.co.ke', 'type' => 'text'],
            ['setting_key' => 'contact_email2',       'setting_value' => 'animaliqinitiative@gmail.com', 'type' => 'text'],
            ['setting_key' => 'contact_primary',      'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'contact_secondary',    'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'contact_whatsapp',     'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'social_x',             'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'social_instagram',     'setting_value' => 'https://www.instagram.com/animal_lq?igsh=eDNodzE5NWM3aGdx', 'type' => 'text'],
            ['setting_key' => 'social_facebook',      'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'social_linkedin',      'setting_value' => 'https://www.linkedin.com/in/animal-iq-a15942375?originalSubdomain=ke', 'type' => 'text'],
            ['setting_key' => 'social_whatsapp',      'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'social_reddit',        'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'social_tiktok',        'setting_value' => 'https://www.tiktok.com/@_animal_iq_', 'type' => 'text'],
            ['setting_key' => 'social_youtube',       'setting_value' => 'https://www.youtube.com/@AnimalIQ-q8c', 'type' => 'text'],
            ['setting_key' => 'social_telegram',      'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'mpesa_till_number',    'setting_value' => '', 'type' => 'text'],
            ['setting_key' => 'mpesa_till_name',      'setting_value' => '', 'type' => 'text'],
        ];

        foreach ($defaults as $row) {
            SiteSetting::firstOrCreate(
                ['setting_key' => $row['setting_key']],
                ['setting_value' => $row['setting_value'], 'type' => $row['type']]
            );
        }
    }
}
