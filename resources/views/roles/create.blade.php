@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Create Role</h1>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <label class="block mb-2">Role Name</label>
        <input type="text" name="name" class="border p-2 w-full mb-4" required>

        <h3 class="font-semibold mb-2">Assign Permissions</h3>
        <div class="grid grid-cols-2 gap-2">
            @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                    <label>{{ ucfirst($permission->name) }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Save</button>
    </form>
</div>
@endsection
