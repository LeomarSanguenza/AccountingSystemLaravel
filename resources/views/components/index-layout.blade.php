{{-- Index Layout Component --}}
@props([
    'title' => '',
    'subtitle' => '',
    'breadcrumbs' => [],
    'createRoute' => null,
    'createText' => 'Create New',
    'maxWidth' => 'max-w-7xl'
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

    {{-- Header Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
                    @if($subtitle)
                        <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
                    @endif
                </div>
                
                @if($createRoute)
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ $createRoute }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ $createText }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="px-6 py-4 bg-green-50 border-b border-green-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-green-700 text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="px-6 py-4 bg-red-50 border-b border-red-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10 11.414l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-red-700 text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="px-6 py-4 bg-red-50 border-b border-red-200">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10 11.414l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        @foreach($errors->all() as $error)
                            <p class="text-red-700 text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Content Area --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        {{ $slot }}
    </div>
</div>