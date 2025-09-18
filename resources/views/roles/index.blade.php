@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Roles</h1>

    <a href="{{ route('roles.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">New Role</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Permissions</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td class="border px-4 py-2">{{ $role->name }}</td>
                    <td class="border px-4 py-2">
                        @foreach($role->permissions as $perm)
                            <span class="bg-gray-200 text-sm px-2 py-1 rounded">{{ $perm->name }}</span>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2" onclick="return confirm('Delete this role?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
