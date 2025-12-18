{{-- Activity Log Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="text-sm font-medium text-gray-900">
            {{ $activity->created_at->format('M d, Y') }}
        </div>
        <div class="text-sm text-gray-500">
            {{ $activity->created_at->format('H:i:s') }}
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        @if($activity->user)
            <div class="flex items-center">
                <div class="flex-shrink-0 h-8 w-8">
                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                        <span class="text-xs font-medium text-indigo-700">
                            {{ strtoupper(substr($activity->user->FirstName, 0, 1) . substr($activity->user->LastName, 0, 1)) }}
                        </span>
                    </div>
                </div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $activity->user->FirstName }} {{ $activity->user->LastName }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $activity->user->Username }}
                    </div>
                </div>
            </div>
        @else
            <span class="text-gray-400 italic">Unknown User</span>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        @php
            $actionColors = [
                'page_visit' => 'bg-blue-100 text-blue-800',
                'view' => 'bg-green-100 text-green-800',
                'create' => 'bg-emerald-100 text-emerald-800',
                'update' => 'bg-yellow-100 text-yellow-800',
                'delete' => 'bg-red-100 text-red-800',
                'login' => 'bg-purple-100 text-purple-800',
                'logout' => 'bg-gray-100 text-gray-800',
            ];
            $actionColor = $actionColors[$activity->action] ?? 'bg-gray-100 text-gray-800';
        @endphp
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $actionColor }}">
            {{ ucfirst(str_replace('_', ' ', $activity->action)) }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
            {{ ucfirst(str_replace('.', ' - ', $activity->module)) }}
        </span>
    </td>
    <td class="px-6 py-4 text-sm text-gray-900">
        <div class="max-w-xs">
            {{ $activity->description }}
        </div>
        @if($activity->method !== 'GET')
            <div class="text-xs text-gray-500 mt-1">
                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                    {{ $activity->method }}
                </span>
            </div>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
        {{ $activity->ip_address }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <button type="button" 
                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                onclick="showActivityDetails({{ $activity->id }})"
                title="View Details">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </button>
    </td>
</tr>

{{-- Activity Details Modal (hidden by default) --}}
<div id="activity-modal-{{ $activity->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="hideActivityDetails({{ $activity->id }})"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Activity Details</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">URL</label>
                                <p class="text-sm text-gray-900 break-all">{{ $activity->url }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">User Agent</label>
                                <p class="text-sm text-gray-900 break-all">{{ $activity->user_agent }}</p>
                            </div>
                            
                            @if($activity->data && count($activity->data) > 0)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Additional Data</label>
                                    <pre class="text-xs text-gray-900 bg-gray-100 p-2 rounded overflow-auto max-h-40">{{ json_encode($activity->data, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="hideActivityDetails({{ $activity->id }})">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showActivityDetails(id) {
    document.getElementById('activity-modal-' + id).classList.remove('hidden');
}

function hideActivityDetails(id) {
    document.getElementById('activity-modal-' + id).classList.add('hidden');
}
</script>
@endpush