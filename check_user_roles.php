<?php
// Quick script to check user role assignments
// Run this with: php check_user_roles.php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "Checking user role assignments...\n\n";

$users = User::with('roles')->get();

if ($users->count() == 0) {
    echo "No users found.\n";
    exit;
}

echo "User Role Assignments:\n";
echo str_repeat("-", 80) . "\n";
printf("%-15s %-20s %-15s %-20s\n", "Username", "Name", "Original Role", "Assigned Role");
echo str_repeat("-", 80) . "\n";

foreach ($users as $user) {
    $assignedRole = $user->roles->first() ? $user->roles->first()->name : 'No Role';
    $fullName = trim($user->FirstName . ' ' . $user->LastName);
    
    printf("%-15s %-20s %-15s %-20s\n", 
        $user->Username, 
        $fullName, 
        $user->UserRole, 
        $assignedRole
    );
}

echo str_repeat("-", 80) . "\n";
echo "Total users: " . $users->count() . "\n";

// Check if any users don't have roles
$usersWithoutRoles = $users->filter(function($user) {
    return $user->roles->count() == 0;
});

if ($usersWithoutRoles->count() > 0) {
    echo "\nWARNING: " . $usersWithoutRoles->count() . " users have no roles assigned!\n";
} else {
    echo "\nAll users have roles assigned successfully!\n";
}