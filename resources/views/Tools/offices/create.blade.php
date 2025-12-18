@extends('layout')

@section('content')

<x-form-layout 
    title="New Office"
    subtitle="Add a new office to the system"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Offices', 'url' => route('tools.offices.index')],
        ['label' => 'Create New']
    ]">
    
    <form action="{{ route('tools.offices.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form-field 
                label="Office Name"
                name="office_name"
                placeholder="Enter office name"
                required />
            
            <x-form-field 
                label="Office Code"
                name="office_code"
                placeholder="Enter office code"
                required />
        </div>

        <x-form-actions 
            submit-text="Create Office"
            :cancel-url="route('tools.offices.index')" />
    </form>
</x-form-layout>

@endsection
