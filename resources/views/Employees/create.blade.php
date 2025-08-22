@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-6">Add Employee</h2>
    
    <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- First Name -->
        <div>
            <label for="FirstName" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" name="FirstName" id="FirstName"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <!-- Last Name -->
        <div>
            <label for="LastName" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" name="LastName" id="LastName"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <!-- Position -->
        <div>
            <label for="Position" class="block text-sm font-medium text-gray-700">Position</label>
            <input type="text" name="Position" id="Position"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <!-- Salary -->
        <div>
            <label for="Salary" class="block text-sm font-medium text-gray-700">Salary</label>
            <input type="number" name="Salary" id="Salary"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <!-- Gender -->
        <div>
            <label for="Gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select name="Gender" id="Gender"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Birthdate -->
        <div>
            <label for="Birthdate" class="block text-sm font-medium text-gray-700">Birthdate</label>
            <input type="date" name="Birthdate" id="Birthdate"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
