-- =====================================================
-- FOOLPROOF RBAC SETUP - Run each section separately
-- =====================================================

-- SECTION 1: Clean slate (run this first)
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE model_has_roles;
TRUNCATE TABLE role_has_permissions;
TRUNCATE TABLE roles;
TRUNCATE TABLE permissions;
SET FOREIGN_KEY_CHECKS = 1;

-- SECTION 2: Create permissions (run this second)
INSERT INTO permissions (name, guard_name, created_at, updated_at) VALUES
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

-- Verify permissions
SELECT 'Permissions created:', COUNT(*) FROM permissions;

-- SECTION 3: Create roles (run this third)
INSERT INTO roles (name, guard_name, created_at, updated_at) VALUES
('Super Admin', 'web', NOW(), NOW()),
('Admin', 'web', NOW(), NOW()),
('Accountant', 'web', NOW(), NOW()),
('Budget Officer', 'web', NOW(), NOW()),
('Cashier', 'web', NOW(), NOW()),
('HR Manager', 'web', NOW(), NOW()),
('Auditor', 'web', NOW(), NOW()),
('Viewer', 'web', NOW(), NOW());

-- Verify roles
SELECT 'Roles created:', COUNT(*) FROM roles;
SELECT id, name FROM roles;

-- SECTION 4: Assign ALL permissions to Super Admin (run this fourth)
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT id, 1 FROM permissions;

-- Verify Super Admin permissions
SELECT 'Super Admin permissions:', COUNT(*) FROM role_has_permissions WHERE role_id = 1;

-- SECTION 5: Assign permissions to other roles (run this fifth)

-- Admin permissions (most permissions)
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT p.id, 2 FROM permissions p WHERE p.name IN (
    'view users', 'create users', 'edit users',
    'view employees', 'create employees', 'edit employees', 'delete employees',
    'view disbursements', 'create disbursements', 'edit disbursements', 'approve disbursements',
    'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
    'view journals', 'create journals', 'edit journals', 'post journals',
    'view system tools', 'manage roles',
    'view reports', 'generate reports', 'export reports',
    'view fund types'
);

-- Accountant permissions
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT p.id, 3 FROM permissions p WHERE p.name IN (
    'view employees',
    'view disbursements', 'create disbursements', 'edit disbursements',
    'view obligations', 'create obligations', 'edit obligations',
    'view journals', 'create journals', 'edit journals', 'post journals',
    'view reports', 'generate reports'
);

-- Budget Officer permissions
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT p.id, 4 FROM permissions p WHERE p.name IN (
    'view employees',
    'view disbursements', 'create disbursements',
    'view obligations', 'create obligations', 'edit obligations', 'approve obligations',
    'view reports', 'generate reports'
);

-- Cashier permissions
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT p.id, 5 FROM permissions p WHERE p.name IN (
    'view disbursements', 'process disbursements',
    'view obligations',
    'view reports'
);

-- HR Manager permissions
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT p.id, 6 FROM permissions p WHERE p.name IN (
    'view employees', 'create employees', 'edit employees', 'delete employees',
    'view reports', 'generate reports'
);

-- Auditor permissions
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT p.id, 7 FROM permissions p WHERE p.name IN (
    'view employees', 'view disbursements', 'view obligations', 'view journals',
    'view reports', 'generate reports', 'export reports'
);

-- Viewer permissions
INSERT INTO role_has_permissions (permission_id, role_id)
SELECT p.id, 8 FROM permissions p WHERE p.name IN (
    'view disbursements', 'view obligations', 'view reports'
);

-- SECTION 6: Verify everything is set up correctly
SELECT 'Setup verification:' as status;
SELECT r.name as role_name, COUNT(rhp.permission_id) as permission_count
FROM roles r
LEFT JOIN role_has_permissions rhp ON r.id = rhp.role_id
GROUP BY r.id, r.name
ORDER BY r.id;

-- SECTION 7: Check your users (run this to see who to assign roles to)
SELECT 'Your current users:' as info;
SELECT UserID, FirstName, LastName, Username, UserRole FROM Users;