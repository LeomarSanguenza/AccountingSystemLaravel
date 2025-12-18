-- =====================================================
-- Assign Admin Roles to Existing Users
-- =====================================================

-- First, let's see what users exist
SELECT UserID, FirstName, LastName, Username, UserRole FROM Users;

-- =====================================================
-- Assign roles based on existing UserRole field
-- =====================================================

-- Assign Super Admin role to users with 'admin' or 'administrator' role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 1, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) IN ('admin', 'administrator', 'super admin')
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign Admin role to users with 'admin' role (if you want separate admin level)
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 2, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) = 'admin'
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign Accountant role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 3, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) = 'accountant'
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign Budget Officer role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 4, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) IN ('budget officer', 'budget')
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign Cashier role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 5, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) = 'cashier'
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign HR Manager role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 6, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) IN ('hr', 'hr manager', 'human resources')
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign Auditor role
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 7, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) = 'auditor'
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign Viewer role to any remaining users without roles
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 8, 'App\\Models\\User', UserID 
FROM Users 
WHERE UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- =====================================================
-- Manual assignment examples (replace X with actual UserID)
-- =====================================================

-- To manually assign Super Admin to a specific user (replace X with UserID):
-- INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (1, 'App\\Models\\User', X);

-- To manually assign Admin to a specific user (replace X with UserID):
-- INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (2, 'App\\Models\\User', X);

-- =====================================================
-- Verification queries
-- =====================================================

-- Check all users and their assigned roles
SELECT 
    u.UserID,
    u.FirstName,
    u.LastName,
    u.Username,
    u.UserRole as OldRole,
    r.name as NewRole
FROM Users u
LEFT JOIN model_has_roles mhr ON u.UserID = mhr.model_id AND mhr.model_type = 'App\\Models\\User'
LEFT JOIN roles r ON mhr.role_id = r.id
ORDER BY u.UserID;

-- Check permissions for a specific user (replace X with UserID)
-- SELECT DISTINCT p.name as permission
-- FROM permissions p
-- JOIN role_has_permissions rhp ON p.id = rhp.permission_id
-- JOIN model_has_roles mhr ON rhp.role_id = mhr.role_id
-- WHERE mhr.model_id = X AND mhr.model_type = 'App\\Models\\User'
-- ORDER BY p.name;