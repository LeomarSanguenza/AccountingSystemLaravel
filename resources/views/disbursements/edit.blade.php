
@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Disbursement Voucher</h2>

    <form action="{{ route('disbursements.update', $header) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- HEADER FIELDS --}}
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-medium">DV Number</label>
                <input type="text" name="dv_no" value="{{ $header->dv_no }}" 
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Date</label>
                <input type="date" name="date_of_voucher" value="{{ $header->date_of_voucher }}" 
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Payee</label>
                <input type="text" name="payee" value="{{ $header->payee }}" 
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option {{ $header->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option {{ $header->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                </select>
            </div>
        </div>

        {{-- DETAILS TABLE --}}
        <h3 class="text-xl font-semibold mb-2">Entries</h3>
        <table class="w-full border border-gray-300 mb-4" id="details-table">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Account Code</th>
                    <th class="p-2 border">Sub Account</th>
                    <th class="p-2 border">FPP</th>
                    <th class="p-2 border">Debit</th>
                    <th class="p-2 border">Credit</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($header->details as $i => $detail)
                    <tr>
                        <td class="border p-2">
                            <select name="details[{{ $i }}][account_codes]" class="w-full border rounded px-2 py-1">
                                @if(isset($detail->account_codes) && $detail->account_codes)
                                    <option value="{{ $detail->account_codes }}" selected>
                                        {{ $detail->account_codes }}
                                    </option>
                                @else
                                    <option value="">-- Select Account Code --</option>
                                @endif

                                @foreach ($accountCodes as $code)
                                    <option value="{{ $code->acct_code }}"
                                        {{ (isset($detail->account_code) && $detail->account_code == $code->acct_code) ? 'selected' : '' }}>
                                        {{ $code->full_code }} - {{ $code->description }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border p-2">
                            <input type="text" name="details[{{ $i }}][sub_account]" 
                                   value="{{ $detail->sub_account }}" 
                                   class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border p-2">
                            <input type="text" name="details[{{ $i }}][fpp]" 
                                   value="{{ $detail->fpp }}" 
                                   class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border p-2">
                            <input type="number" step="0.01" name="details[{{ $i }}][debit]" 
                                   value="{{ $detail->debit }}" 
                                   class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border p-2">
                            <input type="number" step="0.01" name="details[{{ $i }}][credit]" 
                                   value="{{ $detail->credit }}" 
                                   class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border p-2 text-center">
                            <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-row">X</button>
                        </td>
                    </tr>
                @empty
                    {{-- If no details, load 2 empty rows --}}
                    @for ($i = 0; $i < 2; $i++)
                        <tr>
                            <td class="border p-2">
                                <select name="details[{{ $i }}][account_code]" class="w-full border rounded px-2 py-1">
                                    <option value="{{ $code->full_code }}" 
                                        {{ $detail->account_code == $code->full_code ? 'selected' : '' }}>
                                        {{ $code->full_code }} - {{ $code->description }}
                                    </option>
                                    @foreach ($accountCodes as $code)
                                        <option value="{{ $code->acct_code }}">
                                            {{ $code->full_code }} - {{ $code->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border p-2"><input type="text" name="details[{{ $i }}][sub_account]" class="w-full border rounded px-2 py-1"></td>
                            <td class="border p-2"><input type="text" name="details[{{ $i }}][fpp]" class="w-full border rounded px-2 py-1"></td>
                            <td class="border p-2"><input type="number" step="0.01" name="details[{{ $i }}][debit]" class="w-full border rounded px-2 py-1"></td>
                            <td class="border p-2"><input type="number" step="0.01" name="details[{{ $i }}][credit]" class="w-full border rounded px-2 py-1"></td>
                            <td class="border p-2 text-center">
                                <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-row">X</button>
                            </td>
                        </tr>
                    @endfor
                @endforelse
            </tbody>
             <tfoot>
                <tr class="bg-gray-50 font-bold">
                    <td colspan="2" class="text-left border px-2 py-1">TOTAL</td>
                    <td class="border px-2 py-1 text-right" placeholder = "0.00" id="totalDebit"></td>
                    <td class="border px-2 py-1 text-right" placeholder = "0.00" id="totalCredit"></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <button type="button" id="add-row" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Add Row
        </button>

        <div class="mt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                Save Changes
            </button>
        </div>
    </form>
</div>

{{-- JS for dynamic rows --}}
<script>
    document.getElementById('add-row').addEventListener('click', function () {
        let table = document.querySelector('#details-table tbody');
        let index = table.rows.length;
        let row = `
        <tr>
            <td class="border p-2">
                <select name="details[${index}][account_code]" class="w-full border rounded px-2 py-1">
                    <option value="">-- Select Account Code --</option>
                    @foreach ($accountCodes as $code)
                        <option value="{{ $code->full_code }}">
                            {{ $code->full_code }} - {{ $code->description }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td class="border p-2"><input type="text" name="details[${index}][sub_account]" class="w-full border rounded px-2 py-1"></td>
            <td class="border p-2"><input type="text" name="details[${index}][fpp]" class="w-full border rounded px-2 py-1"></td>
            <td class="border p-2"><input type="number" step="0.01" name="details[${index}][debit]" class="w-full border rounded px-2 py-1"></td>
            <td class="border p-2"><input type="number" step="0.01" name="details[${index}][credit]" class="w-full border rounded px-2 py-1"></td>
            <td class="border p-2 text-center">
                <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-row">X</button>
            </td>
        </tr>`;
        table.insertAdjacentHTML('beforeend', row);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    function calculateTotals() {
        let totalDebit = 0, totalCredit = 0;
        document.querySelectorAll('.debit').forEach(input => {
            totalDebit += parseFloat(input.value) || 0;
        });
        document.querySelectorAll('.credit').forEach(input => {
            totalCredit += parseFloat(input.value) || 0;
        });
        document.getElementById('totalDebit').innerText = totalDebit.toFixed(2);
        document.getElementById('totalCredit').innerText = totalCredit.toFixed(2);
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
    
</script>
@endsection
