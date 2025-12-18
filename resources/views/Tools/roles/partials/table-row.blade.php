{{-- Role Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-8 w-8">
                <div class="h-8 w-8 rounded-full bg-violet-100 flex items-center justify-center">
                    <svg class="h-4 w-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <div class="text-sm font-medium text-gray-900">{{ $role->name }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 text-sm text-gray-900">
        <div class="flex flex-wrap gap-1">
            @foreach($role->permissions as $perm)
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ $perm->name }}
                </span>
            @endforeach
            @if($role->permissions->isEmpty())
                <span class="text-gray-500 text-xs">No permissions assigned</span>
            @endif
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <x-action-buttons 
            :edit-route="route('tools.roles.edit', $role->id)"
            :delete-route="route('tools.roles.destroy', $role->id)"
            delete-confirm="Are you sure you want to delete this role?" />
    </td>
</tr>