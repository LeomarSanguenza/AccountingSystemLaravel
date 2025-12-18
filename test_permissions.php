<?php
// Quick script to test user permissions
// Run this with: php test_permissions.php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "Testing user permissions...\n\n";

// Get all users and their permissions
$users = User::with('roles.permissions')->get();

foreach ($users as $user) {
    echo "User: {$user->Username} ({$user->FirstName} {$user->LastName})\n";
    echo "Role: " . ($user->roles->first() ? $user->roles->first()->name : 'No Role') . "\n";
    
    if ($user->roles->first()) {
        $permissions = $user->roles->first()->permissions->pluck('name')->toArray();
        echo "Permissions: " . implode(', ', $permissions) . "\n";
        
        // Check specific journal permissions
        $journalPerms = array_filter($permissions, function($perm) {
            return strpos($perm, 'journal') !== false;
        });
        echo "Journal Permissions: " . implode(', ', $journalPerms) . "\n";
    }
    
    echo str_repeat("-", 80) . "\n";
}