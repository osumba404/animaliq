<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name'             => 'Tabitha Wanjira Waigwa',
                'role'             => 'Founder & Chairlady',
                'role_description' => 'Tabitha founded Animal IQ in October 2024, inspired by her upbringing near Lake Nakuru National Park. She leads the organisation\'s vision, strategy, and field programs.',
                'remarks'          => 'Passionate about wildlife education and youth empowerment.',
                'display_order'    => 1,
                'socials'          => ['instagram' => 'https://www.instagram.com/animal_lq'],
            ],
            [
                'name'             => 'Eddwin Waigwa',
                'role'             => 'Head of Technology & Innovation',
                'role_description' => 'Eddwin leads Animal IQ\'s digital systems, website development, and technology-driven conservation solutions.',
                'remarks'          => 'Building the digital infrastructure that powers Animal IQ\'s mission.',
                'display_order'    => 2,
                'socials'          => [],
            ],
            [
                'name'             => 'Sarah Johnson',
                'role'             => 'Head of Conservation, Research & Education',
                'role_description' => 'Sarah oversees research projects, educational programs, and field conservation activities.',
                'remarks'          => 'Dedicated to evidence-based conservation and community education.',
                'display_order'    => 3,
                'socials'          => [],
            ],
            [
                'name'             => 'Brian Otieno',
                'role'             => 'Head of Programs & Field Operations',
                'role_description' => 'Brian plans, implements, and manages all on-ground programs, conservation activities, and community-based operations.',
                'remarks'          => 'Turning conservation ideas into real-world action.',
                'display_order'    => 4,
                'socials'          => [],
            ],
            [
                'name'             => 'Mercy Charles',
                'role'             => 'Communications Lead',
                'role_description' => 'Mercy manages Animal IQ\'s communications strategy, ensuring the organisation\'s work is visible and impactful through strategic storytelling.',
                'remarks'          => 'Every story told is a step closer to conservation.',
                'display_order'    => 5,
                'socials'          => [],
            ],
            [
                'name'             => 'Kevin Mwangi',
                'role'             => 'Research & Education Coordinator',
                'role_description' => 'Kevin coordinates research initiatives and educational outreach programs, bridging science and community engagement.',
                'remarks'          => 'Connecting communities with the science of conservation.',
                'display_order'    => 6,
                'socials'          => [],
            ],
            [
                'name'             => 'Olivia Chelanga',
                'role'             => 'Finance & Administration Officer',
                'role_description' => 'Olivia ensures financial integrity, administrative efficiency, and organisational compliance.',
                'remarks'          => 'Keeping Animal IQ operationally strong.',
                'display_order'    => 7,
                'socials'          => [],
            ],
        ];

        foreach ($members as $data) {
            TeamMember::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
