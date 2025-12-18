<?php
// Quick script to assign roles to users
// Run this with: php assign_roles_command.php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

echo "Assigning roles to users...\n";

// Get all users
$users = User::all();
echo "Found " . $users->count() . " users\n";

foreach ($users as $user) {
    // Skip if user already has a role
    if ($user->roles->count() > 0) {
        echo "User {$user->Username} already has role: " . $user->roles->first()->name . "\n";
        continue;
    }
    
    // Assign role based on UserRole field
    $roleName = 'Viewer'; // default
    
    switch (strtolower($user->UserRole)) {
        case 'admin':
        case 'administrator':
        case 'super admin':
            $roleName = 'Admin';
            break;
        case 'accountant':
            $roleName = 'Accountant';
            break;
        case 'budget officer':
        case 'budget':
            $roleName = 'Budget Officer';
            break;
        case 'cashier':
            $roleName = 'Cashier';
            break;
        case 'hr':
        case 'hr manager':
        case 'human resources':
            $roleName = 'HR Manager';
            break;
        case 'auditor':
            $roleName = 'Auditor';
            break;
    }
    
    try {
        $user->assignRole($roleName);
        echo "Assigned '{$roleName}' role to user: {$user->Username} (was: {$user->UserRole})\n";
    } catch (Exception $e) {
        echo "Error assigning role to {$user->Username}: " . $e->getMessage() . "\n";
    }
}

echo "\nRole assignment complete!\n";

// Show final assignments
echo "\nFinal user role assignments:\n";
$users = User::with('roles')->get();
foreach ($users as $user) {
    $roleName = $user->roles->first() ? $user->roles->first()->name : 'No Role';
    echo "- {$user->Username}: {$roleName}\n";
}