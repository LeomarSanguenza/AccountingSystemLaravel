{{-- Expense Type Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-8 w-8">
                <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center">
                    <svg class="h-4 w-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <div class="text-sm font-medium text-gray-900">{{ $type->name }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 text-sm text-gray-900">
        <div class="max-w-xs">{{ $type->description }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <x-action-buttons 
            :edit-route="route('tools.expense_types.edit', $type->id)"
            :delete-route="route('tools.expense_types.destroy', $type->id)"
            delete-confirm="Are you sure you want to delete this expense type?" />
    </td>
</tr>