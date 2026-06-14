<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,     // needs users
            ProgramSeeder::class,        // needs departments
            EventSeeder::class,          // needs programs
            ResearchSeeder::class,       // needs departments
            CampaignPostSeeder::class,   // needs users
            AwarenessDaySeeder::class,
            HomepageSlideSeeder::class,
            TeamMemberSeeder::class,
            DonationProductSeeder::class,
            PodcastSeeder::class,
        ]);
    }
}
