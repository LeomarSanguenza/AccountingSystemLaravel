@extends('layout')

@section('content')

<x-form-layout 
    title="Edit User"
    subtitle="Update user account information and permissions"
    :breadcrumbs="[
        ['label' => 'Users', 'url' => route('user.index')],
        ['label' => $user->FirstName . ' ' . $user->LastName]
    ]">
    
    <form action="{{ route('users.update', $user->UserID) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form-field 
                label="First Name"
                name="FirstName"
                :value="$user->FirstName"
                placeholder="Enter first name"
                required />
            
            <x-form-field 
                label="Last Name"
                name="LastName"
                :value="$user->LastName"
                placeholder="Enter last name"
                required />
            
            <x-form-field 
                label="Username"
                name="Username"
                :value="$user->Username"
                placeholder="Enter username"
                help="Username must be unique"
                required />
            
            <x-form-field 
                label="Password"
                name="Password"
                type="password"
                placeholder="Enter new password"
                help="Leave blank to keep current password" />
            
            <x-form-field 
                label="User Role"
                name="UserRole"
                type="select"
                :value="$user->UserRole"
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
                :value="$user->fund_type"
                :options="$fundtypes->pluck('description', 'id')->toArray()"
                placeholder="-- Select Fund Type --"
                required />
        </div>

        <x-form-actions 
            submit-text="Update User"
            :cancel-url="route('user.index')" />
    </form>
</x-form-layout>

@endsection
