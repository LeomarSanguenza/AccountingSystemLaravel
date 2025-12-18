{{-- Form Layout Component --}}
@props([
    'title' => '',
    'subtitle' => '',
    'breadcrumbs' => [],
    'maxWidth' => 'max-w-4xl'
])

<div class="{{ $maxWidth }} mx-auto">
    {{-- Breadcrumbs --}}
    @if(!empty($breadcrumbs))
    <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
        @foreach($breadcrumbs as $index => $breadcrumb)
            @if($index > 0)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            @endif
            
            @if(isset($breadcrumb['url']))
                <a href="{{ $breadcrumb['url'] }}" class="hover:text-gray-700 transition-colors">
                    {{ $breadcrumb['label'] }}
                </a>
            @else
                <span class="text-gray-700 font-medium">{{ $breadcrumb['label'] }}</span>
            @endif
        @endforeach
    </nav>
    @endif

    {{-- Main Form Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        {{-- Header --}}
        @if($title || $subtitle)
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            @if($title)
                <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
            @endif
            @if($subtitle)
                <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
            @endif
        </div>
        @endif

        {{-- Form Content --}}
        <div class="px-6 py-6">
            {{ $slot }}
        </div>
    </div>
</div>