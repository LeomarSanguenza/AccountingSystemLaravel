@extends('layout')

@section('content')

<x-index-layout 
    title="Fund Types"
    subtitle="Manage fund type categories, codes, and aliases"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Fund Types']
    ]"
    :create-route="route('tools.fundtypes.create')"
    create-text="New Fund Type">
    
    <x-data-table 
        :headers="[
            ['label' => 'ID', 'class' => 'w-16'],
            ['label' => 'Description', 'class' => 'min-w-48'],
            ['label' => 'Code', 'class' => 'w-32'],
            ['label' => 'Alias', 'class' => 'w-32'],
            ['label' => 'Actions', 'class' => 'w-48']
        ]"
        empty-message="No fund types found."
        searchable>
        
        @foreach($fundtypes as $fundtype)
            @include('Tools.FundTypes.partials.table-row', compact('fundtype'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
