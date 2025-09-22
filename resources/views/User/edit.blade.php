@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>

    <form action="{{ route('users.update', $user->UserID) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div>
            <label for="FirstName" class="block text-sm font-medium text-gray-700">First Name</label>
            <input 
                type="text" 
                name="FirstName" 
                id="FirstName" 
                class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                value="{{ old('FirstName', $user->FirstName) }}" 
                required
            >
        </div>

        <!-- Last Name -->
        <div>
            <label for="LastName" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input 
                type="text" 
                name="LastName" 
                id="LastName" 
                class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                value="{{ old('LastName', $user->LastName) }}" 
                required
            >
        </div>

        <!-- Username -->
        <div>
            <label for="Username" class="block text-sm font-medium text-gray-700">Username</label>
            <input 
                type="text" 
                name="Username" 
                id="Username" 
                class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                value="{{ old('Username', $user->Username) }}" 
                required
            >
        </div>

        <!-- Password -->
        <div>
            <label for="Password" class="block text-sm font-medium text-gray-700">Password</label>
            <input 
                type="password" 
                name="Password" 
                id="Password" 
                class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
            <p class="mt-1 text-xs text-gray-500">Leave blank if you do not want to change the password.</p>
        </div>

        <!-- User Role + Fund Type (side by side) -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="UserRole" class="block text-sm font-medium text-gray-700">User Role</label>
                <select 
                    name="UserRole" 
                    id="UserRole" 
                    class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="Admin" {{ old('UserRole', $user->UserRole) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="SystemController" {{ old('UserRole', $user->UserRole) == 'SystemController' ? 'selected' : '' }}>System Controller</option>
                    <option value="Employee" {{ old('UserRole', $user->UserRole) == 'Employee' ? 'selected' : '' }}>Employee</option>
                </select>
            </div>

            <div class="w-1/2">
                <label for="fund_type" class="block text-sm font-medium text-gray-700">Fund Type</label>
                <select 
                    name="fund_type" 
                    id="fund_type" 
                    class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                    required
                >
                    <option value="">-- Select Fund Type --</option>
                    @foreach($fundtypes as $fund)
                        <option value="{{ $fund->id }}" {{ old('fund_type', $user->fund_type) == $fund->id ? 'selected' : '' }}>
                            {{ $fund->description }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <button 
                type="submit" 
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Update
            </button>
        </div>
    </form>
</div>
@endsection
