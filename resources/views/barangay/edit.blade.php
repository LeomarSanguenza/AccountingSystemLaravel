@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Barangay</h1>

    <form action="{{ route('barangays.update', $barangay->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Barangay Name</label>
            <input type="text" name="barangay_name" value="{{ old('barangay_name', $barangay->barangay_name) }}" class="w-full border px-3 py-2 rounded">
            @error('barangay_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Barangay Code</label>
            <input type="text" name="barangay_code" value="{{ old('barangay_code', $barangay->barangay_code) }}" class="w-full border px-3 py-2 rounded">
            @error('barangay_code') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('barangays.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
