-- =====================================================
-- Step-by-Step RBAC Setup Script
-- Run each section in order
-- =====================================================

-- STEP 1: Check if tables exist
SELECT 'Checking tables...' as status;
SHOW TABLES LIKE 'permissions';
SHOW TABLES LIKE 'roles';
SHOW TABLES LIKE 'model_has_roles';
SHOW TABLES LIKE 'role_has_permissions';

-- STEP 2: Clear existing data (if any)
SELECT 'Clearing existing data...' as status;
SET FOREIGN_KEY_CHECKS = 0;
DELETE FROM model_has_roles;
DELETE FROM role_has_permissions;
DELETE FROM roles;
DELETE FROM permissions;
SET FOREIGN_KEY_CHECKS = 1;

-- STEP 3: Insert permissions first
SELECT 'Creating permissions...' as status;
INSERT INTO `permissions` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES
('manage users', 'web', NOW(), NOW()),
('view users', 'web', NOW(), NOW()),
('create users', 'web', NOW(), NOW()),
('edit users', 'web', NOW(), NOW()),
('delete users', 'web', NOW(), NOW()),
('view employees', 'web', NOW(), NOW()),
('create employees', 'web', NOW(), NOW()),
('edit employees', 'web', NOW(), NOW()),
('delete employees', 'web', NOW(), NOW()),
('view disbursements', 'web', NOW(), NOW()),
('create disbursements', 'web', NOW(), NOW()),
('edit disbursements', 'web', NOW(), NOW()),
('delete disbursements', 'web', NOW(), NOW()),
('approve disbursements', 'web', NOW(), NOW()),
('process disbursements', 'web', NOW(), NOW()),
('view obligations', 'web', NOW(), NOW()),
('create obligations', 'web', NOW(), NOW()),
('edit obligations', 'web', NOW(), NOW()),
('delete obligations', 'web', NOW(), NOW()),
('approve obligations', 'web', NOW(), NOW()),
('view journals', 'web', NOW(), NOW()),
('create journals', 'web', NOW(), NOW()),
('edit journals', 'web', NOW(), NOW()),
('delete journals', 'web', NOW(), NOW()),
('post journals', 'web', NOW(), NOW()),
('manage system', 'web', NOW(), NOW()),
('view system tools', 'web', NOW(), NOW()),
('manage roles', 'web', NOW(), NOW()),
('manage permissions', 'web', NOW(), NOW()),
('view reports', 'web', NOW(), NOW()),
('generate reports', 'web', NOW(), NOW()),
('export reports', 'web', NOW(), NOW()),
('manage fund types', 'web', NOW(), NOW()),
('view fund types', 'web', NOW(), NOW());

-- Verify permissions were created
SELECT 'Permissions created:' as status, COUNT(*) as count FROM permissions;

-- STEP 4: Insert roles
SELECT 'Creating roles...' as status;
INSERT INTO `roles` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES
('Super Admin', 'web', NOW(), NOW()),
('Admin', 'web', NOW(), NOW()),
('Accountant', 'web', NOW(), NOW()),
('Budget Officer', 'web', NOW(), NOW()),
('Cashier', 'web', NOW(), NOW()),
('HR Manager', 'web', NOW(), NOW()),
('Auditor', 'web', NOW(), NOW()),
('Viewer', 'web', NOW(), NOW());

-- Verify roles were created
SELECT 'Roles created:' as status, COUNT(*) as count FROM roles;
SELECT id, name FROM roles ORDER BY id;

-- STEP 5: Assign permissions to Super Admin (ALL permissions)
SELECT 'Assigning ALL permissions to Super Admin...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 1 FROM permissions p;

-- Verify Super Admin permissions
SELECT 'Super Admin permissions:' as status, COUNT(*) as count 
FROM role_has_permissions WHERE role_id = 1;

