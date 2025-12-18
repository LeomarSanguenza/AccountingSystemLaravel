-- =====================================================
-- Quick Admin Setup - Run this after the main RBAC setup
-- =====================================================

-- First, check what users exist
SELECT 'Current users in system:' as info;
SELECT UserID, FirstName, LastName, Username, UserRole FROM Users;

-- =====================================================
-- MANUAL ADMIN ASSIGNMENT
-- Replace the UserID numbers below with actual user IDs
-- =====================================================

-- Example: Make user with ID 1 a Super Admin
-- INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (1, 'App\\Models\\User', 1);

-- Example: Make user with ID 2 an Admin  
-- INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (2, 'App\\Models\\User', 2);

-- =====================================================
-- AUTOMATIC ASSIGNMENT BASED ON USERNAME OR ROLE
-- Uncomment and modify as needed
-- =====================================================

-- Make all users with 'admin' in UserRole field Super Admins
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 1, 'App\\Models\\User', UserID 
FROM Users 
WHERE LOWER(UserRole) LIKE '%admin%'
AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Make users with specific usernames Super Admins (modify usernames as needed)
-- INSERT INTO model_has_roles (role_id, model_type, model_id)
-- SELECT 1, 'App\\Models\\User', UserID 
-- FROM Users 
-- WHERE Username IN ('admin', 'administrator', 'superadmin')
-- AND UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- Assign remaining users as Viewers
INSERT INTO model_has_roles (role_id, model_type, model_id)
SELECT 8, 'App\\Models\\User', UserID 
FROM Users 
WHERE UserID NOT IN (SELECT model_id FROM model_has_roles WHERE model_type = 'App\\Models\\User');

-- =====================================================
-- VERIFICATION
-- =====================================================

-- Check role assignments
SELECT 'User role assignments:' as info;
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

-- Check permissions for Super Admins
SELECT 'Super Admin users and their permission count:' as info;
SELECT 
    u.Username,
    u.FirstName,
    u.LastName,
    COUNT(DISTINCT p.name) as permission_count
FROM Users u
JOIN model_has_roles mhr ON u.UserID = mhr.model_id AND mhr.model_type = 'App\\Models\\User'
JOIN roles r ON mhr.role_id = r.id
JOIN role_has_permissions rhp ON r.id = rhp.role_id
JOIN permissions p ON rhp.permission_id = p.id
WHERE r.name = 'Super Admin'
GROUP BY u.UserID, u.Username, u.FirstName, u.LastName;