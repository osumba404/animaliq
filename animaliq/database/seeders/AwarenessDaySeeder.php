<?php

namespace Database\Seeders;

use App\Models\AwarenessDay;
use Illuminate\Database\Seeder;

class AwarenessDaySeeder extends Seeder
{
    public function run(): void
    {
        $days = [
            ['title' => 'World Aquatic Animal Day',              'celebration_date' => '2026-04-03', 'active' => true],
            ['title' => 'World Stray Animals Day',               'celebration_date' => '2026-04-04', 'active' => true],
            ['title' => 'World Civet Day',                       'celebration_date' => '2026-04-04', 'active' => true],
            ['title' => 'International Beaver Day',              'celebration_date' => '2026-04-07', 'active' => true],
            ['title' => 'Bat Appreciation Day',                  'celebration_date' => '2026-04-17', 'active' => true],
            ['title' => 'World Earth Day',                       'celebration_date' => '2026-04-22', 'active' => true],
            ['title' => 'International Pallas Cat Day',          'celebration_date' => '2026-04-23', 'active' => true, 'body' => "Today we are celebrating Pallas Cats.\n\nFun fact: Unlike domestic cats, Pallas Cats don't meow. When they need to communicate, they'll honk, growl and chirp at each other. When they are excited or scared, they make a sound like a yelp of small dog than any typical cat sound."],
            ['title' => 'World Penguin Day',                     'celebration_date' => '2026-04-25', 'active' => true],
            ['title' => 'International Hyena Day',               'celebration_date' => '2026-04-27', 'active' => true],
            ['title' => 'World Tuna Day',                        'celebration_date' => '2026-05-02', 'active' => true],
            ['title' => 'International Leopard Day',             'celebration_date' => '2026-05-03', 'active' => true],
            ['title' => 'Wild Koala Day',                        'celebration_date' => '2026-05-03', 'active' => true],
            ['title' => 'World Donkey Day',                      'celebration_date' => '2026-05-08', 'active' => true],
            ['title' => 'Endangered Species Day',                'celebration_date' => '2026-05-15', 'active' => true],
            [
                'title'            => 'World Bee Day',
                'celebration_date' => '2026-05-20',
                'active'           => true,
                'body'             => "Today, we are celebrating some of the hardest-working heroes on the planet for World Bee Day! While they might seem small, bees carry a massive responsibility on their tiny shoulders — sustaining our ecosystems, driving biodiversity, and safeguarding global food security. In fact, one out of every three spoonfuls of food we enjoy depends entirely on pollinators.\n\nCreating a buzz for conservation doesn't require a backyard hive. We can all make a tangible difference right where we are by planting native, nectar-rich flowers, eliminating harmful pesticides, and advocating for healthy local habitats. When we look out for the bees, we are looking out for the future of our entire planet.",
            ],
            [
                'title'            => 'International Day for Biological Diversity',
                'celebration_date' => '2026-05-22',
                'active'           => true,
                'body'             => 'From the smallest insect to the largest mammal, every living organism forms a vital strand in the complex web of life that sustains our planet. This International Day for Biological Diversity, we recognize that halting ecosystem loss requires immediate, grass-roots action right in our own neighborhoods.',
            ],
            [
                'title'            => 'World Turtle Day',
                'celebration_date' => '2026-05-23',
                'active'           => true,
                'body'             => "Turtles and tortoises are among the planet's ultimate survivors, having roamed the Earth for over 220 million years and outlasting the dinosaurs. As vital ecosystem engineers, they play an irreplaceable role in maintaining the health of our lands and waterways.\n\nProtecting these ancient guardians requires immediate, everyday action — consciously reducing plastic waste, driving mindfully near wetland areas, and keeping a watchful eye out for nesting sites.",
            ],
            ['title' => 'World Otter Day',                       'celebration_date' => '2026-05-25', 'active' => true],
            ['title' => 'World Parrot Day',                      'celebration_date' => '2026-05-31', 'active' => true],
            ['title' => 'World Environment Day',                 'celebration_date' => '2026-06-05', 'active' => true],
            ['title' => 'World Oceans Day',                      'celebration_date' => '2026-06-08', 'active' => true],
            ['title' => 'International Lynx Day',                'celebration_date' => '2026-06-11', 'active' => true],
            ['title' => 'World Sea Turtle Day',                  'celebration_date' => '2026-06-16', 'active' => true],
            ['title' => 'World Croc Day',                        'celebration_date' => '2026-06-17', 'active' => true],
            ['title' => 'World Giraffe Day',                     'celebration_date' => '2026-06-21', 'active' => true],
            ['title' => 'World Camel Day',                       'celebration_date' => '2026-06-22', 'active' => true],
            ['title' => 'World Snake Day',                       'celebration_date' => '2026-07-16', 'active' => true, 'body' => 'World Snake Day is celebrated every year on July 16 to raise awareness about the thousands of snake species around the world — and to reduce the fear and persecution that leads to unnecessary killings. Snakes are vital components of healthy ecosystems, controlling rodent populations and contributing to biodiversity.'],
            ['title' => 'World Lion Day',                        'celebration_date' => '2026-08-10', 'active' => true],
            ['title' => 'World Elephant Day',                    'celebration_date' => '2026-08-12', 'active' => true],
            ['title' => 'World Orangutan Day',                   'celebration_date' => '2026-08-19', 'active' => true],
            ['title' => 'World Rhino Day',                       'celebration_date' => '2026-09-22', 'active' => true],
            ['title' => 'World Animal Day',                      'celebration_date' => '2026-10-04', 'active' => true],
            ['title' => 'World Migratory Bird Day',              'celebration_date' => '2026-10-10', 'active' => true],
        ];

        foreach ($days as $data) {
            AwarenessDay::firstOrCreate(
                ['title' => $data['title'], 'celebration_date' => $data['celebration_date']],
                [
                    'body'   => $data['body'] ?? null,
                    'active' => $data['active'],
                ]
            );
        }
    }
}
