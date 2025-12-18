{{-- User Table Row Partial --}}
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
    #{{ $user->UserID }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    <div class="flex items-center">
        <div class="flex-shrink-0 h-10 w-10">
            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                <span class="text-sm font-medium text-indigo-700">
                    {{ strtoupper(substr($user->FirstName, 0, 1) . substr($user->LastName, 0, 1)) }}
                </span>
            </div>
        </div>
        <div class="ml-4">
            <div class="text-sm font-medium text-gray-900">
                {{ $user->FirstName }} {{ $user->LastName }}
            </div>
            <div class="text-sm text-gray-500">
                {{ $user->Username }}
            </div>
        </div>
    </div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    <span class="font-mono text-gray-600">{{ $user->Username }}</span>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    @php
        $roleColors = [
            'Admin' => 'bg-red-100 text-red-800',
            'SystemController' => 'bg-blue-100 text-blue-800',
            'Employee' => 'bg-green-100 text-green-800'
        ];
        $roleColor = $roleColors[$user->UserRole] ?? 'bg-gray-100 text-gray-800';
    @endphp
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $roleColor }}">
        {{ $user->UserRole }}
    </span>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    @if($user->fundTypeRelation)
        <div class="text-sm text-gray-900">{{ $user->fundTypeRelation->code }}</div>
        <div class="text-sm text-gray-500">{{ Str::limit($user->fundTypeRelation->description, 30) }}</div>
    @else
        <span class="text-gray-400 italic">No fund type assigned</span>
    @endif
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    <x-action-buttons 
        :edit-route="route('users.edit', $user->UserID)"
        :delete-route="route('users.destroy', $user->UserID)"
        delete-confirm="Are you sure you want to delete this user?"
        :custom-actions="[
            [
                'type' => 'link',
                'route' => route('users.editFundType', $user->UserID),
                'label' => 'Fund Type',
                'class' => 'bg-purple-600 hover:bg-purple-700',
                'title' => 'Change Fund Type',
                'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'
            ]
        ]" />
</td>