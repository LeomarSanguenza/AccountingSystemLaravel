{{-- resources/views/journal_headers/create.blade.php --}}
@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Create Journal Entry</h1>

    <form action="{{ route('journals.store') }}" method="POST">
        @csrf

        {{-- Journal Header Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium mb-1">Journal Entry No</label>
                <input type="text" name="journal_entry_no" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Voucher No</label>
                <input type="text" name="voucher_no" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Series</label>
                <input type="text" name="series" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Office</label>
                <select name="office_id" class="w-full border rounded px-3 py-2">
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Expense Type</label>
                <select name="expens_type" class="w-full border rounded px-3 py-2">
                    @foreach($expenseTypes as $exp)
                        <option value="{{ $exp->id }}">{{ $exp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Entry Date</label>
                <input type="date" name="entrydate" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        {{-- Journal Details Section --}}
        <h2 class="text-xl font-semibold mb-3">Journal Details</h2>
        <table class="w-full border rounded mb-4" id="details-table">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Account Code</th>
                    <th class="p-2 border">Explanation</th>
                    <th class="p-2 border">Debit</th>
                    <th class="p-2 border">Credit</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2 border">
                        <input type="text" name="details[0][account_code]" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="p-2 border">
                        <input type="text" name="details[0][explaination]" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="p-2 border">
                        <input type="number" step="0.01" name="details[0][debit_amount]" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="p-2 border">
                        <input type="number" step="0.01" name="details[0][credit_amount]" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="p-2 border text-center">
                        <button type="button" class="text-red-500 hover:underline remove-row">✕</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="add-row" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 hover:bg-blue-600">+ Add Row</button>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('journals.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
        </div>
    </form>
</div>

<script>
    let rowIdx = 1;

    document.getElementById('add-row').addEventListener('click', function() {
        const tableBody = document.querySelector('#details-table tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td class="p-2 border">
                <input type="text" name="details[${rowIdx}][account_code]" class="w-full border rounded px-2 py-1">
            </td>
            <td class="p-2 border">
                <input type="text" name="details[${rowIdx}][explaination]" class="w-full border rounded px-2 py-1">
            </td>
            <td class="p-2 border">
                <input type="number" step="0.01" name="details[${rowIdx}][debit_amount]" class="w-full border rounded px-2 py-1">
            </td>
            <td class="p-2 border">
                <input type="number" step="0.01" name="details[${rowIdx}][credit_amount]" class="w-full border rounded px-2 py-1">
            </td>
            <td class="p-2 border text-center">
                <button type="button" class="text-red-500 hover:underline remove-row">✕</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        rowIdx++;
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
