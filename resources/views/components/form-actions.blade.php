{{-- Form Actions Component --}}
@props([
    'submitText' => 'Save',
    'cancelUrl' => null,
    'cancelText' => 'Cancel',
    'submitClass' => 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500',
    'cancelClass' => 'bg-gray-300 hover:bg-gray-400 text-gray-700',
    'alignment' => 'right' // left, center, right, between
])

<div class="flex {{ $alignment === 'between' ? 'justify-between' : ($alignment === 'center' ? 'justify-center' : ($alignment === 'left' ? 'justify-start' : 'justify-end')) }} items-center space-x-3 pt-6 border-t border-gray-200">
    @if($cancelUrl)
        <a href="{{ $cancelUrl }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium {{ $cancelClass }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
            {{ $cancelText }}
        </a>
    @endif
    
    <button type="submit" 
            class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg text-sm font-medium text-white {{ $submitClass }} focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        {{ $submitText }}
    </button>
</div>