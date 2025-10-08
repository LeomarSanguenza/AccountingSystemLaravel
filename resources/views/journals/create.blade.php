{{-- resources/views/journal_headers/create.blade.php --}}
@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Create Journal Entry</h1>

    <form action="{{ route('journals.store') }}" method="POST">
        @csrf

        {{-- Journal Header Section --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- 1 -->
            <div>
                <label class="block text-sm font-medium mb-1">Journal Entry No</label>
                <input type="text" name="journal_entry_no" value="{{ old('journal_entry_no') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- 2 -->
            <div>
                <label class="block text-sm font-medium mb-1">Voucher No</label>
                <input type="text" name="voucher_no" value="{{ old('voucher_no') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- 3 -->
            <div>
                <label class="block text-sm font-medium mb-1">Series</label>
                <input type="text" name="series" value="{{ old('series') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- 4 -->
            <div>
                <label class="block text-sm font-medium mb-1">Office</label>
                <select name="office_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Office --</option>
                    @foreach($offices as $id => $name)
                        <option value="{{ $id }}" {{ old('office_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 5 -->
            <div>
                <label class="block text-sm font-medium mb-1">Expense Type</label>
                <select name="expens_type" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Expense Type --</option>
                    @foreach($expenseTypes as $id => $name)
                        <option value="{{ $id }}" {{ old('expens_type') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 6 -->
            <div>
                <label class="block text-sm font-medium mb-1">Entry Date</label>
                <input type="date" name="entrydate" value="{{ old('entrydate') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- 7 -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Particulars</label>
                <input type="text" name="particulars" value="{{ old('particulars') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- 8 Fund Type (show as disabled + hidden input if user has relation) -->
            <div>
                <label class="block text-sm font-medium mb-1">Fund Type</label>
                @if(Auth::check() && Auth::user()->fundTypeRelation)
                    <input type="text"
                           class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700"
                           value="{{ Auth::user()->fundTypeRelation->code }} - {{ Auth::user()->fundTypeRelation->description }}"
                           disabled>
                    <input type="hidden" name="fundtype"
                           value="{{ Auth::user()->fundTypeRelation->code }}">
                @else
                    <input type="text" name="fundtype" value="{{ old('fundtype') }}"
                           class="w-full border rounded px-3 py-2">
                @endif
            </div>

            {{-- Journal Type + Check Number + Bank as one full-row block --}}
            <div class="md:col-span-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <!-- Journal Type -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Journal Type</label>
                        <select id="journal_type" name="journal_type" class="w-full border rounded px-3 py-2">
                            <option value="General" {{ old('journal_type') == 'General' ? 'selected' : '' }}>General</option>
                            <option value="Check"   {{ old('journal_type') == 'Check'   ? 'selected' : '' }}>Check</option>
                            <option value="Cash"    {{ old('journal_type') == 'Cash'    ? 'selected' : '' }}>Cash</option>
                        </select>
                    </div>

                    <!-- Check Number (hidden unless Check selected) -->
                    <div id="check_number_wrapper" class="hidden">
                        <label class="block text-sm font-medium mb-1">Check Number</label>
                        <input type="text" id="check_number" name="check_number"
                               value="{{ old('check_number') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Bank (hidden unless Check selected) -->
                    <div id="bank_wrapper" class="hidden">
                        <label class="block text-sm font-medium mb-1">Bank</label>
                        <input type="text" id="bank" name="bank" value="{{ old('bank') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>
            </div>
        </div> {{-- end header grid --}}

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
                        <select name="details[0][account_code]" class="w-full border rounded px-2 py-1">
                            <option value="">-- Select Account Code --</option>
                            @foreach ($accounts as $code => $desc)
                                <option value="{{ $code }}">{{ $code }} - {{ $desc }}</option>
                            @endforeach
                        </select>
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
    // dynamic rows
    let rowIdx = 1;
    document.getElementById('add-row').addEventListener('click', function () {
        const tableBody = document.querySelector('#details-table tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td class="p-2 border">
                <select name="details[${rowIdx}][account_code]" class="w-full border rounded px-2 py-1">
                    <option value="">-- Select Account Code --</option>
                    @foreach ($accounts as $code => $desc)
                        <option value="{{ $code }}">{{ $code }} - {{ $desc }}</option>
                    @endforeach
                </select>
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

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    // toggle check fields
    (function () {
        const journalType = document.getElementById('journal_type');
        const checkNumberWrapper = document.getElementById('check_number_wrapper');
        const bankWrapper = document.getElementById('bank_wrapper');
        const checkNumberInput = document.getElementById('check_number');
        const bankInput = document.getElementById('bank');

        if (!journalType) return;

        function toggleCheckFields() {
            const show = journalType.value === 'Check';
            checkNumberWrapper.classList.toggle('hidden', !show);
            bankWrapper.classList.toggle('hidden', !show);

            if (checkNumberInput) checkNumberInput.required = show;
            if (bankInput) bankInput.required = show;
        }

        // run on load and on change
        document.addEventListener('DOMContentLoaded', toggleCheckFields);
        journalType.addEventListener('change', toggleCheckFields);
    })();
</script>
@endsection
