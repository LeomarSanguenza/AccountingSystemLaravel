@extends('layout')

@section('content')

<x-index-layout 
    title="Signatories"
    subtitle="Manage authorized signatories and their designations"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Signatories']
    ]"
    :create-route="route('tools.signatories.create')"
    create-text="New Signatory">
    
    <x-data-table 
        :headers="[
            ['label' => 'Name', 'class' => 'min-w-48'],
            ['label' => 'Office', 'class' => 'min-w-32'],
            ['label' => 'Position', 'class' => 'min-w-32'],
            ['label' => 'Designation', 'class' => 'min-w-32'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No signatories found."
        searchable>
        
        @foreach($signatories as $sig)
            @include('Tools.signatories.partials.table-row', compact('sig'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
