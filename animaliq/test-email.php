<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $user = \App\Models\User::first();
    if (!$user) {
        throw new \Exception("No user found to send to.");
    }
    \Illuminate\Support\Facades\Mail::to('notification@animaliq.co.ke')->send(new \App\Mail\WelcomeNotification($user));
    echo "SUCCESS\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
