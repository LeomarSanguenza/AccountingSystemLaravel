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

        <span class="text-gray-700 font-semibold">Tags
        </span>
    </div>
    <h1 class="text-2xl font-bold mb-4">Edit Tag</h1>

    <form action="{{ route('tools.tags.update', $tag->tags_id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Description</label>
            <input type="text" name="description" value="{{ $tag->description }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Journal Type</label>
            <select name="journal_type" class="w-full border rounded p-2" required>
                <option {{ $tag->journal_type == 'Cash Disbursement Journal' ? 'selected' : '' }}>Cash Disbursement Journal</option>
                <option {{ $tag->journal_type == 'Check Disbursement Journal' ? 'selected' : '' }}>Check Disbursement Journal</option>
                <option {{ $tag->journal_type == 'General Journal' ? 'selected' : '' }}>General Journal</option>
                <option {{ $tag->journal_type == 'Debit Account Journal' ? 'selected' : '' }}>Debit Account Journal</option>
                <option {{ $tag->journal_type == 'Cash Check Receipt Journal' ? 'selected' : '' }}>Cash Check Receipt Journal</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Fund Type</label>
            <select name="fundtype" class="w-full border rounded p-2">
                <option value="">All</option>
                @foreach($fundtypes as $fund)
                    <option value="{{ $fund->id }}" {{ $tag->fundtype == $fund->id ? 'selected' : '' }}>
                        {{ $fund->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('tools.tags.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
