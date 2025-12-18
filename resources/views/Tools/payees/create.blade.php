@extends('layout')

@section('content')

<x-form-layout 
    title="New Payee"
    subtitle="Add a new payee to the system"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Payees', 'url' => route('tools.payees.index')],
        ['label' => 'Create New']
    ]">
    
    <form action="{{ route('tools.payees.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <x-form-field 
            label="Payee Name"
            name="payee_name"
            placeholder="Enter payee name"
            required />

        <x-form-actions 
            submit-text="Create Payee"
            :cancel-url="route('tools.payees.index')" />
    </form>
</x-form-layout>

@endsection
