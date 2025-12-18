{{-- Payee Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-8 w-8">
                <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <div class="text-sm font-medium text-gray-900">{{ $payee->payee_name }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <x-action-buttons 
            :edit-route="route('tools.payees.edit', $payee->id)"
            :delete-route="route('tools.payees.destroy', $payee->id)"
            delete-confirm="Are you sure you want to delete this payee?" />
    </td>
</tr>