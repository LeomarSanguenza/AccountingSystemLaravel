# Form Design Guidelines

## Form Components

The system uses a consistent set of form components for all create and edit forms:

### Form Layout Component
- **File**: `resources/views/components/form-layout.blade.php`
- **Purpose**: Provides consistent container, breadcrumbs, and header structure
- **Usage**: Wrap all forms with `<x-form-layout>` component

### Form Field Component  
- **File**: `resources/views/components/form-field.blade.php`
- **Purpose**: Standardized input fields with labels, validation, and help text
- **Types**: text, email, password, number, date, select, textarea
- **Features**: Automatic error display, required field indicators, help text

### Form Actions Component
- **File**: `resources/views/components/form-actions.blade.php`
- **Purpose**: Consistent submit and cancel button styling and layout
- **Features**: Configurable button text, colors, and alignment

## Design Principles

### Visual Hierarchy
- **Form sections** use gray background (`bg-gray-50`) with rounded corners
- **Section headers** are `text-lg font-semibold text-gray-900`
- **Field labels** are `text-sm font-medium text-gray-700`
- **Required fields** show red asterisk (`text-red-500`)

### Color Scheme
- **Primary actions**: Indigo (`bg-indigo-600 hover:bg-indigo-700`)
- **Secondary actions**: Gray (`bg-gray-300 hover:bg-gray-400`)
- **Destructive actions**: Red (`text-red-600 hover:text-red-800`)
- **Success states**: Green (for completed actions)

### Spacing and Layout
- **Form spacing**: `space-y-6` between major sections
- **Grid layouts**: Responsive grids (`grid-cols-1 md:grid-cols-2 lg:grid-cols-4`)
- **Field spacing**: `gap-4` or `gap-6` between fields
- **Container padding**: `p-4` for sections, `px-6 py-6` for main containers

### Interactive Elements
- **Focus states**: Indigo ring (`focus:ring-indigo-500`)
- **Hover effects**: Subtle color transitions
- **Disabled states**: Gray background (`bg-gray-50 text-gray-500`)
- **Readonly fields**: Light gray background

## Form Patterns

### Basic CRUD Forms
```blade
<x-form-layout title="Form Title" :breadcrumbs="[...]">
    <form method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form-field label="Field Name" name="field_name" required />
        </div>
        
        <x-form-actions submit-text="Save" :cancel-url="route('index')" />
    </form>
</x-form-layout>
```

### Complex Forms with Sections
```blade
<x-form-layout title="Complex Form">
    <form method="POST" class="space-y-6">
        {{-- Section 1 --}}
        <div class="bg-gray-50 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Section Title</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-field label="Field" name="field" />
            </div>
        </div>
        
        {{-- Dynamic Tables --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Table Title</h3>
                <button type="button" class="btn-primary">Add Row</button>
            </div>
            <table class="w-full">...</table>
        </div>
    </form>
</x-form-layout>
```

### Dynamic Tables
- **Header**: Gray background with title and add button
- **Rows**: Hover effects (`hover:bg-gray-50`)
- **Actions**: Icon buttons with hover states
- **Totals**: Bold footer row with gray background

## Validation and Errors

### Error Display
- **Field errors**: Automatically shown below fields in red
- **Form errors**: Use Laravel's validation with `@error` directives
- **Success messages**: Flash messages with green styling

### Required Fields
- **Visual indicator**: Red asterisk after label
- **Validation**: Use `required` attribute and server-side validation
- **Help text**: Provide guidance for complex fields

## Responsive Design

### Breakpoints
- **Mobile**: Single column layout
- **Tablet** (`md:`): Two column grids
- **Desktop** (`lg:`): Up to four columns for complex forms

### Mobile Considerations
- **Touch targets**: Minimum 44px height for buttons
- **Scrollable tables**: Horizontal scroll for wide tables
- **Stacked layout**: Fields stack vertically on small screens

## Accessibility

### Standards
- **Labels**: Proper `for` attributes linking to inputs
- **ARIA**: Appropriate ARIA labels for complex interactions
- **Focus management**: Logical tab order
- **Color contrast**: WCAG AA compliant colors

### Keyboard Navigation
- **Tab order**: Logical progression through form
- **Enter key**: Submits forms appropriately
- **Escape key**: Cancels modal forms