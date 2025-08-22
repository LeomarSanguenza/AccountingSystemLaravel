@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Add Users</h2>
    
    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="FirstName" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" name="FirstName" id="FirstName" 
                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <div>
            <label for="LastName" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" name="LastName" id="LastName" 
                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <div>
            <label for="Username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="Username" id="Username" 
                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <div>
            <label for="Password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="Password" id="Password" 
                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <div>
            <label for="UserRole" class="block text-sm font-medium text-gray-700">User Role</label>
            <select name="UserRole" id="UserRole" 
                    class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="Admin">Admin</option>
                <option value="SystemController">System Controller</option>
                <option value="Employee">Employee</option>
            </select>
        </div>

        <div>
            <button type="submit" 
                    class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
