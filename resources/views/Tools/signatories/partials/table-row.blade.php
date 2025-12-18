{{-- Signatory Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <div class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center">
                    <span class="text-sm font-medium text-teal-700">
                        {{ strtoupper(substr($sig->name, 0, 2)) }}
                    </span>
                </div>
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">{{ $sig->name }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="text-sm text-gray-900">{{ $sig->office }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="text-sm text-gray-900">{{ $sig->position }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
            {{ $sig->designation }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <x-action-buttons 
            :edit-route="route('tools.signatories.edit', $sig->id)"
            :delete-route="route('tools.signatories.destroy', $sig->id)"
            delete-confirm="Are you sure you want to delete this signatory?" />
    </td>
</tr>