@extends('layout')

@section('content')

<x-index-layout 
    title="Roles"
    subtitle="Manage user roles and their permissions"
    :breadcrumbs="[
        ['label' => 'Tools', 'url' => route('tools.index')],
        ['label' => 'Roles']
    ]"
    :create-route="route('tools.roles.create')"
    create-text="New Role">
    
    <x-data-table 
        :headers="[
            ['label' => 'Role Name', 'class' => 'min-w-32'],
            ['label' => 'Permissions', 'class' => 'min-w-64'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        empty-message="No roles found."
        searchable>
        
        @foreach($roles as $role)
            @include('Tools.roles.partials.table-row', compact('role'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
