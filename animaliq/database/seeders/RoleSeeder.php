<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Create admin and super_admin roles.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'description' => 'Full system access. Can manage all content, users, and settings.',
            ],
            [
                'name' => 'admin',
                'description' => 'Administrator. Can manage content and users within assigned scope.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        }
    }
}
