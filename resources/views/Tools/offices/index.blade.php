@extends('layout')

@section('content')

<x-index-layout 
    title="Offices"
    subtitle="Manage office information and codes"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Offices']
    ]"
    :create-route="route('tools.offices.create')"
    create-text="New Office">
    
    <x-data-table 
        :headers="[
            ['label' => 'Office Name', 'class' => 'min-w-48'],
            ['label' => 'Office Code', 'class' => 'w-32'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No offices found."
        searchable>
        
        @foreach($offices as $office)
            @include('Tools.offices.partials.table-row', compact('office'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
