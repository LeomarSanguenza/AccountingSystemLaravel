@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Edit Journal Entry</h2>

    <form action="{{ route('journals.update', $header->hdr_id) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        <!-- Header -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Journal Header</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm text-gray-600">Journal Entry No</label>
                    <input type="text" name="journal_entry_no" 
                           value="{{ $header->journal_entry_no }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Voucher No</label>
                    <input type="text" name="voucher_no" 
                           value="{{ $header->voucher_no }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Entry Date</label>
                    <input type="date" name="entrydate" 
                           value="{{ $header->entrydate }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm text-gray-600">Particulars</label>
                <textarea name="particulars" rows="3"
                          class="w-full border-gray-300 rounded-lg shadow-sm">{{ $header->particulars }}</textarea>
            </div>
        </div>

        <!-- Details -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-gray-700">Journal Details</h3>
                <button type="button" id="addRow" 
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded shadow">
                    + Add Row
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-700 border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 border">Account Code</th>
                            <th class="px-3 py-2 border">Explanation</th>
                            <th class="px-3 py-2 border">Debit</th>
                            <th class="px-3 py-2 border">Credit</th>
                            <th class="px-3 py-2 border"></th>
                        </tr>
                    </thead>
                    <tbody id="detailsTable">
                        @foreach($header->details as $i => $detail)
                        <tr>
                            <td class="border px-2">
                                <input type="text" name="details[{{ $i }}][account_code]" 
                                       value="{{ $detail->account_code }}" 
                                       class="w-full border-gray-300 rounded">
                            </td>
                            <td class="border px-2">
                                <input type="text" name="details[{{ $i }}][explaination]" 
                                       value="{{ $detail->explaination }}" 
                                       class="w-full border-gray-300 rounded">
                            </td>
                            <td class="border px-2">
                                <input type="number" step="0.01" name="details[{{ $i }}][debit_amount]" 
                                       value="{{ $detail->debit_amount }}" 
                                       class="w-full border-gray-300 rounded">
                            </td>
                            <td class="border px-2">
                                <input type="number" step="0.01" name="details[{{ $i }}][credit_amount]" 
                                       value="{{ $detail->credit_amount }}" 
                                       class="w-full border-gray-300 rounded">
                            </td>
                            <td class="border px-2 text-center">
                                <button type="button" class="removeRow bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">
                                    ✕
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                Update Journal
            </button>
        </div>
    </form>
</div>

<script>
let rowIdx = {{ count($header->details) }};
document.getElementById('addRow').addEventListener('click', function () {
    let table = document.queryS
