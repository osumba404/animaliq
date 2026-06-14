<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Program;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $wildlife   = Program::where('slug', 'wildlife-experience-program')->first()?->id;
        $webinars   = Program::where('slug', 'wildlife-webinars-online-discussions')->first()?->id;
        $campus     = Program::where('slug', 'campus-institutional-outreach')->first()?->id;
        $reptile    = Program::where('slug', 'reptile-herpetology-awareness')->first()?->id;
        $community  = Program::where('slug', 'community-volunteer-engagement')->first()?->id;

        $events = [
            [
                'program_id'     => $wildlife,
                'title'          => 'Hell\'s Gate Safari Tour',
                'slug'           => 'hells-gate-safari-tour',
                'description'    => 'Animal IQ Initiative conducted an eco-adventure at Hell\'s Gate National Park, where participants cycled alongside free-roaming wildlife — hyenas, zebras, giraffes, and antelopes. Participants explored the gorge, the geothermal power plants, Fischer\'s Tower, and the filming locations of The Lion King.',
                'location'       => 'Hell\'s Gate National Park, Naivasha',
                'start_datetime' => '2025-02-20 07:00:00',
                'end_datetime'   => '2025-02-20 19:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $wildlife,
                'title'          => 'Visit to Snake Park and Nairobi National Museum',
                'slug'           => 'visit-to-snake-park-and-nairobi-national-museum',
                'description'    => 'We visited the Snake Park and Museum and got to learn a lot about snakes. We also explored Kenya\'s history and saw the Nairobi River. The best part was holding snakes and chameleons.',
                'location'       => 'Nairobi Museum',
                'start_datetime' => '2024-03-14 07:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $wildlife,
                'title'          => 'A Visit to Giraffe Center',
                'slug'           => 'a-visit-to-giraffe-center',
                'description'    => 'Our visit to the Giraffe Centre was a great success. Interacting with the giraffes was an incredible experience. We also explored the Giraffe Centre Nature Trail.',
                'location'       => 'Giraffe Center, Karen',
                'start_datetime' => '2025-04-21 07:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $wildlife,
                'title'          => 'Nairobi Animal Orphanage and Safari Walk Visit',
                'slug'           => 'nairobi-animal-orphanage-and-safari-walk-visit',
                'description'    => 'A beautiful day filled with laughter, good vibes, and amazing memories. We explored, goofed around, and truly had a blast together — including an unexpected encounter with a bold baboon.',
                'location'       => 'Nairobi Animal Orphanage',
                'start_datetime' => '2025-06-28 08:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $community,
                'title'          => 'Animal IQ Game Day',
                'slug'           => 'animal-iq-game-day',
                'description'    => 'Animal IQ Initiative successfully hosted the Animal IQ Game Day, a community engagement event designed to bring people together through fun, interactive games while promoting environmental awareness, teamwork, and social connection.',
                'location'       => 'Uhuru Park',
                'start_datetime' => '2025-07-05 12:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => null,
                'title'          => 'Mental Health Event x TLX',
                'slug'           => 'mental-health-event-x-tlx',
                'description'    => 'Animal IQ Initiative, in partnership with TLX, hosted a Mental Wellness and Environmental Connection Program focused on the relationship between mental health, nature, and community wellbeing.',
                'location'       => 'Kahawa Sukari',
                'start_datetime' => '2025-08-31 08:01:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $wildlife,
                'title'          => 'Visit to Oldonyo Sapuk National Park',
                'slug'           => 'visit-to-oldonyo-sapuk-national-park',
                'description'    => 'On the 30th of August, we embarked on an unforgettable journey to Ol Donyo Sabuk National Park. Participants immersed themselves in the park\'s serene environment, observing wildlife, appreciating indigenous vegetation, and completing an intense hike up the park\'s iconic terrain.',
                'location'       => 'Oldonyo Sapuk National Park',
                'start_datetime' => '2025-08-30 08:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'Why Do Orca Target Shark Livers? A Mystery Beneath the Waves',
                'slug'           => 'why-do-orca-target-shark-livers-a-mystery-beneath-the-waves',
                'description'    => 'An online session exploring how Orca selectively hunt sharks with remarkable precision, targeting their livers within minutes. Discussions covered whether such actions are driven by instinct or learned intelligence.',
                'location'       => 'Online Webinar',
                'start_datetime' => '2025-09-13 10:00:00',
                'end_datetime'   => '2025-09-13 11:30:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'The Ocean\'s Lifeline: Why Coral Reefs Matter More than you think',
                'slug'           => 'the-oceans-lifeline-why-coral-reefs-matter-more-than-you-think',
                'description'    => 'An engaging online webinar exploring coral reefs — the "rainforests of the sea." Participants explored the intricate relationships between coral reefs and marine life, the threats they face, and how to support marine conservation.',
                'location'       => 'Online Webinar',
                'start_datetime' => '2025-02-07 10:00:00',
                'end_datetime'   => '2025-02-07 11:30:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $wildlife,
                'title'          => 'Beyond Roses: A Valentine\'s Day in the Heart of Karura Forest',
                'slug'           => 'beyond-roses-a-valentines-day-in-the-heart-of-karura-forest',
                'description'    => 'A refreshing outdoor experience at Karura Forest on Valentine\'s Day. The event blended nature, community, and a unique twist on celebration — walking along scenic trails, engaging in conversations, and appreciating urban green spaces.',
                'location'       => 'Karura Forest',
                'start_datetime' => '2026-02-14 10:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'Secrets of the Deep Ocean: Life Beyond Imagination',
                'slug'           => 'secrets-of-the-deep-ocean-life-beyond-imagination',
                'description'    => 'In celebration of World Wildlife Day, we discussed the deep ocean — exploring bioluminescent organisms, elusive predators, and remarkable adaptations of deep-sea creatures. A powerful reminder that conservation extends to the mysterious depths.',
                'location'       => 'Online Webinar',
                'start_datetime' => '2026-03-03 10:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => null,
                'title'          => 'Snake Sessions II: Where Fear Becomes Fascination',
                'slug'           => 'snake-sessions-ii-where-fear-becomes-fascination',
                'description'    => 'Animal IQ is back with the second installment of Snake Sessions — an up-close, hands-on experience at the Nairobi Snake Park & Museum. Come face-to-face with some of Kenya\'s most fascinating and misunderstood reptiles.',
                'location'       => 'Nairobi Snake Park & Museum',
                'start_datetime' => '2026-04-18 10:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'Animal IQ WildFest 2025',
                'slug'           => 'animal-iq-wildfest-2025',
                'description'    => 'Animal IQ WildFest marked the 1-year anniversary of Animal IQ with a vibrant celebration of wildlife, creativity, and conservation. A standout feature was the cosplay experience, where participants were painted as animals.',
                'location'       => 'Cedar Court, Ubunifu Hub',
                'start_datetime' => '2025-10-10 10:00:00',
                'end_datetime'   => '2025-10-10 17:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $campus,
                'title'          => 'Animal IQ at African Nazarene University – Green Week',
                'slug'           => 'animal-iq-at-african-nazarene-university-green-week',
                'description'    => 'Animal IQ participated as a guest speaker at African Nazarene University during Green Week, contributing to discussions on environmental sustainability, biodiversity conservation, and youth involvement in conservation action.',
                'location'       => 'African Nazarene University',
                'start_datetime' => '2026-03-09 09:00:00',
                'end_datetime'   => '2026-03-15 18:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $campus,
                'title'          => 'Animal IQ x Kenyatta University UNESCO Club – Climate Change & Biodiversity Loss Dialogue',
                'slug'           => 'animal-iq-x-kenyatta-university-unesco-club',
                'description'    => 'Animal IQ partnered with the Kenyatta University UNESCO Club to host an educational dialogue on the relationship between climate change and biodiversity loss.',
                'location'       => 'Kenyatta University',
                'start_datetime' => '2026-01-20 10:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'Feared or Misunderstood? The Hidden Truth About Snakes and Humans',
                'slug'           => 'feared-or-misunderstood-the-hidden-truth-about-snakes-and-humans',
                'description'    => 'An eye-opening online session focused on snakes — challenging long-held fears and revealing the critical role these reptiles play in maintaining healthy ecosystems.',
                'location'       => 'Online Webinar',
                'start_datetime' => '2026-05-07 19:30:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'Beyond Human Senses: How Animals Experience a Hidden World',
                'slug'           => 'beyond-human-senses-how-animals-experience-a-hidden-world',
                'description'    => 'An online webinar exploring extraordinary sensory abilities across the animal kingdom — echolocation, ultraviolet vision, infrared detection, electroreception, and magnetic navigation.',
                'location'       => 'Online Webinar',
                'start_datetime' => '2026-05-13 19:30:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'Sharks: The Ocean\'s Most Misunderstood Predator',
                'slug'           => 'sharks-the-oceans-most-misunderstood-predator',
                'description'    => 'A powerful online discussion challenging misconceptions about sharks — exploring their intelligence, ecological importance, and the threats they face including overfishing and the global fin trade.',
                'location'       => 'Online Webinar',
                'start_datetime' => '2026-05-26 19:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $webinars,
                'title'          => 'The Science of Elephants: Memory, Minds, Behaviour',
                'slug'           => 'the-science-of-elephants-memory-minds-behaviour',
                'description'    => 'All are welcome! We are glad to have a conversation about these incredible, majestic and elegant mammals that traverse our Savannah.',
                'location'       => 'Google Meet',
                'start_datetime' => '2026-06-09 19:00:00',
                'end_datetime'   => '2026-06-09 20:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => $reptile,
                'title'          => 'Snake Awareness & Safety Training with Kenya Herpetofauna Working Group',
                'slug'           => 'snake-awareness-safety-training-kenya-herpetofauna',
                'description'    => 'Animal IQ hosts experts from the Kenya Herpetofauna Working Group (Nature Kenya) for a full-day safety training covering snake identification, emergency response, prevention tips, first aid myths, and hands-on interaction.',
                'location'       => 'Museum Hall, Snake Park',
                'start_datetime' => '2026-06-20 09:00:00',
                'end_datetime'   => '2026-06-30 16:00:00',
                'status'         => 'active',
            ],
            [
                'program_id'     => null,
                'title'          => 'Animal IQ Pizza Hangout',
                'slug'           => 'animal-iq-pizza-hangout',
                'description'    => 'An informal Animal IQ hangout session where members connect over shared meals and relaxed discussions. Participants engage in conversations around conservation and personal experiences while strengthening teamwork.',
                'location'       => 'Garden City Mall',
                'start_datetime' => '2026-04-28 14:00:00',
                'status'         => 'active',
            ],
        ];

        foreach ($events as $data) {
            Event::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
