@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Office</h1>

    <form action="{{ route('offices.update', $office->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Office Name</label>
            <input type="text" name="office_name" value="{{ $office->office_name }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Office Code</label>
            <input type="text" name="office_code" value="{{ $office->office_code }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('offices.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
