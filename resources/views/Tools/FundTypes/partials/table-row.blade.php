{{-- Fund Type Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        {{ $fundtype->id }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-8 w-8">
                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                    <svg class="h-4 w-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <div class="text-sm font-medium text-gray-900">{{ $fundtype->description }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 font-mono">
            {{ $fundtype->code }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
            {{ $fundtype->alias }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <x-action-buttons 
            :view-route="route('tools.fundtypes.show', $fundtype->id)"
            :edit-route="route('tools.fundtypes.edit', $fundtype->id)"
            :delete-route="route('tools.fundtypes.destroy', $fundtype->id)"
            delete-confirm="Are you sure you want to delete this fund type?" />
    </td>
</tr>