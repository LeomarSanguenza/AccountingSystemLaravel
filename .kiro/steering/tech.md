# Technology Stack

## Backend Framework
- **Laravel 11**: PHP web application framework
- **PHP 8.2+**: Required minimum PHP version
- **MySQL**: Primary database system

## Key Dependencies
- **Spatie Laravel Permission**: Role-based access control (RBAC) system
- **Laravel Sanctum**: API authentication
- **Laravel Tinker**: Interactive shell for debugging

## Frontend Stack
- **Blade Templates**: Laravel's templating engine
- **Tailwind CSS 4.x**: Utility-first CSS framework
- **Alpine.js**: Lightweight JavaScript framework
- **jQuery**: JavaScript library for DOM manipulation
- **Vite**: Build tool and asset bundler

## Development Tools
- **Laravel Pint**: Code style fixer
- **PHPUnit**: Testing framework
- **Laravel Sail**: Docker development environment
- **Faker**: Test data generation

## Common Commands

### Development
```bash
# Start development server
php artisan serve

# Run database migrations
php artisan migrate

# Seed database
php artisan db:seed

# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Generate application key
php artisan key:generate
```

### Asset Building
```bash
# Development build with hot reload
npm run dev

# Production build
npm run build
```

### Testing
```bash
# Run PHPUnit tests
php artisan test
# or
./vendor/bin/phpunit
```

### Database
```bash
# Create migration
php artisan make:migration create_table_name

# Create model with migration
php artisan make:model ModelName -m

# Rollback migrations
php artisan migrate:rollback
```

### Permissions & Roles
```bash
# Clear permission cache (after role/permission changes)
php artisan permission:cache-reset
```

## Environment Setup
- Copy `.env.example` to `.env`
- Configure database credentials
- Run `php artisan key:generate`
- Run migrations and seeders for initial setup