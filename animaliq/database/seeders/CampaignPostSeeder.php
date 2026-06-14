<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CampaignPostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('role', 'super_admin')->first();
        if (!$author) return;

        $campaigns = [
            [
                'title'       => 'World Snake Day',
                'slug'        => 'world-snake-day',
                'description' => 'World Snake Day is celebrated on July 16 every year to raise awareness about the thousands of snake species around the world. Animal IQ uses this day to educate communities, reduce fear, and promote coexistence with one of nature\'s most misunderstood creatures.',
                'start_date'  => '2026-07-16',
                'end_date'    => '2026-07-16',
            ],
            [
                'title'       => 'Protect Our Pollinators',
                'slug'        => 'protect-our-pollinators',
                'description' => 'Bees, butterflies, and other pollinators are essential to food security and biodiversity. This campaign advocates for pesticide-free environments, native planting, and public awareness about the global pollinator crisis.',
                'start_date'  => '2026-05-01',
                'end_date'    => '2026-05-31',
            ],
            [
                'title'       => 'Ocean Conservation Month',
                'slug'        => 'ocean-conservation-month',
                'description' => 'Every June, Animal IQ runs the Ocean Conservation Month campaign — a series of events, posts, and discussions focused on marine biodiversity, coral reefs, ocean pollution, and the importance of sustainable fishing practices.',
                'start_date'  => '2026-06-01',
                'end_date'    => '2026-06-30',
            ],
            [
                'title'       => 'Wildlife Week Kenya',
                'slug'        => 'wildlife-week-kenya',
                'description' => 'Wildlife Week Kenya is Animal IQ\'s flagship annual awareness campaign, coinciding with World Wildlife Day on March 3. A week of field events, webinars, and community engagement to celebrate and protect Kenya\'s incredible biodiversity.',
                'start_date'  => '2026-03-01',
                'end_date'    => '2026-03-07',
            ],
        ];

        $campaignModels = [];
        foreach ($campaigns as $data) {
            $campaignModels[$data['slug']] = Campaign::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $posts = [
            [
                'campaign_slug' => 'world-snake-day',
                'title'         => 'Fastest Land Predator',
                'slug'          => 'fastest-land-predator',
                'content'       => "The Astonishing Cheetah - Nature's Sprinting Marvel\n\nPrepare to be amazed by the incredible cheetah, an animal that epitomizes speed, grace, and raw power. As the world's fastest land animal, the cheetah can accelerate from 0 to 112 km/h in just three seconds — faster than most sports cars.\n\nUnlike other big cats, cheetahs are built purely for speed. Their lightweight frame, semi-retractable claws that grip the ground like cleats, and an oversized heart and lungs that pump oxygen at incredible rates all contribute to their extraordinary athleticism.\n\nBut speed comes with a cost. Cheetahs can only maintain top speed for 20-30 seconds before overheating. After a chase, they need 15-30 minutes to recover before eating — during which time larger predators like lions and hyenas often steal their hard-earned meal.\n\nToday, fewer than 7,000 cheetahs remain in the wild, making them the most endangered big cat in Africa. Habitat loss, human-wildlife conflict, and the illegal pet trade are pushing this incredible species toward extinction. Conservation efforts across Kenya and beyond are critical to ensuring the cheetah continues to race across our savannahs.",
                'status'        => 'published',
                'published_at'  => '2026-03-31 03:25:59',
            ],
            [
                'campaign_slug' => 'protect-our-pollinators',
                'title'         => 'World Bee Day: Why Every Bee Counts',
                'slug'          => 'world-bee-day-why-every-bee-counts',
                'content'       => "Today, we are celebrating some of the hardest-working heroes on the planet for World Bee Day! While they might seem small, bees carry a massive responsibility on their tiny shoulders — sustaining our ecosystems, driving biodiversity, and safeguarding global food security.\n\nIn fact, one out of every three spoonfuls of food we enjoy depends entirely on pollinators like bees. From the fruits on our tables to the flowers in our gardens, bees silently power the natural world around us.\n\nBut bee populations are declining at an alarming rate. Habitat loss, pesticide use, climate change, and disease are threatening colonies worldwide. When bees disappear, entire food chains collapse.\n\nCreating a buzz for conservation doesn't require a backyard hive. We can all make a tangible difference by planting native, nectar-rich flowers, eliminating harmful pesticides, and advocating for healthy local habitats.\n\nThis World Bee Day, let's commit to keeping our ecosystems thriving, vibrant, and beautifully connected.",
                'status'        => 'published',
                'published_at'  => '2026-05-20 08:00:00',
            ],
            [
                'campaign_slug' => 'ocean-conservation-month',
                'title'         => 'The Hidden World of Coral Reefs',
                'slug'          => 'the-hidden-world-of-coral-reefs',
                'content'       => "Often called the \"rainforests of the sea,\" coral reefs cover less than 1% of the ocean floor yet support approximately 25% of all marine species. These underwater cities of colour and life are among the most biodiverse ecosystems on Earth.\n\nCoral reefs provide food and income for over 500 million people worldwide. They protect coastlines from erosion and storm damage, support fisheries that feed billions, and have even contributed to medical breakthroughs — compounds found in reef organisms have led to treatments for cancer, HIV, and cardiovascular disease.\n\nYet today, coral reefs face an existential threat. Rising ocean temperatures cause coral bleaching — when corals expel the algae living in their tissues, turning white and losing their primary food source. Ocean acidification, pollution, destructive fishing practices, and coastal development compound the damage.\n\nScientists estimate that up to 50% of the world's coral reefs have already been lost, with projections suggesting 90% could disappear by 2050 if current trends continue.\n\nProtecting coral reefs requires urgent collective action — reducing carbon emissions, eliminating single-use plastics, supporting marine protected areas, and choosing sustainable seafood. The ocean's most spectacular ecosystem depends on decisions we make today.",
                'status'        => 'published',
                'published_at'  => '2026-06-08 10:00:00',
            ],
            [
                'campaign_slug' => 'ocean-conservation-month',
                'title'         => 'THIS SMALL ANIMAL TURNS FLOWERS INTO BEDS',
                'slug'          => 'this-small-animal-turns-flowers-into-beds',
                'content'       => "Weighing just a few grams, these animals have adapted to life in tall grasses and wildflower meadows. Using their prehensile tails to anchor themselves to stems, harvest mice build intricate spherical nests woven from grass and leaves — sometimes nestled inside flower heads.\n\nThe harvest mouse (Micromys minutus) is one of the smallest rodents in Europe and Asia, yet it is one of the most charming. These tiny creatures have been photographed curling up inside poppies, roses, and other blooms for what appears to be peaceful afternoon naps.\n\nBut life for the harvest mouse is anything but relaxed. As one of the smallest mammals in their range, they face predation from owls, foxes, weasels, and domestic cats. Their grassland habitats are disappearing rapidly due to agricultural intensification and the loss of hedgerows and wildflower meadows.\n\nProtecting these tiny creatures means protecting the entire grassland ecosystem — the insects, the flowers, the birds that depend on the same habitat. Sometimes conservation starts with paying attention to the smallest members of our natural world.",
                'status'        => 'published',
                'published_at'  => '2026-04-02 16:46:36',
            ],
            [
                'campaign_slug' => 'wildlife-week-kenya',
                'title'         => 'TASMANIA: An Island to Discover, Where Nature Still Reigns',
                'slug'          => 'tasmania-an-island-to-discover-where-nature-still-reigns',
                'content'       => "Located south of mainland Australia, large areas of Tasmania remain wild and sparsely populated. The island's cool temperate climate, dramatic landscapes, and extraordinary biodiversity make it one of the world's last true wilderness frontiers.\n\nTasmania is home to species found nowhere else on Earth. The Tasmanian devil, the eastern quoll, the spotted-tailed quoll, and the pademelon are just a few of the unique marsupials that have evolved in isolation on this island over millions of years.\n\nLarger than Ireland, Tasmania has managed to protect nearly 40% of its land in national parks and reserves — a conservation achievement few regions can match. Its forests are among the tallest and most ancient in the world, with some swamp gums reaching over 90 metres.\n\nYet even Tasmania faces conservation challenges. Introduced species, climate change affecting alpine ecosystems, and the ongoing battle between forestry interests and conservation advocates all threaten what remains.\n\nTasmania stands as both a conservation success story and a reminder of what is possible when communities prioritise the protection of natural heritage over short-term economic gain.",
                'status'        => 'published',
                'published_at'  => '2026-04-07 18:22:12',
            ],
            [
                'campaign_slug' => 'wildlife-week-kenya',
                'title'         => 'WHY THE TASMANIAN DEVIL ISN\'T REALLY A DEVIL',
                'slug'          => 'why-the-tasmanian-devil-isnt-really-a-devil',
                'content'       => "Despite its scary name, the Tasmanian devil is actually a shy scavenger with one of the loudest screams in the animal kingdom — a sound that once terrified early European settlers and earned it its demonic reputation.\n\nThe Tasmanian devil (Sarcophilus harrisii) is the world's largest carnivorous marsupial. About the size of a small dog, it compensates for its modest stature with one of the most powerful bites relative to body size of any mammal. Its jaws can crush bone — an adaptation that allows it to consume every part of a carcass, including the skeleton.\n\nFar from being a menace, Tasmanian devils play a vital ecological role as nature's cleanup crew. By consuming dead animals, they reduce the spread of disease and help maintain ecosystem health.\n\nSadly, the Tasmanian devil faces an extraordinary threat: Devil Facial Tumour Disease (DFTD), a rare contagious cancer spread through biting. Since its discovery in 1996, DFTD has wiped out an estimated 80% of wild devil populations in some areas.\n\nConservation programs including captive breeding, insurance populations on mainland Australia, and vaccine research offer hope. The story of the Tasmanian devil is a powerful reminder that even the creatures we fear or misunderstand deserve our protection.",
                'status'        => 'published',
                'published_at'  => '2026-04-14 08:15:05',
            ],
            [
                'campaign_slug' => 'wildlife-week-kenya',
                'title'         => 'International Biological Diversity: Why Every Species Matters',
                'slug'          => 'international-biological-diversity-why-every-species-matters',
                'content'       => "From the smallest insect to the largest mammal, every living organism forms a vital strand in the complex web of life that sustains our planet. This International Day for Biological Diversity, we recognize that halting ecosystem loss requires immediate, grass-roots action right in our own neighbourhoods.\n\nBiodiversity — the variety of life on Earth — is more than just a collection of species. It is the foundation of ecosystem services that humans depend on: clean air, clean water, food, medicine, climate regulation, and cultural identity.\n\nYet we are living through the planet's sixth mass extinction event, driven entirely by human activity. Habitat destruction, overexploitation, pollution, invasive species, and climate change are pushing thousands of species toward extinction every year — most before they are even discovered.\n\nThe good news? Biodiversity loss is not inevitable. Protected areas, wildlife corridors, sustainable agriculture, rewilding projects, and individual choices all make a difference. Kenya's extraordinary biodiversity — from the Great Rift Valley to its marine ecosystems — is worth fighting for.\n\nOn this International Day for Biological Diversity, Animal IQ calls on everyone to learn about local species, support conservation organisations, and make choices that protect rather than destroy the natural world.",
                'status'        => 'published',
                'published_at'  => '2026-05-22 10:00:00',
            ],
        ];

        foreach ($posts as $data) {
            $campaign = $campaignModels[$data['campaign_slug']] ?? null;
            Post::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'campaign_id'  => $campaign?->id,
                    'author_id'    => $author->id,
                    'title'        => $data['title'],
                    'content'      => $data['content'],
                    'status'       => $data['status'],
                    'published_at' => $data['published_at'],
                ]
            );
        }
    }
}
