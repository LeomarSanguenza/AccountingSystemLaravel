{{-- Form Field Component --}}
@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'options' => [],
    'help' => '',
    'error' => '',
    'class' => '',
    'containerClass' => '',
    'rows' => 3
])

<div class="space-y-1 {{ $containerClass }}">
    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Input Field --}}
    @if($type === 'select')
        <select 
            name="{{ $name }}" 
            id="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200 {{ $disabled ? 'bg-gray-50 text-gray-500' : '' }} {{ $class }}"
            {{ $attributes }}
        >
            @if(!$required && empty($placeholder))
                <option value="">-- Select {{ $label }} --</option>
            @elseif($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @elseif($type === 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200 {{ $disabled ? 'bg-gray-50 text-gray-500' : '' }} {{ $readonly ? 'bg-gray-50' : '' }} {{ $class }}"
            {{ $attributes }}
        >{{ old($name, $value) }}</textarea>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200 {{ $disabled ? 'bg-gray-50 text-gray-500' : '' }} {{ $readonly ? 'bg-gray-50' : '' }} {{ $class }}"
            {{ $attributes }}
        />
    @endif

    {{-- Help Text --}}
    @if($help)
        <p class="text-xs text-gray-500">{{ $help }}</p>
    @endif

    {{-- Error Message --}}
    @if($error || $errors->has($name))
        <p class="text-sm text-red-600">
            {{ $error ?: $errors->first($name) }}
        </p>
    @endif
</div>