<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $fieldOps   = Department::where('slug', 'programs-field-operations')->first()?->id;
        $comms      = Department::where('slug', 'communications-visibility')->first()?->id;
        $research   = Department::where('slug', 'conservation-research-education')->first()?->id;
        $resources  = Department::where('slug', 'resource-development-partnerships')->first()?->id;

        $programs = [
            [
                'title'         => 'Wildlife Experience Program',
                'slug'          => 'wildlife-experience-program',
                'description'   => 'An immersive field program that takes participants to national parks, conservancies, and wildlife sanctuaries across Kenya. Participants engage in guided game drives, nature walks, and birdwatching sessions that build a direct connection with wildlife and ecosystems.',
                'department_id' => $fieldOps,
                'status'        => 'active',
            ],
            [
                'title'         => 'Conservation Awareness & Action',
                'slug'          => 'conservation-awareness-action',
                'description'   => 'Conservation Awareness & Action (CAA) is a community-based program dedicated to the protection of wildlife and the preservation of natural habitats. Members gather for hangouts, interactive discussions, mentorship, and planning of upcoming projects.',
                'department_id' => $research,
                'status'        => 'active',
            ],
            [
                'title'         => 'Wildlife Webinars & Online Discussions',
                'slug'          => 'wildlife-webinars-online-discussions',
                'description'   => 'A series of online learning sessions where experts, researchers, and enthusiasts discuss wildlife topics — from marine ecosystems to apex predators. Each session is interactive, encouraging questions and open dialogue.',
                'department_id' => $comms,
                'status'        => 'active',
            ],
            [
                'title'         => 'Campus & Institutional Outreach',
                'slug'          => 'campus-institutional-outreach',
                'description'   => 'Animal IQ partners with universities, schools, and institutions to deliver conservation talks, guest lectures, and green week participation. The program empowers students and youth to champion environmental sustainability from within their institutions.',
                'department_id' => $research,
                'status'        => 'active',
            ],
            [
                'title'         => 'Reptile & Herpetology Awareness',
                'slug'          => 'reptile-herpetology-awareness',
                'description'   => 'A specialized program focused on reducing fear and misconceptions about reptiles — especially snakes — through hands-on sessions, expert-led training, and visits to reptile parks. Participants learn identification, safe coexistence, and first aid.',
                'department_id' => $fieldOps,
                'status'        => 'active',
            ],
            [
                'title'         => 'Community & Volunteer Engagement',
                'slug'          => 'community-volunteer-engagement',
                'description'   => 'This program builds an active community of conservationists through volunteer activities, social hangouts, and collaborative events. It strengthens teamwork, organizational culture, and the bonds that drive collective environmental action.',
                'department_id' => $resources,
                'status'        => 'active',
            ],
            [
                'title'         => 'Animal IQ Community Engagement',
                'slug'          => 'animal-iq-community-engagement',
                'description'   => 'Members gather for hangouts, interactive discussions, mentorship, and planning of upcoming projects. These sessions also serve as spaces for personal growth, idea sharing, and building a passionate conservation community.',
                'department_id' => $comms,
                'status'        => 'active',
            ],
            [
                'title'         => 'Animal IQ Vegan Week Challenge',
                'slug'          => 'animal-iq-vegan-week-challenge',
                'description'   => 'We invite you to do your best to avoid any food that comes from animals or is an animal. This small challenge can help participants connect with the impact of food choices on animal welfare and the environment.',
                'department_id' => $research,
                'status'        => 'active',
            ],
        ];

        foreach ($programs as $data) {
            Program::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
