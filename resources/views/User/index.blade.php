@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-semibold mb-6">Users List</h2>

    <a href="{{ route('users.create') }}" 
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded mb-4">
        Add User
    </a>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Firstname</th>
                    <th class="px-4 py-2">Lastname</th>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $user->UserID }}</td>
                    <td class="px-4 py-2">{{ $user->FirstName }}</td>
                    <td class="px-4 py-2">{{ $user->LastName }}</td>
                    <td class="px-4 py-2">{{ $user->Username }}</td>
                    <td class="px-4 py-2">{{ $user->UserRole }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('users.edit', $user->UserID) }}" 
                           class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                            Edit
                        </a>
                        <form action="{{ route('users.destroy', $user->UserID) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                onclick="return confirm('Delete this user?')" 
                                class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
