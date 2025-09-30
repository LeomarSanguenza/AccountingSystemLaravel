@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">
     <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Roles
        </span>
    </div>
    <h1 class="text-2xl font-bold mb-4">Edit Role</h1>

    <form action="{{ route('tools.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Role Name</label>
        <input type="text" name="name" value="{{ $role->name }}" class="border p-2 w-full mb-4" required>

        <h3 class="font-semibold mb-2">Permissions</h3>
        <div class="grid grid-cols-2 gap-2">
            @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                           {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                    <label>{{ ucfirst($permission->name) }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Update</button>
    </form>
</div>
@endsection
