{{-- Action Buttons Component --}}
@props([
    'viewRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null,
    'deleteConfirm' => 'Are you sure you want to delete this item?',
    'customActions' => []
])

<div class="flex items-center space-x-2">
    {{-- Custom Actions --}}
    @foreach($customActions as $action)
        @if($action['type'] === 'link')
            <a href="{{ $action['route'] }}" 
               class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white {{ $action['class'] ?? 'bg-gray-600 hover:bg-gray-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
               title="{{ $action['title'] ?? '' }}">
                @if(isset($action['icon']))
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"></path>
                    </svg>
                @endif
                {{ $action['label'] }}
            </a>
        @elseif($action['type'] === 'form')
            <form action="{{ $action['route'] }}" method="POST" class="inline">
                @csrf
                @if(isset($action['method']))
                    @method($action['method'])
                @endif
                <button type="submit" 
                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white {{ $action['class'] ?? 'bg-gray-600 hover:bg-gray-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                        @if(isset($action['confirm']))
                            onclick="return confirm('{{ $action['confirm'] }}')"
                        @endif
                        title="{{ $action['title'] ?? '' }}">
                    @if(isset($action['icon']))
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"></path>
                        </svg>
                    @endif
                    {{ $action['label'] }}
                </button>
            </form>
        @endif
    @endforeach

    {{-- View Button --}}
    @if($viewRoute)
        <a href="{{ $viewRoute }}" 
           class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
           title="View details">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            View
        </a>
    @endif

    {{-- Edit Button --}}
    @if($editRoute)
        <a href="{{ $editRoute }}" 
           class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200"
           title="Edit">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
        </a>
    @endif

    {{-- Delete Button --}}
    @if($deleteRoute)
        <form action="{{ $deleteRoute }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                    onclick="return confirm('{{ $deleteConfirm }}')"
                    title="Delete">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Delete
            </button>
        </form>
    @endif
</div>