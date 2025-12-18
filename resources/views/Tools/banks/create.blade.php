@extends('layout')

@section('content')

<x-form-layout 
    title="New Bank"
    subtitle="Add a new bank to the system"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Banks', 'url' => route('tools.banks.index')],
        ['label' => 'Create New']
    ]">
    
    <form action="{{ route('tools.banks.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form-field 
                label="Bank Name"
                name="bank_name"
                placeholder="Enter bank name"
                required />
            
            <x-form-field 
                label="Bank Code"
                name="bank_code"
                placeholder="Enter bank code"
                required />
            
            <x-form-field 
                label="Bank Key"
                name="bank_key"
                placeholder="Enter bank key" />
            
            <div class="md:col-span-2">
                <x-form-field 
                    label="Bank Address"
                    name="bank_address"
                    type="textarea"
                    :rows="3"
                    placeholder="Enter bank address" />
            </div>
        </div>

        <x-form-actions 
            submit-text="Create Bank"
            :cancel-url="route('tools.banks.index')" />
    </form>
</x-form-layout>

@endsection
