@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow">

    <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Banks</span>
    </div>
    <h1 class="text-2xl font-bold mb-4">Edit Bank</h1>

    <form action="{{ route('tools.banks.update', $bank->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Bank Name</label>
            <input type="text" name="bank_name" value="{{ old('bank_name', $bank->bank_name) }}" class="w-full border px-3 py-2 rounded">
            @error('bank_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Bank Code</label>
            <input type="text" name="bank_code" value="{{ old('bank_code', $bank->bank_code) }}" class="w-full border px-3 py-2 rounded">
            @error('bank_code') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Bank Key</label>
            <input type="text" name="bank_key" value="{{ old('bank_key', $bank->bank_key) }}" class="w-full border px-3 py-2 rounded">
            @error('bank_key') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Bank Address</label>
            <input type="text" name="bank_address" value="{{ old('bank_address', $bank->bank_address) }}" class="w-full border px-3 py-2 rounded">
            @error('bank_address') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('tools.banks.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
