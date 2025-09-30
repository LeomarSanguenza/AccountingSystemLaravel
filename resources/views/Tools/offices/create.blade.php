@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow">
    <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Offices
        </span>
    </div>
    <h1 class="text-2xl font-bold mb-4">New Office</h1>

    <form action="{{ route('tools.offices.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Office Name</label>
            <input type="text" name="office_name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Office Code</label>
            <input type="text" name="office_code" class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('tools.offices.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
