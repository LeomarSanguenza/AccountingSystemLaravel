@extends('layout')
@section('content')

<x-form-layout 
    title="New Disbursement Voucher"
    subtitle="Create a new disbursement voucher for financial processing"
    :breadcrumbs="[
        ['label' => 'Disbursements', 'url' => route('disbursements.index')],
        ['label' => 'Create New']
    ]"
    max-width="max-w-7xl">
    
    <form action="{{ route('disbursements.store') }}" method="POST" class="space-y-6">
        @csrf
        {{-- HEADER SECTION --}}
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Voucher Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-field 
                    label="Date of Voucher"
                    name="date_of_voucher"
                    type="date"
                    required />
                
                <x-form-field 
                    label="Mode of Payment"
                    name="mode_of_payment"
                    type="select"
                    :options="[
                        'Check' => 'Check',
                        'Cash' => 'Cash', 
                        'Others' => 'Others'
                    ]"
                    required />
            </div>
        </div>
        {{-- VOUCHER DETAILS SECTION --}}
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Voucher Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <x-form-field 
                    label="Fund Type"
                    name="fund_type"
                    :value="$obr->fund_type_id ?? auth()->user()->fundtypeRelation->code . '-' . auth()->user()->fundtypeRelation->description"
                    disabled />
                
                <x-form-field 
                    label="DV Prefix"
                    name="dv_prefix"
                    :value="$dvPrefix ?? ''"
                    readonly />
                
                <x-form-field 
                    label="DV Number"
                    name="dv_number"
                    type="number"
                    :value="old('dv_number', $nextNumber ?? '')"
                    required />
            </div>
            
            <div class="grid grid-cols-1 gap-4">
                @if ($bmsoPayee)
                    <x-form-field 
                        label="Payee"
                        name="payee_display"
                        :value="$accountingPayee?->payee_name ?? $bmsoPayee->name"
                        readonly />
                    <input type="hidden" name="payee" value="{{ $accountingPayee?->id ?? '' }}">
                    <input type="hidden" name="bmso_payee_id" value="{{ $bmsoPayee->id }}">
                @else
                    <x-form-field 
                        label="Payee"
                        name="payee"
                        type="select"
                        :options="\App\Models\Payee::pluck('payee_name', 'id')->toArray()"
                        placeholder="-- Search Payee --"
                        class="payee-select"
                        required />
                @endif
            </div>
        </div>
        {{-- DISBURSEMENT DETAILS SECTION --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Disbursement Details</h3>
                <button type="button" id="addRow" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Row
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full" id="detailsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Account Code</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Sub Account</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Debit</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Credit</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-16">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(isset($obr) && $obr->entries->count())
                            @foreach ($obr->entries as $i => $entry)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <select name="details[{{ $i }}][account_codes]" class="account-code-dropdown w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">-- Select Account Code --</option>
                                            @foreach ($accountCodes as $code)
                                                <option value="{{ $code->full_code }}"
                                                    {{ $entry->account_code === $code->full_code ? 'selected' : '' }}>
                                                    {{ $code->full_code }} - {{ $code->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <input type="text" name="details[{{ $i }}][sub_account]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="">
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <input type="text" name="details[{{ $i }}][debit]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 amount-field debit text-right" value="{{ number_format($entry->amount, 2) }}">
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <input type="text" name="details[{{ $i }}][credit]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 amount-field credit text-right" value="0.00">
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 removeRow p-1 rounded-md hover:bg-red-50 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- fallback: preload 2 empty rows --}}
                            @for ($i = 0; $i < 2; $i++)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <select name="details[{{ $i }}][account_codes]" class="account-code-dropdown w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">-- Select Account Code --</option>
                                            @foreach ($accountCodes as $code)
                                                <option value="{{ $code->full_code }}">{{ $code->full_code }} - {{ $code->description }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <input type="text" name="details[{{ $i }}][sub_account]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <input type="text" name="details[{{ $i }}][debit]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 amount-field debit text-right" placeholder="0.00">
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <input type="text" name="details[{{ $i }}][credit]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 amount-field credit text-right" placeholder="0.00">
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 removeRow p-1 rounded-md hover:bg-red-50 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>

                    <tfoot class="bg-gray-100">
                        <tr>
                            <td colspan="2" class="px-4 py-3 text-right font-semibold text-gray-900 border-t border-gray-200">TOTAL</td>
                            <td class="px-4 py-3 text-right font-semibold text-gray-900 border-t border-gray-200" id="totalDebit">0.00</td>
                            <td class="px-4 py-3 text-right font-semibold text-gray-900 border-t border-gray-200" id="totalCredit">0.00</td>
                            <td class="px-4 py-3 border-t border-gray-200"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <x-form-actions 
            submit-text="Create Disbursement"
            :cancel-url="route('disbursements.index')" />
    </form>
</x-form-layout>

    {{-- JS for dynamic rows --}}
    <script>
        let rowCount = 2;

        // Add row
        function initSelect2(element) {
        $(element).select2({
            placeholder: "Search account code...",
            allowClear: true,
            width: '100%' // prevents width issues
        });
    }

    $(document).ready(function() {
        // init for preloaded dropdowns
        $('.account-code-dropdown').each(function() {
            initSelect2(this);
        });

        // Add row
        $('#addRow').on('click', function () {
            let table = $('#detailsTable tbody');
            let newRow = $(`
                <tr>
                    <td class="border p-2">
                        <select name="details[{{ $i }}][account_codes]" class="account-code-dropdown border p-1 w-full">
                            <option value="">-- Select Account Code --</option>
                            @foreach ($accountCodes as $code)
                            <option value="{{ $code->full_code }}"
                                {{ (isset($detail) && $detail->account_codes === $code->full_code) ? 'selected' : '' }}>
                                {{ $code->full_code }} - {{ $code->description }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="details[${rowCount}][sub_account]" class="border p-1 w-full"></td>
                    <td>
                        <input type="text" 
                                name="details[${rowCount}][debit]" 
                                class="border p-1 w-full amount-field debit" 
                                placeholder="0.00">
                        </td>
                    <td>
                        <input type="text" 
                            name="details[${rowCount}][credit]" 
                            class="border p-1 w-full amount-field credit" 
                            placeholder="0.00">
                    </td>

                    <td class="text-center"><button type="button" class="text-red-500 removeRow">✕</button></td>
                </tr>
            `);

            table.append(newRow);
            rowCount++;

            // only init Select2 for this new row
            initSelect2(newRow.find('.account-code-dropdown'));
        });
    });

        // Remove row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeRow')) {
                e.target.closest('tr').remove();
                calculateTotals();
            }
        });

        // Disable Credit if Debit entered, and vice versa
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('debit')) {
                let creditInput = e.target.closest('tr').querySelector('.credit');
                if (e.target.value !== '') {
                    creditInput.disabled = true;
                } else {
                    creditInput.disabled = false;
                }
            }
            if (e.target.classList.contains('credit')) {
                let debitInput = e.target.closest('tr').querySelector('.debit');
                if (e.target.value !== '') {
                    debitInput.disabled = true;
                } else {
                    debitInput.disabled = false;
                }
            }
            calculateTotals();
        });

        // Compute totals
        function calculateTotals() {
        let totalDebit = 0, totalCredit = 0;

        document.querySelectorAll('.debit').forEach(input => {
            // strip commas before turning into number
            const val = input.value.replace(/,/g, "");
            totalDebit += parseFloat(val) || 0;
        });

        document.querySelectorAll('.credit').forEach(input => {
            const val = input.value.replace(/,/g, "");
            totalCredit += parseFloat(val) || 0;
        });

        document.getElementById('totalDebit').innerText = totalDebit.toLocaleString(undefined, {
            minimumFractionDigits: 2, maximumFractionDigits: 2
        });
        document.getElementById('totalCredit').innerText = totalCredit.toLocaleString(undefined, {
            minimumFractionDigits: 2, maximumFractionDigits: 2
        });
    }

        function formatAmountField(input) {
            let value = input.value.replace(/,/g, ""); // strip commas

            // Only digits + optional decimal
            if (!/^\d*\.?\d*$/.test(value)) {
                value = value.slice(0, -1);
            }

            // Split integer and decimal
            let [integer, decimal] = value.split(".");

            // Limit integer to 9 digits
            if (integer && integer.length > 9) {
                integer = integer.slice(0, 9);
            }

            // Add commas
            if (integer) {
                integer = integer.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Max 2 decimals
            if (decimal) {
                decimal = decimal.slice(0, 2);
                input.value = integer + "." + decimal;
            } else {
                input.value = integer;
            }
        }

        // Event delegation (works for new rows too)
        document.addEventListener("input", function(e) {
            if (e.target.classList.contains("amount-field")) {
                formatAmountField(e.target);
            }
        });

        document.addEventListener("blur", function(e) {
            if (e.target.classList.contains("amount-field")) {
                let value = e.target.value.replace(/,/g, "");
                if (value === "" || isNaN(value)) {
                    value = "0.00";
                } else {
                    value = parseFloat(value).toFixed(2);
                }

                let [integer, decimal] = value.split(".");
                integer = integer.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                e.target.value = integer + "." + decimal;
            }
        }, true);

        let newRow = $(`
        <tr>
            <td>
                <select name="details[${rowCount}][account_code]" 
                    class="account-code-dropdown border p-1 w-full">
                    <option value="">-- Select Account Code --</option>
                    @foreach ($accountCodes as $code)
                        <option value="{{ $code->acct_code }}">
                            {{ $code->full_code }} - {{ $code->description }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="details[${rowCount}][sub_account]" class="border p-1 w-full"></td>
            <td><input type="text" name="details[${rowCount}][debit]" class="border p-1 w-full amount-field debit" placeholder="0.00"></td>
            <td><input type="text" name="details[${rowCount}][credit]" class="border p-1 w-full amount-field credit" placeholder="0.00"></td>
            <td class="text-center"><button type="button" class="text-red-500 removeRow">✕</button></td>
        </tr>
    `);

    // append to tbody
    $("#rows-container").append(newRow);

    // reinitialize select2 for new dropdown
    newRow.find(".account-code-dropdown").select2({
        placeholder: "Search account code",
        width: "100%"
    });

    </script>
    @endsection
    {{-- Include Select2 --}}
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Search account code...",
                allowClear: true
            });
        });

       document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#payee", {
                create: true, // allow typing a new payee if not in list
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                maxOptions: 1000, // increase search capacity
            });
        });
//dv number js
        document.addEventListener('DOMContentLoaded', function () {
            const prefixInput = document.getElementById('dv_prefix');
            const numberInput = document.getElementById('dv_number');
            const hiddenInput = document.getElementById('full_dv_number');

            function updateFullDV() {
                hiddenInput.value = `${prefixInput.value}-${numberInput.value.padStart(3, '0')}`;
            }

            numberInput.addEventListener('input', updateFullDV);
            updateFullDV();
        });
          $(document).ready(function () {
            // ✅ Only init Select2 for account-code-dropdowns
            $('.account-code-dropdown').each(function () {
                $(this).select2({
                    placeholder: "Search account code...",
                    allowClear: true,
                    width: '100%'
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            if (document.querySelector("#payee")) {
                new TomSelect("#payee", {
                    create: true,
                    sortField: { field: "text", direction: "asc" },
                    maxOptions: 1000
                });
            }
        });
    </script>
    @endpush
{{-- @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
@endpush --}}

