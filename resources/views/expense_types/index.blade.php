@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Expense Types</h1>

    <a href="{{ route('expense_types.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">New Expense Type</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenseTypes as $type)
                <tr>
                    <td class="border px-4 py-2">{{ $type->name }}</td>
                    <td class="border px-4 py-2">{{ $type->description }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('expense_types.edit', $type->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('expense_types.destroy', $type->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2" onclick="return confirm('Delete this type?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
