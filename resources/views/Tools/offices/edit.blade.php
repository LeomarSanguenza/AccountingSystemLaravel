@extends('layout')

@section('content')

<x-form-layout 
    title="Edit Office"
    subtitle="Update office information"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Offices', 'url' => route('tools.offices.index')],
        ['label' => $office->office_name]
    ]">
    
    <form action="{{ route('tools.offices.update', $office->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form-field 
                label="Office Name"
                name="office_name"
                :value="$office->office_name"
                placeholder="Enter office name"
                required />
            
            <x-form-field 
                label="Office Code"
                name="office_code"
                :value="$office->office_code"
                placeholder="Enter office code"
                required />
        </div>

        <x-form-actions 
            submit-text="Update Office"
            :cancel-url="route('tools.offices.index')" />
    </form>
</x-form-layout>

@endsection
