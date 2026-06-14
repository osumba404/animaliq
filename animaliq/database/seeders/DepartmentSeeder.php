<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name'           => 'CONSERVATION, RESEARCH & EDUCATION',
                'slug'           => 'conservation-research-education',
                'mandate'        => 'This department integrates wildlife conservation, scientific research, environmental education, and community engagement to drive impact-based conservation.',
                'admin_sections' => ['dashboard', 'programs', 'research', 'posts', 'awareness_days', 'team'],
                'lead_email'     => 'sarah.johnson@animaliq.co.ke',
                'member_emails'  => ['brian.otieno@animaliq.co.ke', 'kevin.mwangi@animaliq.co.ke'],
            ],
            [
                'name'           => 'COMMUNICATIONS & VISIBILITY',
                'slug'           => 'communications-visibility',
                'mandate'        => 'Ensures Animal IQ\'s work is visible, understood, and impactful through strategic communication and storytelling.',
                'admin_sections' => ['dashboard', 'programs', 'events', 'posts', 'podcasts', 'team', 'donations', 'products'],
                'lead_email'     => 'mercy.charles@animaliq.co.ke',
                'member_emails'  => ['mercycharles312@gmail.com', 'luciatiffany517@gmail.com'],
            ],
            [
                'name'           => 'FINANCE & ADMINISTRATION',
                'slug'           => 'finance-administration',
                'mandate'        => 'Ensures financial integrity, administrative efficiency, and organizational compliance.',
                'admin_sections' => ['research', 'posts', 'team', 'donations', 'products'],
                'lead_email'     => null,
                'member_emails'  => ['oliviachelanga@gmail.com'],
            ],
            [
                'name'           => 'PROGRAMS & FIELD OPERATIONS',
                'slug'           => 'programs-field-operations',
                'mandate'        => 'Plans, implements, and manages all on-ground programs, conservation activities, and community-based operations of Animal IQ.',
                'admin_sections' => ['dashboard', 'programs', 'events', 'team'],
                'lead_email'     => 'brian.otieno@animaliq.co.ke',
                'member_emails'  => ['kevin.mwangi@animaliq.co.ke'],
            ],
            [
                'name'           => 'TECHNOLOGY & INNOVATION',
                'slug'           => 'technology-innovation',
                'mandate'        => 'Leads digital systems, innovation, and technology-driven conservation solutions.',
                'admin_sections' => ['dashboard', 'programs', 'events', 'research', 'posts', 'awareness_days', 'podcasts', 'forum', 'settings', 'team', 'donations', 'products'],
                'lead_email'     => 'eddwinwaigwa@gmail.com',
                'member_emails'  => [],
            ],
            [
                'name'           => 'RESOURCE DEVELOPMENT & PARTNERSHIPS',
                'slug'           => 'resource-development-partnerships',
                'mandate'        => 'Mobilizes resources and builds partnerships to sustain and grow Animal IQ.',
                'admin_sections' => ['dashboard', 'events', 'team', 'donations', 'products'],
                'lead_email'     => null,
                'member_emails'  => ['lucia.tiffany@animaliq.co.ke'],
            ],
        ];

        foreach ($departments as $data) {
            $dept = Department::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'name'           => $data['name'],
                    'mandate'        => $data['mandate'],
                    'admin_sections' => $data['admin_sections'],
                ]
            );

            $order = 1;

            if ($data['lead_email']) {
                $lead = User::where('email', $data['lead_email'])->first();
                if ($lead && !$dept->departmentMembers()->where('user_id', $lead->id)->exists()) {
                    $dept->departmentMembers()->create([
                        'user_id'       => $lead->id,
                        'is_lead'       => true,
                        'display_order' => $order++,
                    ]);
                }
            }

            foreach ($data['member_emails'] as $email) {
                $member = User::where('email', $email)->first();
                if ($member && !$dept->departmentMembers()->where('user_id', $member->id)->exists()) {
                    $dept->departmentMembers()->create([
                        'user_id'       => $member->id,
                        'is_lead'       => false,
                        'display_order' => $order++,
                    ]);
                }
            }
        }
    }
}
