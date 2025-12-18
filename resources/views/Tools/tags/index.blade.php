@extends('layout')

@section('content')

<x-index-layout 
    title="Tags"
    subtitle="Manage journal tags and fund type associations"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Tags']
    ]"
    :create-route="route('tools.tags.create')"
    create-text="New Tag">
    
    <x-data-table 
        :headers="[
            ['label' => 'Description', 'class' => 'min-w-48'],
            ['label' => 'Journal Type', 'class' => 'w-32'],
            ['label' => 'Fund Type', 'class' => 'min-w-32'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No tags found."
        searchable>
        
        @foreach($tags as $tag)
            @include('Tools.tags.partials.table-row', compact('tag'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
