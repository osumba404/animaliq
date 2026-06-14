<?php

namespace Database\Seeders;

use App\Models\HomepageSlide;
use Illuminate\Database\Seeder;

class HomepageSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title'              => 'Welcome to Animal IQ',
                'subtitle'           => 'Learn. Protect. Conserve.',
                'cta_text'           => 'Who We Are',
                'cta_link'           => '/about',
                'cta_secondary_text' => 'Become a Conservationist',
                'cta_secondary_link' => '/register',
                'display_order'      => 0,
                'status'             => 'active',
            ],
            [
                'title'              => 'Volunteer With Us',
                'subtitle'           => 'Join a team of dedicated conservationists',
                'cta_text'           => 'Sign Up',
                'cta_link'           => '/register',
                'cta_secondary_text' => 'Our Programs',
                'cta_secondary_link' => '/programs',
                'display_order'      => 1,
                'status'             => 'active',
            ],
            [
                'title'              => 'Science-Driven Conservation Solutions',
                'subtitle'           => 'Research, education, and field action for real impact',
                'cta_text'           => 'View Ongoing Research',
                'cta_link'           => '/research',
                'cta_secondary_text' => null,
                'cta_secondary_link' => null,
                'display_order'      => 2,
                'status'             => 'active',
            ],
        ];

        foreach ($slides as $data) {
            HomepageSlide::firstOrCreate(['title' => $data['title']], $data);
        }
    }
}
