-- =====================================================
-- RBAC Setup Script for Accounting System
-- Run this script to set up roles and permissions
-- =====================================================

-- First, create the permissions table data
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', NOW(), NOW()),
(2, 'view users', 'web', NOW(), NOW()),
(3, 'create users', 'web', NOW(), NOW()),
(4, 'edit users', 'web', NOW(), NOW()),
(5, 'delete users', 'web', NOW(), NOW()),
(6, 'view employees', 'web', NOW(), NOW()),
(7, 'create employees', 'web', NOW(), NOW()),
(8, 'edit employees', 'web', NOW(), NOW()),
(9, 'delete employees', 'web', NOW(), NOW()),
(10, 'view disbursements', 'web', NOW(), NOW()),
(11, 'create disbursements', 'web', NOW(), NOW()),
(12, 'edit disbursements', 'web', NOW(), NOW()),
(13, 'delete disbursements', 'web', NOW(), NOW()),
(14, 'approve disbursements', 'web', NOW(), NOW()),
(15, 'process disbursements', 'web', NOW(), NOW()),
(16, 'view obligations', 'web', NOW(), NOW()),
(17, 'create obligations', 'web', NOW(), NOW()),
(18, 'edit obligations', 'web', NOW(), NOW()),
(19, 'delete obligations', 'web', NOW(), NOW()),
(20, 'approve obligations', 'web', NOW(), NOW()),
(21, 'view journals', 'web', NOW(), NOW()),
(22, 'create journals', 'web', NOW(), NOW()),
(23, 'edit journals', 'web', NOW(), NOW()),
(24, 'delete journals', 'web', NOW(), NOW()),
(25, 'post journals', 'web', NOW(), NOW()),
(26, 'manage system', 'web', NOW(), NOW()),
(27, 'view system tools', 'web', NOW(), NOW()),
(28, 'manage roles', 'web', NOW(), NOW()),
(29, 'manage permissions', 'web', NOW(), NOW()),
(30, 'view reports', 'web', NOW(), NOW()),
(31, 'generate reports', 'web', NOW(), NOW()),
(32, 'export reports', 'web', NOW(), NOW()),
(33, 'manage fund types', 'web', NOW(), NOW()),
(34, 'view fund types', 'web', NOW(), NOW());

-- Create the roles
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', NOW(), NOW()),
(2, 'Admin', 'web', NOW(), NOW()),
(3, 'Accountant', 'web', NOW(), NOW()),
(4, 'Budget Officer', 'web', NOW(), NOW()),
(5, 'Cashier', 'web', NOW(), NOW()),
(6, 'HR Manager', 'web', NOW(), NOW()),
(7, 'Auditor', 'web', NOW(), NOW()),
(8, 'Viewer', 'web', NOW(), NOW());

-- Assign ALL permissions to Super Admin (role_id = 1)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1), (2, 1), (3, 1), (4, 1), (5, 1), (6, 1), (7, 1), (8, 1), (9, 1), (10, 1),
(11, 1), (12, 1), (13, 1), (14, 1), (15, 1), (16, 1), (17, 1), (18, 1), (19, 1), (20, 1),
(21, 1), (22, 1), (23, 1), (24, 1), (25, 1), (26, 1), (27, 1), (28, 1), (29, 1), (30, 1),
(31, 1), (32, 1), (33, 1), (34, 1);

-- Assign permissions to Admin (role_id = 2) - Most permissions except super admin functions
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 2), (3, 2), (4, 2), -- user management (view, create, edit)
(6, 2), (7, 2), (8, 2), (9, 2), -- employee management (all)
(10, 2), (11, 2), (12, 2), (14, 2), -- disbursements (view, create, edit, approve)
(16, 2), (17, 2), (18, 2), (20, 2), -- obligations (view, create, edit, approve)
(21, 2), (22, 2), (23, 2), (25, 2), -- journals (view, create, edit, post)
(27, 2), (28, 2), -- system tools, manage roles
(30, 2), (31, 2), (32, 2), -- reports (all)
(34, 2); -- view fund types

-- Assign permissions to Accountant (role_id = 3)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 3), -- view employees
(10, 3), (11, 3), (12, 3), -- disbursements (view, create, edit)
(16, 3), (17, 3), (18, 3), -- obligations (view, create, edit)
(21, 3), (22, 3), (23, 3), (25, 3), -- journals (view, create, edit, post)
(30, 3), (31, 3); -- reports (view, generate)

-- Assign permissions to Budget Officer (role_id = 4)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 4), -- view employees
(10, 4), (11, 4), -- disbursements (view, create)
(16, 4), (17, 4), (18, 4), (20, 4), -- obligations (view, create, edit, approve)
(30, 4), (31, 4); -- reports (view, generate)

-- Assign permissions to Cashier (role_id = 5)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(10, 5), (15, 5), -- disbursements (view, process)
(16, 5), -- view obligations
(30, 5); -- view reports

-- Assign permissions to HR Manager (role_id = 6)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 6), (7, 6), (8, 6), (9, 6), -- employees (all)
(30, 6), (31, 6); -- reports (view, generate)

-- Assign permissions to Auditor (role_id = 7) - Read-only access
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 7), -- view employees
(10, 7), -- view disbursements
(16, 7), -- view obligations
(21, 7), -- view journals
(30, 7), (31, 7), (32, 7); -- reports (all)

-- Assign permissions to Viewer (role_id = 8) - Basic read access
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(10, 8), -- view disbursements
(16, 8), -- view obligations
(30, 8); -- view reports

-- =====================================================
-- Assign roles to existing users
-- =====================================================

-- Update this section based on your existing users
-- Example: Assign Super Admin role to user with ID 1
-- INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
-- (1, 'App\\Models\\User', 1);

-- Example: Assign Admin role to user with ID 2
-- INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
-- (2, 'App\\Models\\User', 2);

-- =====================================================
-- Query to check existing users and their current roles
-- =====================================================
-- SELECT UserID, FirstName, LastName, Username, UserRole FROM Users;

-- =====================================================
-- Instructions:
-- 1. Run the above INSERT statements first
-- 2. Then check your existing users with the SELECT query
-- 3. Assign roles to users using the model_has_roles table
-- 4. Example for assigning Super Admin to user ID 1:
--    INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (1, 'App\\Models\\User', 1);
-- =====================================================