@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow mt-6">
    <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Fund Types
        </span>
    </div>
    <h2 class="text-2xl font-bold mb-6">Edit Fund Type</h2>

    <form action="{{ route('tools.fundtypes.update', $fundtype->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Description</label>
            <input type="text" name="description" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   value="{{ old('description', $fundtype->description) }}">
        </div>

        <div>
            <label class="block font-medium">Code <span class="text-red-500">*</span></label>
            <input type="text" name="code" required
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   value="{{ old('code', $fundtype->code) }}">
        </div>

        <div>
            <label class="block font-medium">Alias</label>
            <input type="text" name="alias" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   value="{{ old('alias', $fundtype->alias) }}">
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update
            </button>
            <a href="{{ route('tools.fundtypes.index') }}" 
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                Back
            </a>
        </div>
    </form>
</div>
@endsection
