@extends('layout')

@section('content')

<x-index-layout 
    title="Payees"
    subtitle="Manage payee information and records"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Payees']
    ]"
    :create-route="route('tools.payees.create')"
    create-text="New Payee">
    
    <x-data-table 
        :headers="[
            ['label' => 'Payee Name', 'class' => 'min-w-64'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No payees found."
        searchable>
        
        @foreach($payees as $payee)
            @include('Tools.payees.partials.table-row', compact('payee'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
