@extends('layout')

@section('content')

<x-index-layout 
    title="Barangays"
    subtitle="Manage barangay information and codes"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Barangays']
    ]"
    :create-route="route('tools.barangays.create')"
    create-text="New Barangay">
    
    <x-data-table 
        :headers="[
            ['label' => 'Barangay Name', 'class' => 'min-w-48'],
            ['label' => 'Code', 'class' => 'w-32'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No barangays found."
        searchable>
        
        @foreach($barangays as $barangay)
            @include('Tools.barangay.partials.table-row', compact('barangay'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
