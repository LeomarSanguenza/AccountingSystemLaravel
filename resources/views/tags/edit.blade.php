@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Tag</h1>

    <form action="{{ route('tags.update', $tag->tags_id) }}" method="POST" class="space-y-4">
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
        <a href="{{ route('tags.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
