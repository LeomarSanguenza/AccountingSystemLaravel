{{-- Obligation Request Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        {{ $req->id }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 font-mono">
            {{ $req->trans_no }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 font-mono">
            {{ $req->obr_no }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ \Carbon\Carbon::parse($req->trans_date)->format('M d, Y') }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ \Carbon\Carbon::parse($req->obr_date)->format('M d, Y') }}
    </td>
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
                <div class="text-sm text-gray-900">{{ $req->payee_id }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
            {{ $req->fund_type_id }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
            Q{{ $req->quarter }}
        </span>
    </td>
    <td class="px-6 py-4 text-sm text-gray-900">
        <div class="max-w-xs truncate" title="{{ $req->particulars }}">
            {{ Str::limit($req->particulars, 50) }}
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ \Carbon\Carbon::parse($req->created_at)->format('M d, Y') }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex items-center space-x-2">
            <x-action-buttons 
                :view-route="route('obligations.show', $req->id)"
                :custom-actions="[
                    [
                        'type' => 'link',
                        'route' => route('disbursements.createFromObr', $req->id),
                        'label' => 'Make DV',
                        'class' => 'bg-green-600 hover:bg-green-700',
                        'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6'
                    ]
                ]" />
        </div>
    </td>
</tr>