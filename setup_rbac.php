<?php
/**
 * RBAC Setup Script for Accounting System
 * Run this script to set up roles and permissions
 * 
 * Usage: php setup_rbac.php
 */

// Database configuration - Update these with your database credentials
$host = 'localhost';
$dbname = 'your_database_name';  // Update this
$username = 'your_db_username';  // Update this
$password = 'your_db_password';  // Update this

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    
    // Check if tables exist
    $tables = ['permissions', 'roles', 'role_has_permissions', 'model_has_roles'];
    foreach ($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() == 0) {
            echo "Error: Table '$table' does not exist. Please run migrations first.\n";
            exit(1);
        }
    }
    
    echo "All required tables exist. Setting up RBAC...\n";
    
    // Clear existing data
    echo "Clearing existing RBAC data...\n";
    $pdo->exec("DELETE FROM model_has_roles");
    $pdo->exec("DELETE FROM role_has_permissions");
    $pdo->exec("DELETE FROM roles");
    $pdo->exec("DELETE FROM permissions");
    
    // Reset auto increment
    $pdo->exec("ALTER TABLE permissions AUTO_INCREMENT = 1");
    $pdo->exec("ALTER TABLE roles AUTO_INCREMENT = 1");
    
    // Insert permissions
    echo "Creating permissions...\n";
    $permissions = [
        'manage users', 'view users', 'create users', 'edit users', 'delete users',
        'view employees', 'create employees', 'edit employees', 'delete employees',
        'view disbursements', 'create disbursements', 'edit disbursements', 'delete disbursements', 'approve disbursements', 'process disbursements',
        'view obligations', 'create obligations', 'edit obligations', 'delete obligations', 'approve obligations',
        'view journals', 'create journals', 'edit journals', 'delete journals', 'post journals',
        'manage system', 'view system tools', 'manage roles', 'manage permissions',
        'view reports', 'generate reports', 'export reports',
        'manage fund types', 'view fund types'
    ];
    
    $stmt = $pdo->prepare("INSERT INTO permissions (name, guard_name, created_at, updated_at) VALUES (?, 'web', NOW(), NOW())");
    foreach ($permissions as $permission) {
        $stmt->execute([$permission]);
    }
    
    // Insert roles
    echo "Creating roles...\n";
    $roles = [
        'Super Admin', 'Admin', 'Accountant', 'Budget Officer', 
        'Cashier', 'HR Manager', 'Auditor', 'Viewer'
    ];
    
    $stmt = $pdo->prepare("INSERT INTO roles (name, guard_name, created_at, updated_at) VALUES (?, 'web', NOW(), NOW())");
    foreach ($roles as $role) {
        $stmt->execute([$role]);
    }
    
    // Assign permissions to roles
    echo "Assigning permissions to roles...\n";
    
    // Super Admin gets ALL permissions
    $pdo->exec("
        INSERT INTO role_has_permissions (permission_id, role_id)
        SELECT p.id, 1 FROM permissions p
    ");
    
    // Admin gets most permissions
    $adminPermissions = [
        'view users', 'create users', 'edit users',
        'view employees', 'create employees', 'edit employees', 'delete employees',
        'view disbursements', 'create disbursements', 'edit disbursements', 'approve disbursements',
        'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
        'view journals', 'create journals', 'edit journals', 'post journals',
        'view system tools', 'manage roles',
        'view reports', 'generate reports', 'export reports',
        'view fund types'
    ];
    
    foreach ($adminPermissions as $permission) {
        $pdo->exec("
            INSERT INTO role_has_permissions (permission_id, role_id)
            SELECT p.id, 2 FROM permissions p WHERE p.name = '$permission'
        ");
    }
    
    // Accountant permissions
    $accountantPermissions = [
        'view employees',
        'view disbursements', 'create disbursements', 'edit disbursements',
        'view obligations', 'create obligations', 'edit obligations',
        'view journals', 'create journals', 'edit journals', 'post journals',
        'view reports', 'generate reports'
    ];
    
    foreach ($accountantPermissions as $permission) {
        $pdo->exec("
            INSERT INTO role_has_permissions (permission_id, role_id)
            SELECT p.id, 3 FROM permissions p WHERE p.name = '$permission'
        ");
    }
    
    // Budget Officer permissions
    $budgetPermissions = [
        'view employees',
        'view disbursements', 'create disbursements',
        'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
        'view reports', 'generate reports'
    ];
    
    foreach ($budgetPermissions as $permission) {
        $pdo->exec("
            INSERT INTO role_has_permissions (permission_id, role_id)
            SELECT p.id, 4 FROM permissions p WHERE p.name = '$permission'
        ");
    }
    
    // Cashier permissions
    $cashierPermissions = [
        'view disbursements', 'process disbursements',
        'view obligations',
        'view reports'
    ];
    
    foreach ($cashierPermissions as $permission) {
        $pdo->exec("
            INSERT INTO role_has_permissions (permission_id, role_id)
            SELECT p.id, 5 FROM permissions p WHERE p.name = '$permission'
        ");
    }
    
    // HR Manager permissions
    $hrPermissions = [
        'view employees', 'create employees', 'edit employees', 'delete employees',
        'view reports', 'generate reports'
    ];
    
    foreach ($hrPermissions as $permission) {
        $pdo->exec("
            INSERT INTO role_has_permissions (permission_id, role_id)
            SELECT p.id, 6 FROM permissions p WHERE p.name = '$permission'
        ");
    }
    
    // Auditor permissions (read-only)
    $auditorPermissions = [
        'view employees', 'view disbursements', 'view obligations', 'view journals',
        'view reports', 'generate reports', 'export reports'
    ];
    
    foreach ($auditorPermissions as $permission) {
        $pdo->exec("
            INSERT INTO role_has_permissions (permission_id, role_id)
            SELECT p.id, 7 FROM permissions p WHERE p.name = '$permission'
        ");
    }
    
    // Viewer permissions (basic read)
    $viewerPermissions = [
        'view disbursements', 'view obligations', 'view reports'
    ];
    
    foreach ($viewerPermissions as $permission) {
        $pdo->exec("
            INSERT INTO role_has_permissions (permission_id, role_id)
            SELECT p.id, 8 FROM permissions p WHERE p.name = '$permission'
        ");
    }
    
    // Assign roles to existing users based on their UserRole field
    echo "Assigning roles to existing users...\n";
    
    // Get existing users
    $users = $pdo->query("SELECT UserID, UserRole FROM Users")->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        $roleId = 8; // Default to Viewer
        
        switch (strtolower($user['UserRole'])) {
            case 'admin':
            case 'administrator':
            case 'super admin':
                $roleId = 1; // Super Admin
                break;
            case 'accountant':
                $roleId = 3; // Accountant
                break;
            case 'budget officer':
            case 'budget':
                $roleId = 4; // Budget Officer
                break;
            case 'cashier':
                $roleId = 5; // Cashier
                break;
            case 'hr':
            case 'hr manager':
            case 'human resources':
                $roleId = 6; // HR Manager
                break;
            case 'auditor':
                $roleId = 7; // Auditor
                break;
        }
        
        $pdo->exec("
            INSERT INTO model_has_roles (role_id, model_type, model_id) 
            VALUES ($roleId, 'App\\\\Models\\\\User', {$user['UserID']})
        ");
    }
    
    echo "RBAC setup completed successfully!\n";
    echo "\nRole Summary:\n";
    echo "1. Super Admin - Full access to everything\n";
    echo "2. Admin - Most permissions except super admin functions\n";
    echo "3. Accountant - Financial operations\n";
    echo "4. Budget Officer - Budget and obligations\n";
    echo "5. Cashier - Disbursement processing\n";
    echo "6. HR Manager - Employee management\n";
    echo "7. Auditor - Read-only access\n";
    echo "8. Viewer - Basic read access\n";
    
    // Show user assignments
    echo "\nUser Role Assignments:\n";
    $result = $pdo->query("
        SELECT 
            u.UserID,
            u.FirstName,
            u.LastName,
            u.Username,
            u.UserRole as OldRole,
            r.name as NewRole
        FROM Users u
        LEFT JOIN model_has_roles mhr ON u.UserID = mhr.model_id AND mhr.model_type = 'App\\\\Models\\\\User'
        LEFT JOIN roles r ON mhr.role_id = r.id
        ORDER BY u.UserID
    ");
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "- {$row['FirstName']} {$row['LastName']} ({$row['Username']}): {$row['OldRole']} → {$row['NewRole']}\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>