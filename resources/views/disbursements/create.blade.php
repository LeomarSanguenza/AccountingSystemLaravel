    {{-- resources/views/disbursement/create.blade.php --}}
    @extends('layout')

    @section('content')
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-2xl shadow">
        <h1 class="text-2xl font-bold mb-6">New Disbursement Voucher</h1>

        <form action="{{ route('disbursements.store') }}" method="POST">
            @csrf

            {{-- HEADER FIELDS --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Date of Voucher</label>
                    <input type="date" name="date_of_voucher" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Mode of Payment</label>
                    <select name="mode_of_payment" class="w-full border rounded p-2">
                        <option value="">-- Select Mode of Payment --</option>
                        <option value="Check">Check</option>
                        <option value="Cash">Cash</option>
                        <option value="Others">Others</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Fund Type</label>
                        <input type="text" name="fund_type" class="w-full border rounded p-2"
                        value="{{ $obr->fund_type_id ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">DV Number</label>
                    <input type="text" name="dv_number" class="w-full border rounded p-2">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium mb-1">Payee</label>
                        <input type="text" name="payee" class="w-full border rounded p-2"
                        value="{{ $obr->payee_id ?? '' }}">

                </div>
            </div>

            {{-- DETAIL FIELDS --}}
            {{-- DETAIL FIELDS --}}
            <h2 class="text-lg font-semibold mb-3">Disbursement Details</h2>
            <table class="w-full border-collapse mb-4" id="detailsTable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-2 py-1">Account Code</th>
                        <th class="border px-2 py-1">Sub Account</th>
                        <th class="border px-2 py-1">Debit</th>
                        <th class="border px-2 py-1">Credit</th>
                        <th class="border px-2 py-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($obr) && $obr->entries->count())
                        @foreach ($obr->entries as $i => $entry)
                            <tr>
                                <td class="border p-2">
                                    <select name="details[{{ $i }}][account_codes]" class="account-code-dropdown border p-1 w-full">
                                        <option value="">-- Select Account Code --</option>
                                        @foreach ($accountCodes as $code)
                                            <option value="{{ $code->full_code }}"
                                                {{ $entry->account_code === $code->full_code ? 'selected' : '' }}>
                                                {{ $code->full_code }} - {{ $code->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="details[{{ $i }}][sub_account]" class="border p-1 w-full" value=""></td>
                                <td><input type="text" name="details[{{ $i }}][debit]" class="border p-1 w-full amount-field debit" value="{{ number_format($entry->amount, 2) }}"></td>
                                <td><input type="text" name="details[{{ $i }}][credit]" class="border p-1 w-full amount-field credit" value="0.00"></td>
                                <td class="text-center"><button type="button" class="text-red-500 removeRow">✕</button></td>
                            </tr>
                        @endforeach
                    @else
                        {{-- fallback: preload 2 empty rows --}}
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <td class="border p-2">
                                    <select name="details[{{ $i }}][account_codes]" class="account-code-dropdown border p-1 w-full">
                                        <option value="">-- Select Account Code --</option>
                                        @foreach ($accountCodes as $code)
                                            <option value="{{ $code->full_code }}">{{ $code->full_code }} - {{ $code->description }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="details[{{ $i }}][sub_account]" class="border p-1 w-full"></td>
                                <td><input type="text" name="details[{{ $i }}][debit]" class="border p-1 w-full amount-field debit" placeholder="0.00"></td>
                                <td><input type="text" name="details[{{ $i }}][credit]" class="border p-1 w-full amount-field credit" placeholder="0.00"></td>
                                <td class="text-center"><button type="button" class="text-red-500 removeRow">✕</button></td>
                            </tr>
                        @endfor
                    @endif
                </tbody>

                <tfoot>
                    <tr class="bg-gray-50 font-bold">
                        <td colspan="2" class="text-right border px-2 py-1">TOTAL</td>
                        <td class="border px-2 py-1 text-right" placeholder = "0.00" id="totalDebit"></td>
                        <td class="border px-2 py-1 text-right" placeholder = "0.00" id="totalCredit"></td>
                        <td></td>
                    </tr>
                </tfoot>

            </table>


            <button type="button" id="addRow" class="bg-blue-500 text-white px-3 py-1 rounded">+ Add Row</button>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Search account code...",
                allowClear: true
            });
        });
    </script>
    @endpush

    @push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @endpush