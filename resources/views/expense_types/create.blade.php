@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">New Expense Type</h1>

    <form action="{{ route('expense_types.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('expense_types.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
