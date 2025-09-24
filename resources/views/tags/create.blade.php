@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">New Tag</h1>

    <form action="{{ route('tags.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-medium">Description</label>
        <input type="text" name="description" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Journal Type</label>
        <select name="journal_type" class="w-full border rounded p-2" required>
            <option value="">-- Select Journal Type --</option>
            <option>Cash Disbursement Journal</option>
            <option>Check Disbursement Journal</option>
            <option>General Journal</option>
            <option>Debit Account Journal</option>
            <option>Cash Check Receipt Journal</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Fund Type</label>
        <select name="fundtype" class="w-full border rounded p-2">
            <option value="">All</option>
            @foreach($fundtypes as $fund)
                <option value="{{ $fund->id }}">{{ $fund->description }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('tags.index') }}" class="text-gray-600 px-4 py-2 rounded border">Cancel</a>
    </div>
</form>

</div>
@endsection
