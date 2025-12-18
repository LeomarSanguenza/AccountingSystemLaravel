<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'manage users',
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Employee management
            'view employees',
            'create employees',
            'edit employees',
            'delete employees',
            
            // Disbursement management
            'view disbursements',
            'create disbursements',
            'edit disbursements',
            'delete disbursements',
            'approve disbursements',
            'process disbursements',
            
            // Obligation management
            'view obligations',
            'create obligations',
            'edit obligations',
            'delete obligations',
            'approve obligations',
            
            // Journal management
            'view journals',
            'create journals',
            'edit journals',
            'delete journals',
            'post journals',
            
            // System management
            'manage system',
            'view system tools',
            'manage roles',
            'manage permissions',
            
            // Reports
            'view reports',
            'generate reports',
            'export reports',
            
            // Fund types
            'manage fund types',
            'view fund types',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin - has all permissions
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->syncPermissions(Permission::all());

        // Admin - has most permissions except super admin functions
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions([
            'manage users', 'view users', 'create users', 'edit users',
            'view employees', 'create employees', 'edit employees', 'delete employees',
            'view disbursements', 'create disbursements', 'edit disbursements', 'approve disbursements',
            'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
            'view journals', 'create journals', 'edit journals', 'post journals',
            'manage system', 'view system tools', 'manage roles',
            'view reports', 'generate reports', 'export reports',
            'view fund types',
        ]);

        // Accountant - financial operations
        $accountant = Role::firstOrCreate(['name' => 'Accountant']);
        $accountant->syncPermissions([
            'view disbursements', 'create disbursements', 'edit disbursements',
            'view obligations', 'create obligations', 'edit obligations',
            'view journals', 'create journals', 'edit journals', 'post journals',
            'view reports', 'generate reports',
            'view employees',
        ]);

        // Budget Officer - budget and obligations
        $budgetOfficer = Role::firstOrCreate(['name' => 'Budget Officer']);
        $budgetOfficer->syncPermissions([
            'view disbursements', 'create disbursements',
            'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
            'view reports', 'generate reports',
            'view employees',
        ]);

        // Cashier - disbursement processing
        $cashier = Role::firstOrCreate(['name' => 'Cashier']);
        $cashier->syncPermissions([
            'view disbursements', 'process disbursements',
            'view obligations',
            'view reports',
        ]);

        // HR Manager - employee management
        $hrManager = Role::firstOrCreate(['name' => 'HR Manager']);
        $hrManager->syncPermissions([
            'view employees', 'create employees', 'edit employees', 'delete employees',
            'view reports', 'generate reports',
        ]);

        // Auditor - read-only access
        $auditor = Role::firstOrCreate(['name' => 'Auditor']);
        $auditor->syncPermissions([
            'view disbursements',
            'view obligations',
            'view journals',
            'view employees',
            'view reports', 'generate reports', 'export reports',
        ]);

        // Viewer - basic read access
        $viewer = Role::firstOrCreate(['name' => 'Viewer']);
        $viewer->syncPermissions([
            'view disbursements',
            'view obligations',
            'view reports',
        ]);

        // Assign roles to existing users if any
        $users = User::all();
        foreach ($users as $user) {
            // Skip if user already has roles assigned
            if ($user->roles->count() > 0) {
                continue;
            }
            
            // Assign role based on existing UserRole field
            switch (strtolower($user->UserRole)) {
                case 'admin':
                case 'administrator':
                    $user->assignRole('Admin');
                    break;
                case 'accountant':
                    $user->assignRole('Accountant');
                    break;
                case 'budget officer':
                    $user->assignRole('Budget Officer');
                    break;
                case 'cashier':
                    $user->assignRole('Cashier');
                    break;
                case 'hr':
                case 'hr manager':
                    $user->assignRole('HR Manager');
                    break;
                case 'auditor':
                    $user->assignRole('Auditor');
                    break;
                default:
                    $user->assignRole('Viewer');
                    break;
            }
        }
    }
}