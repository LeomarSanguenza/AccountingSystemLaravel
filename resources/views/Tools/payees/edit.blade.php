@extends('layout')

@section('content')

<x-form-layout 
    title="Edit Payee"
    subtitle="Update payee information"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Payees', 'url' => route('tools.payees.index')],
        ['label' => $payee->payee_name]
    ]">
    
    <form action="{{ route('tools.payees.update', $payee->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <x-form-field 
            label="Payee Name"
            name="payee_name"
            :value="$payee->payee_name"
            placeholder="Enter payee name"
            required />

        <x-form-actions 
            submit-text="Update Payee"
            :cancel-url="route('tools.payees.index')" />
    </form>
</x-form-layout>

@endsection
