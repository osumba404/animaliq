<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\ResearchProject;
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    public function run(): void
    {
        $research = Department::where('slug', 'conservation-research-education')->first()?->id;
        $tech     = Department::where('slug', 'technology-innovation')->first()?->id;

        $projects = [
            [
                'title'         => 'The Mind of the Future: Mapping Youth Conservation IQ in Nairobi',
                'slug'          => 'the-mind-of-the-future-mapping-youth-conservation-iq-in-nairobi',
                'summary'       => 'At Animal IQ, we believe that the future of wildlife conservation begins with young minds. This research assesses the level of wildlife conservation knowledge, attitudes, and behaviors among urban youth in Nairobi, identifying gaps and opportunities for targeted education.',
                'department_id' => $research,
                'status'        => 'ongoing',
                'start_date'    => '2026-04-01',
            ],
            [
                'title'         => 'Human-Wildlife Conflict in Peri-Urban Nairobi: Patterns and Community Responses',
                'slug'          => 'human-wildlife-conflict-peri-urban-nairobi',
                'summary'       => 'As Nairobi expands, wildlife habitats are increasingly encroached upon, leading to rising human-wildlife conflict. This research documents conflict incidents, community perceptions, and local coping strategies in peri-urban zones adjacent to Nairobi National Park.',
                'department_id' => $research,
                'status'        => 'ongoing',
                'start_date'    => '2026-03-01',
            ],
            [
                'title'         => 'Herpetofauna Diversity and Distribution in Urban Green Spaces of Nairobi',
                'slug'          => 'herpetofauna-diversity-urban-green-spaces-nairobi',
                'summary'       => 'Urban green spaces serve as critical refuges for reptiles and amphibians in cities. This study documents the diversity and distribution of herpetofauna across parks, forests, and riparian corridors within Nairobi.',
                'department_id' => $research,
                'status'        => 'ongoing',
                'start_date'    => '2026-07-01',
            ],
            [
                'title'         => 'Digital Conservation Education: Effectiveness of Social Media in Wildlife Awareness',
                'slug'          => 'digital-conservation-education-social-media-wildlife-awareness',
                'summary'       => 'Social media has become a powerful tool for conservation communication. This research evaluates the reach, engagement, and behavioral impact of Animal IQ\'s digital content on conservation awareness among Kenyan youth.',
                'department_id' => $tech,
                'status'        => 'ongoing',
                'start_date'    => '2026-01-01',
            ],
            [
                'title'         => 'Birdwatching as a Conservation Tool: Building Citizen Science Capacity in Kenya',
                'slug'          => 'birdwatching-conservation-tool-citizen-science-kenya',
                'summary'       => 'Citizen science through birdwatching offers an accessible entry point into conservation. This research assesses the potential of structured birdwatching programs to build conservation capacity and generate meaningful ecological data among youth volunteers.',
                'department_id' => $research,
                'status'        => 'ongoing',
                'start_date'    => '2026-09-01',
            ],
        ];

        foreach ($projects as $data) {
            ResearchProject::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
