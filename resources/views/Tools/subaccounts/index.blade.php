@extends('layout')

@section('content')

<x-index-layout 
    title="Sub Accounts"
    subtitle="Manage sub account codes and their parent accounts"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Sub Accounts']
    ]"
    :create-route="route('tools.subaccounts.create')"
    create-text="New Sub Account">
    
    <x-data-table 
        :headers="[
            ['label' => 'Sub Code', 'class' => 'w-32'],
            ['label' => 'Description', 'class' => 'min-w-48'],
            ['label' => 'Parent Account', 'class' => 'min-w-32'],
            ['label' => 'Status', 'class' => 'w-24'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No sub accounts found."
        searchable>
        
        @foreach($subAccounts as $sub)
            @include('Tools.subaccounts.partials.table-row', compact('sub'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
