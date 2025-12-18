@extends('layout')

@section('content')

<x-form-layout 
    title="Add New User"
    subtitle="Create a new user account with role and fund type assignment"
    :breadcrumbs="[
        ['label' => 'Users', 'url' => route('user.index')],
        ['label' => 'Create New']
    ]">
    
    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form-field 
                label="First Name"
                name="FirstName"
                placeholder="Enter first name"
                required />
            
            <x-form-field 
                label="Last Name"
                name="LastName"
                placeholder="Enter last name"
                required />
            
            <x-form-field 
                label="Username"
                name="Username"
                placeholder="Enter username"
                help="Username must be unique"
                required />
            
            <x-form-field 
                label="Password"
                name="Password"
                type="password"
                placeholder="Enter password"
                help="Minimum 8 characters recommended"
                required />
            
            <x-form-field 
                label="User Role"
                name="UserRole"
                type="select"
                :options="[
                    'Admin' => 'Admin',
                    'SystemController' => 'System Controller',
                    'Employee' => 'Employee'
                ]"
                required />
            
            <x-form-field 
                label="Fund Type"
                name="fund_type"
                type="select"
                :options="$fundtypes->pluck('description', 'id')->toArray()"
                placeholder="-- Select Fund Type --"
                required />
        </div>

        <x-form-actions 
            submit-text="Create User"
            :cancel-url="route('user.index')" />
    </form>
</x-form-layout>

@endsection
