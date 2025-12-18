# Project Structure

## Laravel Standard Structure

This project follows Laravel's conventional directory structure with some domain-specific organization.

## Folder Structure Overview

```
├── app/
│   ├── Console/
│   │   └── Kernel.php
│   ├── Exceptions/
│   │   └── Handler.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Bmso/                    # BMSO-specific controllers
│   │   │   ├── AccountCodesController.php
│   │   │   ├── BankController.php
│   │   │   ├── BarangayController.php
│   │   │   ├── BottleCollectorController.php
│   │   │   ├── Controller.php           # Base controller
│   │   │   ├── DisbursementController.php
│   │   │   ├── EmployeeController.php
│   │   │   ├── ExpenseTypeController.php
│   │   │   ├── FundTypeController.php
│   │   │   ├── JournalController.php
│   │   │   ├── LoginController.php
│   │   │   ├── ObligationRequestController.php
│   │   │   ├── OfficeController.php
│   │   │   ├── PartSumsController.php
│   │   │   ├── PayeeController.php
│   │   │   ├── RoleController.php
│   │   │   ├── SignatoryController.php
│   │   │   ├── SubAccountController.php
│   │   │   ├── TagController.php
│   │   │   └── UserController.php
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── PermissionMiddleware.php  # Custom permission middleware
│   │   │   ├── RoleMiddleware.php        # Custom role middleware
│   │   │   └── [other middleware files]
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── Bmso/                        # BMSO domain models
│   │   │   ├── FundType.php
│   │   │   ├── ObligationEntry.php
│   │   │   ├── ObligationRequest.php
│   │   │   └── Payees.php
│   │   ├── AccountCode.php
│   │   ├── Bank.php
│   │   ├── Barangay.php
│   │   ├── DisbStatus.php
│   │   ├── DisbursementDetail.php
│   │   ├── DisbursementHeader.php
│   │   ├── Employee.php
│   │   ├── ExpenseType.php
│   │   ├── Fundtype.php
│   │   ├── JournalDetail.php
│   │   ├── JournalHeader.php
│   │   ├── Office.php
│   │   ├── Payee.php
│   │   ├── Signatory.php
│   │   ├── SubAccount.php
│   │   ├── Tag.php
│   │   └── User.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── BroadcastServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/
│   ├── app.php
│   └── cache/
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   ├── permission.php                   # Spatie permission config
│   └── [other config files]
├── database/
│   ├── factories/
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── 2024_12_15_000001_create_permission_tables.php
│   │   └── 2025_09_17_081010_create_permission_tables.php
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── PermissionSeeder.php
│   │   └── RolePermissionSeeder.php
│   └── sql/                             # Custom SQL scripts
│       ├── assign_admin_roles.sql
│       ├── assign_user_roles.sql
│       ├── fix_admin_permissions.sql
│       ├── fix_rbac_setup.sql
│       ├── quick_admin_setup.sql
│       ├── setup_rbac.sql
│       └── step_by_step_rbac.sql
├── public/
│   ├── build/                           # Compiled assets
│   ├── css/
│   │   └── app.css
│   ├── index.php
│   └── [other public assets]
├── resources/
│   ├── css/
│   │   └── app.css                      # Tailwind CSS source
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   ├── src/
│   │   └── input.css
│   └── views/
│       ├── bottlecollector/
│       ├── disbursements/               # Disbursement CRUD views
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── Employees/                   # Employee management views
│       ├── errors/
│       │   └── 403.blade.php           # Permission denied page
│       ├── journals/                    # Journal CRUD views
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── layout/
│       ├── login/
│       │   └── index.blade.php
│       ├── obligations/
│       ├── partsums/
│       ├── Tools/                       # Administrative tools
│       │   ├── banks/
│       │   ├── barangay/
│       │   ├── expense_types/
│       │   ├── FundTypes/
│       │   ├── offices/
│       │   ├── payees/
│       │   ├── roles/
│       │   ├── signatories/
│       │   ├── subaccounts/
│       │   ├── tags/
│       │   ├── index.blade.php
│       │   └── layout.blade.php
│       ├── User/                        # User management views
│       ├── dashboard.blade.php
│       ├── layout.blade.php             # Main application layout
│       └── welcome.blade.php
├── routes/
│   └── web.php                          # Web routes with permission middleware
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
├── tests/
│   ├── Feature/
│   └── Unit/
├── vendor/                              # Composer dependencies
├── .env                                 # Environment configuration
├── .env.example                         # Environment template
├── artisan                              # Laravel CLI
├── composer.json                        # PHP dependencies
├── package.json                         # Node.js dependencies
├── vite.config.js                       # Vite build configuration
└── [utility scripts]
    ├── assign_roles_command.php
    ├── check_user_roles.php
    ├── setup_rbac.php
    ├── test_fundtype.php
    ├── test_journal_create.php
    └── test_permissions.php
```

## Key Directories

### `/app`
- **`/Http/Controllers`**: Request handling and business logic
  - Main controllers for core entities (User, Disbursement, Journal, etc.)
  - `/Bmso` subfolder for BMSO-specific controllers
- **`/Http/Middleware`**: Custom middleware including permission and role checks
- **`/Models`**: Eloquent models representing database entities
  - `/Bmso` subfolder for BMSO-specific models
- **`/Providers`**: Service providers for application bootstrapping

### `/resources`
- **`/views`**: Blade templates organized by feature
  - `/Tools`: Administrative interface views
  - `/disbursements`, `/journals`, `/obligations`: Feature-specific views
  - `/Employees`, `/User`: Entity management views
  - `layout.blade.php`: Main application layout
- **`/css`** & **`/js`**: Frontend assets (Tailwind CSS, Alpine.js, jQuery)

### `/database`
- **`/migrations`**: Database schema definitions
- **`/seeders`**: Database seeding classes
- **`/sql`**: Custom SQL scripts for RBAC setup and administration

### `/routes`
- **`web.php`**: Web routes with middleware groups for permissions

## Naming Conventions

### Models
- PascalCase: `User`, `DisbursementHeader`, `JournalDetail`
- Database tables may use different casing (e.g., `Users` table)

### Controllers
- PascalCase with `Controller` suffix: `DisbursementController`
- RESTful method names: `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`

### Views
- Organized by feature in lowercase folders
- Blade files use lowercase with hyphens: `create.blade.php`, `edit.blade.php`

### Routes
- Use resource routes where possible: `Route::resource('disbursements', DisbursementController::class)`
- Group related routes with middleware
- Named routes for easier reference: `->name('disbursements.index')`

## Permission Structure

### Middleware Groups
- Routes grouped by permission requirements
- Permission-based access control using Spatie Laravel Permission
- Common permissions: `view`, `create`, `edit`, `delete`, `approve`, `process`, `manage`

### Permission Naming
- Format: `{action} {entity}` (e.g., `view disbursements`, `manage users`)
- Special permissions: `manage system` for administrative functions

## Database Organization

### Models Location
- Main models in `/app/Models`
- Domain-specific models in subfolders (e.g., `/app/Models/Bmso`)
- Relationships defined using Eloquent conventions

### Migration Files
- Timestamped migration files in `/database/migrations`
- Permission-related migrations for RBAC setup

## View Organization

### Layout Structure
- Main layout: `resources/views/layout.blade.php`
- Feature-specific layouts: `resources/views/Tools/layout.blade.php`
- Consistent view structure: `index`, `create`, `edit`, `show` for CRUD operations

### Asset Organization
- CSS compiled from Tailwind in `/resources/css`
- JavaScript assets in `/resources/js`
- Public assets served from `/public`