@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Journal Entries</h2>
        <a href="{{ route('journals.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + New Journal
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                    <th class="px-4 py-2">Entry No</th>
                    <th class="px-4 py-2">Voucher No</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Particulars</th>
                    <th class="px-4 py-2">Details</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($journals as $journal)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $journal->journal_entry_no }}</td>
                    <td class="px-4 py-2">{{ $journal->voucher_no }}</td>
                    <td class="px-4 py-2">{{ $journal->entrydate }}</td>
                    <td class="px-4 py-2">{{ Str::limit($journal->particulars, 40) }}</td>
                    <td class="px-4 py-2">{{ $journal->details_count }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('journals.edit', $journal->hdr_id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('journals.destroy', $journal->hdr_id) }}" method="POST" 
                              onsubmit="return confirm('Delete this journal?')">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                        No journal entries found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $journals->links() }}
    </div>
</div>
@endsection
