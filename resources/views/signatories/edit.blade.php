@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Signatory</h1>

    <form action="{{ route('signatories.update', $signatory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Name</label>
            <input type="text" name="name" value="{{ $signatory->name }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Office</label>
            <input type="text" name="office" value="{{ $signatory->office }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Position</label>
            <input type="text" name="position" value="{{ $signatory->position }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Designation</label>
            <input type="text" name="designation" value="{{ $signatory->designation }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('signatories.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
