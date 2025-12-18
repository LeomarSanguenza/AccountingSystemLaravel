-- Assign Roles to Users
-- This script assigns roles to users based on their existing UserRole field

-- First, let's see what users exist
SELECT 'Current users:' as info;
SELECT UserID, FirstName, LastName, Username, UserRole FROM Users;

-- Check if roles exist
SELECT 'Available roles:' as info;
SELECT id, name FROM roles ORDER BY id;

-- Assign Admin role to users with admin-like UserRole
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\\Models\\User', u.UserID 
FROM Users u, roles r
WHERE r.name = 'Admin'
AND LOWER(u.UserRole) IN ('admin', 'administrator', 'super admin')
AND NOT EXISTS (
    SELECT 1 FROM model_has_roles mhr 
    WHERE mhr.model_id = u.UserID 
    AND mhr.model_type = 'App\\Models\\User'
);

-- Assign Accountant role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\\Models\\User', u.UserID 
FROM Users u, roles r
WHERE r.name = 'Accountant'
AND LOWER(u.UserRole) = 'accountant'
AND NOT EXISTS (
    SELECT 1 FROM model_has_roles mhr 
    WHERE mhr.model_id = u.UserID 
    AND mhr.model_type = 'App\\Models\\User'
);

-- Assign Budget Officer role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\\Models\\User', u.UserID 
FROM Users u, roles r
WHERE r.name = 'Budget Officer'
AND LOWER(u.UserRole) IN ('budget officer', 'budget')
AND NOT EXISTS (
    SELECT 1 FROM model_has_roles mhr 
    WHERE mhr.model_id = u.UserID 
    AND mhr.model_type = 'App\\Models\\User'
);

-- Assign Cashier role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\\Models\\User', u.UserID 
FROM Users u, roles r
WHERE r.name = 'Cashier'
AND LOWER(u.UserRole) = 'cashier'
AND NOT EXISTS (
    SELECT 1 FROM model_has_roles mhr 
    WHERE mhr.model_id = u.UserID 
    AND mhr.model_type = 'App\\Models\\User'
);

-- Assign HR Manager role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\\Models\\User', u.UserID 
FROM Users u, roles r
WHERE r.name = 'HR Manager'
AND LOWER(u.UserRole) IN ('hr', 'hr manager', 'human resources')
AND NOT EXISTS (
    SELECT 1 FROM model_has_roles mhr 
    WHERE mhr.model_id = u.UserID 
    AND mhr.model_type = 'App\\Models\\User'
);

-- Assign Auditor role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\\Models\\User', u.UserID 
FROM Users u, roles r
WHERE r.name = 'Auditor'
AND LOWER(u.UserRole) = 'auditor'
AND NOT EXISTS (
    SELECT 1 FROM model_has_roles mhr 
    WHERE mhr.model_id = u.UserID 
    AND mhr.model_type = 'App\\Models\\User'
);

-- Assign Viewer role to remaining users without roles
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\\Models\\User', u.UserID 
FROM Users u, roles r
WHERE r.name = 'Viewer'
AND NOT EXISTS (
    SELECT 1 FROM model_has_roles mhr 
    WHERE mhr.model_id = u.UserID 
    AND mhr.model_type = 'App\\Models\\User'
);

-- Verify the assignments
SELECT 'User role assignments after fix:' as info;
SELECT 
    u.UserID,
    u.FirstName,
    u.LastName,
    u.Username,
    u.UserRole as OriginalRole,
    r.name as AssignedRole
FROM Users u
LEFT JOIN model_has_roles mhr ON u.UserID = mhr.model_id AND mhr.model_type = 'App\\Models\\User'
LEFT JOIN roles r ON mhr.role_id = r.id
ORDER BY u.UserID;