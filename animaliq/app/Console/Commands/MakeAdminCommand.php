<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdminCommand extends Command
{
    protected $signature = 'animaliq:make-admin
                            {email : The email of the user to make admin}
                            {--super : Assign super_admin instead of admin}';

    protected $description = 'Set a user as admin or super_admin (users.role column)';

    public function handle(): int
    {
        $email = $this->argument('email');
        $super = $this->option('super');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("No user found with email: {$email}");
            $this->info('Create a user first via /register, then run this command again.');

            return self::FAILURE;
        }

        $role = $super ? 'super_admin' : 'admin';

        if ($user->role === $role) {
            $this->info("User {$email} is already {$role}.");
            return self::SUCCESS;
        }

        $user->update(['role' => $role]);
        $this->info("Set {$email} as {$role}.");

        return self::SUCCESS;
    }
}
