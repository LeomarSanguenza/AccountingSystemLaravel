@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Journal Entry Details</h2>
        <div class="flex gap-2">
            <a href="{{ route('journals.edit', $journal->hdr_id) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">
                Edit Journal
            </a>
            <a href="{{ route('journals.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                Back to List
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <!-- Header Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Journal Information</h3>
                <div class="space-y-2">
                    <div><strong>Entry No:</strong> {{ $journal->journal_entry_no }}</div>
                    <div><strong>Voucher No:</strong> {{ $journal->voucher_no }}</div>
                    <div><strong>Series:</strong> {{ $journal->series }}</div>
                    <div><strong>Entry Date:</strong> {{ $journal->entrydate }}</div>
                    <div><strong>Journal Type:</strong> {{ $journal->journal_type }}</div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Financial Details</h3>
                <div class="space-y-2">
                    <div><strong>Debit Total:</strong> ₱{{ number_format($journal->debit_total, 2) }}</div>
                    <div><strong>Credit Total:</strong> ₱{{ number_format($journal->credit_total, 2) }}</div>
                    <div><strong>Fund Type:</strong> {{ $journal->fundtype }}</div>
                    <div><strong>Obligation No:</strong> {{ $journal->obligation_no }}</div>
                </div>
            </div>
        </div>

        <!-- Particulars -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Particulars</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                {{ $journal->particulars }}
            </div>
        </div>

        <!-- Journal Details -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Journal Details</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 border">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-2 border">Account Code</th>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border text-right">Debit</th>
                            <th class="px-4 py-2 border text-right">Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($journal->details as $detail)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $detail->account_code }}</td>
                            <td class="px-4 py-2 border">{{ $detail->description }}</td>
                            <td class="px-4 py-2 border text-right">
                                @if($detail->debit)
                                    ₱{{ number_format($detail->debit, 2) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2 border text-right">
                                @if($detail->credit)
                                    ₱{{ number_format($detail->credit, 2) }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500 border">
                                No journal details found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-100 font-semibold">
                        <tr>
                            <td colspan="2" class="px-4 py-2 border text-right">Totals:</td>
                            <td class="px-4 py-2 border text-right">₱{{ number_format($journal->debit_total, 2) }}</td>
                            <td class="px-4 py-2 border text-right">₱{{ number_format($journal->credit_total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection