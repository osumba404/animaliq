<?php

return [
    'homepage' => [
        'title' => 'Homepage',
        'keys' => [
            'homepage_hero_title'    => ['label' => 'Hero title', 'type' => 'text'],
            'homepage_hero_subtitle' => ['label' => 'Hero subtitle', 'type' => 'text'],
            'homepage_mission_teaser'=> ['label' => 'Mission teaser', 'type' => 'text'],
        ],
    ],
    'mission' => [
        'title' => 'Mission & Vision',
        'keys' => [
            'site_logo'         => ['label' => 'Site logo (Navbar & Favicon)', 'type' => 'image'],
            'mission_statement' => ['label' => 'Mission statement', 'type' => 'text'],
            'mission_image'     => ['label' => 'Mission image (optional)', 'type' => 'image'],
            'vision_statement'  => ['label' => 'Vision statement', 'type' => 'text'],
            'vision_image'      => ['label' => 'Vision image (optional)', 'type' => 'image'],
        ],
    ],
    'about' => [
        'title' => 'About',
        'keys' => [
            'about_founder_story' => ['label' => 'Founder story', 'type' => 'text'],
            'about_founder_image' => ['label' => 'Founder / story image (shown right of text on desktop)', 'type' => 'image'],
            'core_values'         => ['label' => 'Core values (one per line)', 'type' => 'text'],
            'strategic_plan_file' => ['label' => 'Strategic plan file (PDF/doc)', 'type' => 'file'],
        ],
    ],
    'research' => [
        'title' => 'Research Section',
        'keys' => [
            'research_section_banner' => ['label' => 'Research section banner image', 'type' => 'image'],
        ],
    ],
    'donations' => [
        'title' => 'Donations & Payments',
        'keys' => [
            'mpesa_till_number' => ['label' => 'M-Pesa Till Number', 'type' => 'text'],
            'mpesa_till_name'   => ['label' => 'M-Pesa Till Name (returned by Safaricom)', 'type' => 'text'],
        ],
    ],
    'socials' => [
        'title' => 'Social Media Platforms',
        'keys' => [
            'social_x'        => ['label' => 'X (Twitter) URL', 'type' => 'text'],
            'social_instagram' => ['label' => 'Instagram URL', 'type' => 'text'],
            'social_facebook'  => ['label' => 'Facebook URL', 'type' => 'text'],
            'social_linkedin'  => ['label' => 'LinkedIn URL', 'type' => 'text'],
            'social_whatsapp'  => ['label' => 'WhatsApp Channel URL', 'type' => 'text'],
            'social_reddit'    => ['label' => 'Reddit URL', 'type' => 'text'],
            'social_tiktok'    => ['label' => 'TikTok URL', 'type' => 'text'],
            'social_youtube'   => ['label' => 'YouTube URL', 'type' => 'text'],
            'social_telegram'  => ['label' => 'Telegram URL', 'type' => 'text'],
        ],
    ],
    'contacts' => [
        'title' => 'Contact Us',
        'keys' => [
            'contact_primary'   => ['label' => 'Primary Phone', 'type' => 'text'],
            'contact_secondary' => ['label' => 'Secondary Phone', 'type' => 'text'],
            'contact_whatsapp'  => ['label' => 'WhatsApp Number', 'type' => 'text'],
            'contact_email1'    => ['label' => 'Email 1', 'type' => 'text'],
            'contact_email2'    => ['label' => 'Email 2', 'type' => 'text'],
        ],
    ],
];