-- STEP 6: Assign permissions to Admin role
SELECT 'Assigning permissions to Admin...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 2 FROM permissions p WHERE p.name IN (
    'manage users', 'view users', 'create users', 'edit users',
    'view employees', 'create employees', 'edit employees', 'delete employees',
    'view disbursements', 'create disbursements', 'edit disbursements', 'approve disbursements',
    'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
    'view journals', 'create journals', 'edit journals', 'post journals',
    'manage system', 'view system tools', 'manage roles',
    'view reports', 'generate reports', 'export reports',
    'view fund types'
);

-- STEP 7: Assign permissions to Accountant
SELECT 'Assigning permissions to Accountant...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 3 FROM permissions p WHERE p.name IN (
    'view employees',
    'view disbursements', 'create disbursements', 'edit disbursements',
    'view obligations', 'create obligations', 'edit obligations',
    'view journals', 'create journals', 'edit journals', 'post journals',
    'view reports', 'generate reports'
);

-- STEP 8: Assign permissions to Budget Officer
SELECT 'Assigning permissions to Budget Officer...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 4 FROM permissions p WHERE p.name IN (
    'view employees',
    'view disbursements', 'create disbursements',
    'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
    'view reports', 'generate reports'
);

-- STEP 9: Assign permissions to Cashier
SELECT 'Assigning permissions to Cashier...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 5 FROM permissions p WHERE p.name IN (
    'view disbursements', 'process disbursements',
    'view obligations',
    'view reports'
);

-- STEP 10: Assign permissions to HR Manager
SELECT 'Assigning permissions to HR Manager...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 6 FROM permissions p WHERE p.name IN (
    'view employees', 'create employees', 'edit employees', 'delete employees',
    'view reports', 'generate reports'
);

-- STEP 11: Assign permissions to Auditor
SELECT 'Assigning permissions to Auditor...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 7 FROM permissions p WHERE p.name IN (
    'view employees', 'view disbursements', 'view obligations', 'view journals',
    'view reports', 'generate reports', 'export reports'
);

-- STEP 12: Assign permissions to Viewer
SELECT 'Assigning permissions to Viewer...' as status;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, 8 FROM permissions p WHERE p.name IN (
    'view disbursements', 'view obligations', 'view reports'
);

-- STEP 13: Verify all role permissions
SELECT 'Role permissions summary:' as status;
SELECT r.name as role_name, COUNT(rhp.permission_id) as permission_count
FROM roles r
LEFT JOIN role_has_permissions rhp ON r.id = rhp.role_id
GROUP BY r.id, r.name
ORDER BY r.id;

-- STEP 14: Check existing users
SELECT 'Existing users:' as status;
SELECT UserID, FirstName, LastName, Username, UserRole FROM Users;

-- STEP 15: Assign roles to users (run this after checking users above)
-- Uncomment and modify the sections below based on your actual users

-- For Super Admin assignment (replace X with actual UserID):
-- INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (1, 'App\\Models\\User', X);

-- For Admin assignment (replace X with actual UserID):
-- INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (2, 'App\\Models\\User', X);

-- STEP 16: Bulk assign roles based on existing UserRole field
-- Uncomment these after reviewing your users:

-- Super Admin for admin users
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 1, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE LOWER(UserRole) IN ('admin', 'administrator', 'super admin');

-- Accountant role
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 3, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE LOWER(UserRole) = 'accountant';

-- Budget Officer role
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 4, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE LOWER(UserRole) IN ('budget officer', 'budget');

-- Cashier role
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 5, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE LOWER(UserRole) = 'cashier';

-- HR Manager role
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 6, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE LOWER(UserRole) IN ('hr', 'hr manager', 'human resources');

-- Auditor role
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 7, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE LOWER(UserRole) = 'auditor';

-- Viewer role for remaining users (run this last)
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 8, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- STEP 17: Final verification
-- SELECT 'Final user role assignments:' as status;
-- SELECT 
--     u.UserID,
--     u.FirstName,
--     u.LastName,
--     u.Username,
--     u.UserRole as OldRole,
--     r.name as NewRole
-- FROM Users u
-- LEFT JOIN model_has_roles mhr ON u.UserID = mhr.model_id AND mhr.model_type = 'App\\Models\\User'
-- LEFT JOIN roles r ON mhr.role_id = r.id
-- ORDER BY u.UserID;