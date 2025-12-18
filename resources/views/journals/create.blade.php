@extends('layout')

@section('content')

<x-form-layout 
    title="Create Journal Entry"
    subtitle="Create a new journal entry for accounting records"
    :breadcrumbs="[
        ['label' => 'Journals', 'url' => route('journals.index')],
        ['label' => 'Create New']
    ]"
    max-width="max-w-6xl">
    
    <form action="{{ route('journals.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Journal Header Section --}}
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Journal Header Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <x-form-field 
                    label="Journal Entry No"
                    name="journal_entry_no"
                    placeholder="Enter journal entry number"
                    required />
                
                <x-form-field 
                    label="Voucher No"
                    name="voucher_no"
                    placeholder="Enter voucher number" />
                
                <x-form-field 
                    label="Series"
                    name="series"
                    placeholder="Enter series" />
                
                <x-form-field 
                    label="Office"
                    name="office_id"
                    type="select"
                    :options="$offices"
                    placeholder="-- Select Office --" />
                
                <x-form-field 
                    label="Expense Type"
                    name="expens_type"
                    type="select"
                    :options="$expenseTypes"
                    placeholder="-- Select Expense Type --" />
                
                <x-form-field 
                    label="Entry Date"
                    name="entrydate"
                    type="date" />
                
                <div class="lg:col-span-2">
                    <x-form-field 
                        label="Particulars"
                        name="particulars"
                        placeholder="Enter particulars" />
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @if(Auth::check() && Auth::user()->fundTypeRelation)
                    <x-form-field 
                        label="Fund Type"
                        name="fundtype_display"
                        :value="Auth::user()->fundTypeRelation->code . ' - ' . Auth::user()->fundTypeRelation->description"
                        disabled />
                    <input type="hidden" name="fundtype" value="{{ Auth::user()->fundTypeRelation->code }}">
                @else
                    <x-form-field 
                        label="Fund Type"
                        name="fundtype"
                        placeholder="Enter fund type" />
                @endif
                
                <x-form-field 
                    label="Journal Type"
                    name="journal_type"
                    type="select"
                    :options="[
                        'General' => 'General',
                        'Check' => 'Check',
                        'Cash' => 'Cash'
                    ]"
                    class="journal-type-select" />
                
                <x-form-field 
                    label="Check Number"
                    name="check_number"
                    placeholder="Enter check number"
                    container-class="check-field hidden" />
                
                <x-form-field 
                    label="Bank"
                    name="bank"
                    placeholder="Enter bank"
                    container-class="check-field hidden" />
            </div>
        </div>

        {{-- Journal Details Section --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Journal Details</h3>
                <button type="button" id="add-row" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Row
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full" id="details-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Account Code</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Explanation</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Debit</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Credit</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-16">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border-b border-gray-200">
                                <select name="details[0][account_code]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Select Account Code --</option>
                                    @foreach ($accounts as $code => $desc)
                                        <option value="{{ $code }}">{{ $code }} - {{ $desc }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-3 border-b border-gray-200">
                                <input type="text" name="details[0][explaination]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Enter explanation">
                            </td>
                            <td class="px-4 py-3 border-b border-gray-200">
                                <input type="number" step="0.01" name="details[0][debit_amount]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" placeholder="0.00">
                            </td>
                            <td class="px-4 py-3 border-b border-gray-200">
                                <input type="number" step="0.01" name="details[0][credit_amount]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" placeholder="0.00">
                            </td>
                            <td class="px-4 py-3 border-b border-gray-200 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-row p-1 rounded-md hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <x-form-actions 
            submit-text="Create Journal Entry"
            :cancel-url="route('journals.index')" />
    </form>
</x-form-layout>

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
    document.addEventListener('DOMContentLoaded', function() {
        const journalTypeSelect = document.querySelector('select[name="journal_type"]');
        const checkFields = document.querySelectorAll('.check-field');
        const checkNumberInput = document.querySelector('input[name="check_number"]');
        const bankInput = document.querySelector('input[name="bank"]');

        function toggleCheckFields() {
            const show = journalTypeSelect.value === 'Check';
            checkFields.forEach(field => {
                field.classList.toggle('hidden', !show);
            });

            if (checkNumberInput) checkNumberInput.required = show;
            if (bankInput) bankInput.required = show;
        }

        if (journalTypeSelect) {
            toggleCheckFields(); // run on load
            journalTypeSelect.addEventListener('change', toggleCheckFields);
        }
    });
</script>
@endsection
