# Index Page Design Guidelines

## Index Components

The system uses a consistent set of components for all index/listing pages:

### Index Layout Component
- **File**: `resources/views/components/index-layout.blade.php`
- **Purpose**: Provides consistent header, breadcrumbs, and message handling
- **Features**: Title/subtitle, create button, success/error messages, breadcrumbs

### Data Table Component
- **File**: `resources/views/components/data-table.blade.php`
- **Purpose**: Standardized table layout with search and sorting capabilities
- **Features**: Responsive tables, search functionality, empty states, consistent styling

### Action Buttons Component
- **File**: `resources/views/components/action-buttons.blade.php`
- **Purpose**: Consistent action buttons for view, edit, delete, and custom actions
- **Features**: Icon buttons, confirmation dialogs, custom actions, proper spacing

## Design Principles

### Visual Hierarchy
- **Page headers** use gradient backgrounds with clear typography
- **Tables** have clean borders and hover states
- **Action buttons** are color-coded by function (view=blue, edit=yellow, delete=red)
- **Status badges** use appropriate colors and rounded styling

### Layout Structure
```blade
<x-index-layout title="Page Title" subtitle="Description" :create-route="route('create')">
    <x-data-table :headers="[...]" :rows="[...]" searchable />
</x-index-layout>
```

### Color Coding
- **View Actions**: Blue (`bg-blue-600`)
- **Edit Actions**: Yellow (`bg-yellow-600`) 
- **Delete Actions**: Red (`bg-red-600`)
- **Custom Actions**: Purple, Green, etc. based on function
- **Status Badges**: Context-appropriate colors

## Table Design Patterns

### Standard Table Headers
```php
[
    ['label' => 'ID', 'class' => 'w-16'],
    ['label' => 'Name', 'class' => 'min-w-48'],
    ['label' => 'Status', 'class' => 'w-32'],
    ['label' => 'Actions', 'class' => 'w-48']
]
```

### Row Partials
Each index page should have a corresponding `partials/table-row.blade.php` file:
- **Location**: `resources/views/{module}/partials/table-row.blade.php`
- **Purpose**: Clean separation of row rendering logic
- **Benefits**: Reusable, maintainable, testable

### Responsive Design
- **Mobile**: Tables scroll horizontally
- **Tablet**: Optimized column widths
- **Desktop**: Full table layout with proper spacing

## Search and Filtering

### Built-in Search
- **Enable**: Add `searchable` prop to `<x-data-table>`
- **Functionality**: Real-time client-side search across all visible columns
- **UI**: Search input with icon in table header

### Advanced Filtering
For complex filtering needs:
```blade
{{-- Custom filter section --}}
<div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
    <div class="flex items-center space-x-4">
        <select class="rounded-md border-gray-300">
            <option>All Statuses</option>
        </select>
        <input type="date" class="rounded-md border-gray-300">
    </div>
</div>
```

## Status and Badge Design

### Status Badges
```blade
@php
    $statusColors = [
        'active' => 'bg-green-100 text-green-800',
        'pending' => 'bg-yellow-100 text-yellow-800',
        'inactive' => 'bg-red-100 text-red-800'
    ];
@endphp
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$status] }}">
    {{ ucfirst($status) }}
</span>
```

### User Avatars
```blade
<div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
    <span class="text-sm font-medium text-indigo-700">
        {{ strtoupper(substr($name, 0, 2)) }}
    </span>
</div>
```

## Action Patterns

### Standard Actions
```blade
<x-action-buttons 
    :view-route="route('items.show', $item)"
    :edit-route="route('items.edit', $item)"
    :delete-route="route('items.destroy', $item)"
    delete-confirm="Are you sure?" />
```

### Custom Actions
```blade
<x-action-buttons 
    :edit-route="route('items.edit', $item)"
    :custom-actions="[
        [
            'type' => 'link',
            'route' => route('items.approve', $item),
            'label' => 'Approve',
            'class' => 'bg-green-600 hover:bg-green-700',
            'icon' => '...'
        ]
    ]" />
```

## Empty States

### No Data Message
```blade
<div class="flex flex-col items-center py-12">
    <svg class="w-12 h-12 text-gray-300 mb-4">...</svg>
    <p class="text-gray-500 text-sm">No records found.</p>
    <a href="{{ route('create') }}" class="mt-4 btn-primary">
        Create First Record
    </a>
</div>
```

## Pagination

### Laravel Pagination
```blade
@if($items->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        {{ $items->links() }}
    </div>
@endif
```

## Performance Considerations

### Efficient Queries
- Use `select()` to limit columns
- Implement proper pagination
- Use eager loading for relationships
- Consider database indexing

### Client-Side Performance
- Limit initial table rows (paginate)
- Use CSS for hover effects
- Minimize JavaScript for basic interactions

## Accessibility

### Table Accessibility
- Proper `<th>` headers with scope
- Descriptive button labels
- Keyboard navigation support
- Screen reader friendly structure

### Color Accessibility
- Sufficient contrast ratios
- Don't rely solely on color for meaning
- Include icons with color coding

## Mobile Optimization

### Responsive Tables
- Horizontal scroll on mobile
- Touch-friendly button sizes (min 44px)
- Readable text sizes
- Proper spacing for touch targets

### Mobile-First Approach
```blade
<div class="overflow-x-auto">
    <table class="w-full min-w-full">
        {{-- Table content --}}
    </table>
</div>
```

## Updated Index Pages

### Completed
- ✅ `resources/views/disbursements/index.blade.php` - Enhanced with new components
- ✅ `resources/views/journals/index.blade.php` - Modern table design
- ✅ `resources/views/User/index.blade.php` - User management interface
- ✅ `resources/views/Employees/index.blade.php` - Employee management with avatars and actions
- ✅ `resources/views/Tools/banks/index.blade.php` - Bank management interface
- ✅ `resources/views/Tools/payees/index.blade.php` - Payee management interface
- ✅ `resources/views/Tools/offices/index.blade.php` - Office management interface
- ✅ `resources/views/Tools/barangay/index.blade.php` - Barangay management interface
- ✅ `resources/views/Tools/expense_types/index.blade.php` - Expense type management interface
- ✅ `resources/views/Tools/FundTypes/index.blade.php` - Fund type management interface
- ✅ `resources/views/Tools/signatories/index.blade.php` - Signatory management interface
- ✅ `resources/views/Tools/subaccounts/index.blade.php` - Sub account management interface
- ✅ `resources/views/Tools/tags/index.blade.php` - Tag management interface
- ✅ `resources/views/Tools/roles/index.blade.php` - Role management interface

- ✅ `resources/views/obligations/index.blade.php` - Obligation management interface

### All Index Pages Updated! ✅

All major index pages have been successfully updated with the new design system components.

## Benefits Achieved

- **Consistent User Experience** across all listing pages
- **Professional Appearance** with modern design patterns
- **Enhanced Functionality** with built-in search and filtering
- **Better Performance** with optimized rendering
- **Improved Accessibility** with proper ARIA labels and keyboard support
- **Mobile Responsive** design that works on all devices