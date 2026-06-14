<?php

namespace Database\Seeders;

use App\Models\DonationCampaign;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DonationProductSeeder extends Seeder
{
    public function run(): void
    {
        $campaigns = [
            [
                'title'       => 'Wildlife Conservation Fund',
                'description' => 'Support our core wildlife conservation programs — from field experiences in national parks to community education initiatives. Every contribution directly funds events, research, and outreach activities.',
                'target_amount' => 500000.00,
                'start_date'  => '2026-01-01',
                'end_date'    => '2026-12-31',
            ],
            [
                'title'       => 'WildFest 2026 – Annual Conservation Festival',
                'description' => 'Help us host the second annual Animal IQ WildFest — a vibrant celebration of wildlife, creativity, and conservation that brings together youth, experts, and community members for a full day of learning and action.',
                'target_amount' => 150000.00,
                'start_date'  => '2026-07-01',
                'end_date'    => '2026-10-31',
            ],
            [
                'title'       => 'Research & Documentation Fund',
                'description' => 'Fund our research into youth conservation literacy, human-wildlife conflict, and urban herpetofauna. Your support enables data collection, field surveys, and the publication of research findings.',
                'target_amount' => 200000.00,
                'start_date'  => '2026-01-01',
                'end_date'    => '2026-12-31',
            ],
            [
                'title'       => 'Campus Outreach Program',
                'description' => 'Help Animal IQ reach more universities and schools across Kenya with conservation talks, guest lectures, and green week programs. Empowering the next generation of environmental leaders.',
                'target_amount' => 80000.00,
                'start_date'  => '2026-03-01',
                'end_date'    => '2026-11-30',
            ],
        ];

        foreach ($campaigns as $data) {
            DonationCampaign::firstOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        $products = [
            [
                'name'        => 'Animal IQ T-Shirt',
                'slug'        => 'animal-iq-t-shirt',
                'description' => 'Show your support for wildlife conservation with the official Animal IQ T-Shirt. Made from 100% cotton, featuring the Animal IQ logo on the front and a conservation message on the back. Available in S, M, L, XL.',
                'price'       => 1500.00,
                'stock'       => 50,
                'status'      => 'active',
            ],
            [
                'name'        => 'Animal IQ Tote Bag',
                'slug'        => 'animal-iq-tote-bag',
                'description' => 'A sturdy, eco-friendly tote bag featuring Animal IQ wildlife artwork. Perfect for shopping, school, or the field. Each purchase supports our conservation programs.',
                'price'       => 800.00,
                'stock'       => 30,
                'status'      => 'active',
            ],
            [
                'name'        => 'Wildlife Field Guide – Kenya',
                'slug'        => 'wildlife-field-guide-kenya',
                'description' => 'A beautifully illustrated pocket guide to Kenya\'s most iconic wildlife species. Includes identification tips, habitat information, and conservation status for over 80 species. Perfect for field trips and nature walks.',
                'price'       => 1200.00,
                'stock'       => 25,
                'status'      => 'active',
            ],
            [
                'name'        => 'Animal IQ Cap',
                'slug'        => 'animal-iq-cap',
                'description' => 'A comfortable, adjustable cap embroidered with the Animal IQ logo. Great for outdoor field activities and everyday wear. Keeps you covered while showing your conservation pride.',
                'price'       => 1000.00,
                'stock'       => 40,
                'status'      => 'active',
            ],
            [
                'name'        => 'Conservation Sticker Pack',
                'slug'        => 'conservation-sticker-pack',
                'description' => 'A set of 10 high-quality vinyl stickers featuring Animal IQ wildlife illustrations — cheetahs, elephants, snakes, coral reefs, and more. Waterproof and durable. Perfect for laptops, water bottles, and notebooks.',
                'price'       => 300.00,
                'stock'       => 100,
                'status'      => 'active',
            ],
            [
                'name'        => 'Animal IQ Hoodie',
                'slug'        => 'animal-iq-hoodie',
                'description' => 'A warm, premium hoodie featuring the Animal IQ logo. Ideal for early morning field trips, game drives, and cool evenings. A portion of proceeds goes directly to conservation programs.',
                'price'       => 2500.00,
                'stock'       => 20,
                'status'      => 'active',
            ],
        ];

        foreach ($products as $data) {
            Product::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
