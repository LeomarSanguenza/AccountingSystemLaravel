@extends('layout')

@section('content')

<x-form-layout 
    title="Add New Employee"
    subtitle="Create a new employee record"
    :breadcrumbs="[
        ['label' => 'Employees', 'url' => route('employees.index')],
        ['label' => 'Create New']
    ]">
    
    <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-gray-50 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
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
                    label="Gender"
                    name="Gender"
                    type="select"
                    :options="[
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other'
                    ]"
                    required />
                
                <x-form-field 
                    label="Birthdate"
                    name="Birthdate"
                    type="date"
                    required />
            </div>
        </div>
        
        <div class="bg-gray-50 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Employment Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-form-field 
                    label="Position"
                    name="Position"
                    placeholder="Enter position/job title"
                    required />
                
                <x-form-field 
                    label="Salary"
                    name="Salary"
                    type="number"
                    placeholder="Enter salary amount"
                    help="Enter monthly salary amount"
                    required />
            </div>
        </div>

        <x-form-actions 
            submit-text="Create Employee"
            :cancel-url="route('employees.index')" />
    </form>
</x-form-layout>

@endsection
