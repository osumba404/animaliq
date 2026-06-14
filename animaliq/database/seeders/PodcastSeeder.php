<?php

namespace Database\Seeders;

use App\Models\Podcast;
use Illuminate\Database\Seeder;

class PodcastSeeder extends Seeder
{
    public function run(): void
    {
        $podcasts = [
            [
                'title'         => 'Why Do Orcas Hunt Shark Livers? | Animal IQ Conservation Conversations',
                'youtube_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description'   => 'In this episode, we explore the fascinating and mysterious hunting behaviour of orcas — specifically how they surgically remove the livers of sharks. Is it instinct or learned intelligence? Join the conversation.',
                'active'        => true,
                'display_order' => 1,
            ],
            [
                'title'         => 'Coral Reefs: The Rainforests of the Sea | Animal IQ Podcast',
                'youtube_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description'   => 'Coral reefs support 25% of all marine life yet cover less than 1% of the ocean floor. In this episode, we dive deep into why coral reefs matter, the threats they face, and what we can do to protect them.',
                'active'        => true,
                'display_order' => 2,
            ],
            [
                'title'         => 'Snakes: Feared or Misunderstood? | Animal IQ Conservation Conversations',
                'youtube_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description'   => 'We tackle one of nature\'s most misunderstood creatures — snakes. From the science of venom to their critical ecological role, this episode challenges fear with facts and inspires coexistence.',
                'active'        => true,
                'display_order' => 3,
            ],
            [
                'title'         => 'The Deep Ocean: Life Beyond Imagination | Animal IQ Podcast',
                'youtube_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description'   => 'The deep ocean is one of the least explored places on Earth. In this World Wildlife Day special, we explore the extraordinary creatures that thrive in darkness, extreme pressure, and freezing cold.',
                'active'        => true,
                'display_order' => 4,
            ],
            [
                'title'         => 'Beyond Human Senses: How Animals Experience the World | Animal IQ',
                'youtube_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description'   => 'Did you know some animals can see ultraviolet light, sense Earth\'s magnetic field, or hear sounds humans can\'t detect? This episode explores the extraordinary sensory world of wildlife.',
                'active'        => true,
                'display_order' => 5,
            ],
            [
                'title'         => 'Sharks: The Real Story | Animal IQ Conservation Conversations',
                'youtube_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description'   => 'Sharks are among the ocean\'s most misrepresented animals. From Whale Sharks to Goblin Sharks, we explore their diversity, intelligence, ecological importance, and the urgent need for their protection.',
                'active'        => true,
                'display_order' => 6,
            ],
            [
                'title'         => 'The Science of Elephants: Memory, Minds & Behaviour | Animal IQ',
                'youtube_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description'   => 'Elephants are among the most intelligent animals on Earth. In this episode, we explore elephant cognition, social structures, memory, grief, and what their complex inner lives tell us about conservation.',
                'active'        => true,
                'display_order' => 7,
            ],
        ];

        foreach ($podcasts as $data) {
            Podcast::firstOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
