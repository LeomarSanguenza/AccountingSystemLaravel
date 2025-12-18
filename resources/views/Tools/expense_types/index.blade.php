@extends('layout')

@section('content')

<x-index-layout 
    title="Expense Types"
    subtitle="Manage expense type categories and descriptions"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Expense Types']
    ]"
    :create-route="route('tools.expense_types.create')"
    create-text="New Expense Type">
    
    <x-data-table 
        :headers="[
            ['label' => 'Name', 'class' => 'min-w-48'],
            ['label' => 'Description', 'class' => 'min-w-64'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No expense types found."
        searchable>
        
        @foreach($expenseTypes as $type)
            @include('Tools.expense_types.partials.table-row', compact('type'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
