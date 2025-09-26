@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">New Signatory</h1>

    <form action="{{ route('signatories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Office</label>
            <input type="text" name="office" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Position</label>
            <input type="text" name="position" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Designation</label>
            <input type="text" name="designation" class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('signatories.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
