{{-- Data Table Component --}}
@props([
    'headers' => [],
    'rows' => [],
    'emptyMessage' => 'No records found.',
    'searchable' => false,
    'sortable' => false
])

<div class="overflow-hidden">
    {{-- Search Bar (if enabled) --}}
    @if($searchable)
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center space-x-4">
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm" 
                           placeholder="Search records..."
                           id="table-search">
                </div>
            </div>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <span id="search-results">Showing all records</span>
            </div>
        </div>
    </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach($headers as $header)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{ $header['class'] ?? '' }}">
                            @if($sortable && isset($header['sortable']) && $header['sortable'])
                                <button class="group inline-flex items-center space-x-1 hover:text-gray-700">
                                    <span>{{ $header['label'] }}</span>
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                </button>
                            @else
                                {{ $header['label'] }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if(isset($rows) && count($rows) > 0)
                    @foreach($rows as $row)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            {!! $row !!}
                        </tr>
                    @endforeach
                @elseif(!empty(trim($slot)))
                    {{ $slot }}
                @else
                    <tr>
                        <td colspan="{{ count($headers) }}" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm">{{ $emptyMessage }}</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@if($searchable)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('table-search');
    const table = searchInput.closest('.overflow-hidden').querySelector('table tbody');
    const rows = Array.from(table.querySelectorAll('tr'));
    const resultsSpan = document.getElementById('search-results');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleCount = 0;
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const isVisible = text.includes(searchTerm);
            row.style.display = isVisible ? '' : 'none';
            if (isVisible) visibleCount++;
        });
        
        resultsSpan.textContent = searchTerm 
            ? `Showing ${visibleCount} of ${rows.length} records`
            : 'Showing all records';
    });
});
</script>
@endif