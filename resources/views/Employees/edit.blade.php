@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit Employee</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->EmpID) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">First Name</label>
            <input type="text" name="FirstName" value="{{ old('FirstName', $employee->FirstName) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Last Name</label>
            <input type="text" name="LastName" value="{{ old('LastName', $employee->LastName) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Position</label>
            <input type="text" name="Position" value="{{ old('Position', $employee->Position) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Salary</label>
            <input type="number" name="Salary" value="{{ old('Salary', $employee->Salary) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Gender</label>
            <select name="Gender" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                <option value="Male" {{ old('Gender', $employee->Gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('Gender', $employee->Gender) == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Birthdate</label>
            <input type="date" name="Birthdate" value="{{ old('Birthdate', $employee->Birthdate) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                   required>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg">
                Update Employee
            </button>
            <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
