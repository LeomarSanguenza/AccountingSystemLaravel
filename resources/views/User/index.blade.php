@extends('layout')

@section('content')

<x-index-layout 
    title="Users Management"
    subtitle="Manage system users, roles, and permissions"
    :create-route="route('users.create')"
    create-text="Add User">
    
    <x-data-table 
        :headers="[
            ['label' => 'ID', 'class' => 'w-16'],
            ['label' => 'Name', 'class' => 'min-w-48'],
            ['label' => 'Username', 'class' => 'w-32'],
            ['label' => 'Role', 'class' => 'w-32'],
            ['label' => 'Fund Type', 'class' => 'w-48'],
            ['label' => 'Actions', 'class' => 'w-32']
        ]"
        :rows="$users->map(function($user) {
            return view('User.partials.table-row', compact('user'))->render();
        })"
        empty-message="No users found."
        searchable />
        
</x-index-layout>

@endsection
