-- Fix Admin Role Permissions
-- This script adds the missing permissions to the Admin role

-- Add 'manage users' permission to Admin role
INSERT IGNORE INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, r.id 
FROM permissions p, roles r 
WHERE p.name = 'manage users' 
AND r.name = 'Admin';

-- Add 'manage system' permission to Admin role
INSERT IGNORE INTO `role_has_permissions` (`permission_id`, `role_id`)
SELECT p.id, r.id 
FROM permissions p, roles r 
WHERE p.name = 'manage system' 
AND r.name = 'Admin';

-- Verify the Admin role now has the correct permissions
SELECT 'Admin role permissions after fix:' as status;
SELECT p.name as permission_name
FROM permissions p
JOIN role_has_permissions rhp ON p.id = rhp.permission_id
JOIN roles r ON rhp.role_id = r.id
WHERE r.name = 'Admin'
ORDER BY p.name;