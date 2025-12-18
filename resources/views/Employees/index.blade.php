@extends('layout')

@section('content')

<x-index-layout 
    title="Employees"
    subtitle="Manage employee records and information"
    :create-route="route('employees.create')"
    create-text="Add Employee"
    max-width="max-w-7xl">
    
    {{-- Additional Actions --}}
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center space-x-4">
            <a href="{{ route('employees.summary') }}" 
               class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Employee Summary
            </a>
        </div>
    </div>
    
    <x-data-table 
        :headers="[
            ['label' => 'ID', 'class' => 'w-20'],
            ['label' => 'Employee', 'class' => 'min-w-48'],
            ['label' => 'Position', 'class' => 'min-w-32'],
            ['label' => 'Salary', 'class' => 'w-32 text-right'],
            ['label' => 'Gender', 'class' => 'w-24'],
            ['label' => 'Birthdate', 'class' => 'w-32'],
            ['label' => 'Actions', 'class' => 'w-64']
        ]"
        empty-message="No employees found."
        searchable>
        
        @foreach($employees as $employee)
            @include('Employees.partials.table-row', compact('employee'))
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
