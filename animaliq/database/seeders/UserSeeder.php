<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Super admins
            ['first_name' => 'Tabitha', 'last_name' => 'Waigwa', 'email' => 'tabitha@animaliq.co.ke', 'role' => 'super_admin'],
            ['first_name' => 'Eddwin', 'last_name' => 'Waigwa', 'email' => 'eddwinwaigwa@gmail.com', 'role' => 'super_admin'],

            // Admins
            ['first_name' => 'Sarah', 'last_name' => 'Johnson', 'email' => 'sarah.johnson@animaliq.co.ke', 'role' => 'admin'],
            ['first_name' => 'Brian', 'last_name' => 'Otieno', 'email' => 'brian.otieno@animaliq.co.ke', 'role' => 'admin'],
            ['first_name' => 'Mercy', 'last_name' => 'Charles', 'email' => 'mercycharles312@gmail.com', 'role' => 'admin'],
            ['first_name' => 'Lucia', 'last_name' => 'Tiffany', 'email' => 'luciatiffany517@gmail.com', 'role' => 'admin'],
            ['first_name' => 'Kevin', 'last_name' => 'Mwangi', 'email' => 'kevin.mwangi@animaliq.co.ke', 'role' => 'admin'],
            ['first_name' => 'Olivia', 'last_name' => 'Chelanga', 'email' => 'oliviachelanga@gmail.com', 'role' => 'admin'],

            // Members
            ['first_name' => 'Livy', 'last_name' => 'Chela', 'email' => 'livychela@gmail.com', 'role' => 'member'],
            ['first_name' => 'James', 'last_name' => 'Kamau', 'email' => 'james.kamau@gmail.com', 'role' => 'member'],
            ['first_name' => 'Amina', 'last_name' => 'Hassan', 'email' => 'amina.hassan@gmail.com', 'role' => 'member'],
            ['first_name' => 'Peter', 'last_name' => 'Njoroge', 'email' => 'peter.njoroge@gmail.com', 'role' => 'member'],
            ['first_name' => 'Grace', 'last_name' => 'Wanjiku', 'email' => 'grace.wanjiku@gmail.com', 'role' => 'member'],
            ['first_name' => 'Daniel', 'last_name' => 'Ochieng', 'email' => 'daniel.ochieng@gmail.com', 'role' => 'member'],
            ['first_name' => 'Faith', 'last_name' => 'Auma', 'email' => 'faith.auma@gmail.com', 'role' => 'member'],
            ['first_name' => 'Victor', 'last_name' => 'Kiplangat', 'email' => 'victor.kiplangat@gmail.com', 'role' => 'member'],
        ];

        foreach ($users as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'password'   => Hash::make('password'),
                    'role'       => $data['role'],
                    'status'     => 'active',
                ]
            );
        }
    }
}
