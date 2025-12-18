@extends('layout')

@section('content')

<x-index-layout 
    title="Banks"
    subtitle="Manage bank information and details"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Banks']
    ]"
    :create-route="route('tools.banks.create')"
    create-text="New Bank">
    
    <x-data-table 
        :headers="[
            ['label' => 'Bank Name', 'class' => 'min-w-48'],
            ['label' => 'Code', 'class' => 'w-32'],
            ['label' => 'Key', 'class' => 'w-32'],
            ['label' => 'Address', 'class' => 'min-w-64'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No banks found."
        searchable>
        
        @foreach($banks as $bank)
            @include('Tools.banks.partials.table-row', compact('bank'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
