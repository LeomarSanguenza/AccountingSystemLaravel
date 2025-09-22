@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow mt-6">
    <h2 class="text-2xl font-bold mb-6">Create Fund Type</h2>

    <form action="{{ route('fundtypes.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Description</label>
            <input type="text" name="description" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200"
                   value="{{ old('description') }}">
        </div>

        <div>
            <label class="block font-medium">Code <span class="text-red-500">*</span></label>
            <input type="text" name="code" required
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200"
                   value="{{ old('code') }}">
        </div>

        <div>
            <label class="block font-medium">Alias</label>
            <input type="text" name="alias" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200"
                   value="{{ old('alias') }}">
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Save
            </button>
            <a href="{{ route('fundtypes.index') }}" 
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                Back
            </a>
        </div>
    </form>
</div>
@endsection
