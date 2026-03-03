<?php

return [
    'homepage' => [
        'title' => 'Homepage',
        'keys' => [
            'homepage_hero_title' => ['label' => 'Hero title', 'type' => 'text'],
            'homepage_hero_subtitle' => ['label' => 'Hero subtitle', 'type' => 'text'],
            'homepage_mission_teaser' => ['label' => 'Mission teaser', 'type' => 'text'],
        ],
    ],
    'mission' => [
        'title' => 'Mission & Vision',
        'keys' => [
            'mission_statement' => ['label' => 'Mission statement', 'type' => 'text'],
            'vision_statement' => ['label' => 'Vision statement', 'type' => 'text'],
        ],
    ],
    'about' => [
        'title' => 'About',
        'keys' => [
            'about_founder_story' => ['label' => 'Founder story', 'type' => 'text'],
            'core_values' => ['label' => 'Core values (one per line)', 'type' => 'text'],
            'strategic_plan_file' => ['label' => 'Strategic plan file path', 'type' => 'text'],
        ],
    ],
];
