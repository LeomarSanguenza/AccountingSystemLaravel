@extends('layout')
@section('content')

<x-form-layout 
    title="Edit Disbursement Voucher"
    subtitle="Update disbursement voucher information"
    :breadcrumbs="[
        ['label' => 'Disbursements', 'url' => route('disbursements.index')],
        ['label' => 'DV-' . $disbursement->dv_number, 'url' => route('disbursements.show', $disbursement->dv_hdr_id)],
        ['label' => 'Edit']
    ]"
    max-width="max-w-7xl">
    
    <form action="{{ route('disbursements.update', $disbursement->dv_hdr_id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- HEADER SECTION --}}
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Voucher Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-field 
                    label="Date of Voucher"
                    name="date_of_voucher"
                    type="date"
                    :value="$disbursement->date_of_voucher"
                    required />
                
                <x-form-field 
                    label="Mode of Payment"
                    name="mode_of_payment"
                    type="select"
                    :value="$disbursement->mode_of_payment"
                    :options="[
                        'Check' => 'Check',
                        'Cash' => 'Cash', 
                        'Others' => 'Others'
                    ]"
                    required />
            </div>
        </div>

        {{-- FLEX HEADER ROW --}}
        <div class="flex flex-wrap space-x-3 items-end w-full mb-6">
            <!-- Fund Type -->
            <div class="flex-shrink-0">
                <label class="block text-sm font-medium mb-1">Fund Type</label>
                <input type="text" name="fund_type" class="w-64 border rounded p-2"
                    value="{{ $disbursement->fund_type ?? auth()->user()->fundtypeRelation->code . '-' . auth()->user()->fundtypeRelation->description }}"
                    disabled>
            </div>

            <!-- DV Prefix -->
            <div class="flex-shrink-0">
                <label class="block text-sm font-medium mb-1">DV Prefix</label>
                <input type="text" id="dv_prefix" class="w-32 border rounded p-2 bg-gray-100"
                    value="{{ $disbursement->dv_prefix }}" readonly>
            </div>

            <!-- DV Number -->
            <div class="flex-shrink-0">
                <label class="block text-sm font-medium mb-1">DV Number</label>
                <input type="number" id="dv_number" name="dv_number"
                    class="w-24 border rounded p-2"
                    value="{{ old('dv_number', $disbursement->dv_number) }}" min="1">
            </div>

            <!-- Payee -->
            <div class="flex-1 min-w-[300px]">
                <label class="block text-sm font-medium mb-1">Payee</label>
                <select id="payee" name="payee" class="w-full border rounded p-2">
                    <option value="">-- Search Payee --</option>
                    @foreach(\App\Models\Payee::all() as $p)
                        <option value="{{ $p->id }}" 
                            {{ old('payee', $disbursement->payee_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->payee_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

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
                @foreach ($disbursement->details as $i => $detail)
                    <tr>
                        <td class="border p-2">
                            <select name="details[{{ $i }}][account_codes]" class="account-code-dropdown border p-1 w-full">
                                <option value="">-- Select Account Code --</option>
                                @foreach ($accountCodes as $code)
                                    <option value="{{ $code->full_code }}" 
                                        {{ $detail->account_code === $code->full_code ? 'selected' : '' }}>
                                        {{ $code->full_code }} - {{ $code->description }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="details[{{ $i }}][sub_account]" class="border p-1 w-full" value="{{ $detail->sub_account }}"></td>
                        <td><input type="text" name="details[{{ $i }}][debit]" class="border p-1 w-full amount-field debit" value="{{ number_format($detail->debit, 2) }}"></td>
                        <td><input type="text" name="details[{{ $i }}][credit]" class="border p-1 w-full amount-field credit" value="{{ number_format($detail->credit, 2) }}"></td>
                        <td class="text-center"><button type="button" class="text-red-500 removeRow">✕</button></td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr class="bg-gray-50 font-bold">
                    <td colspan="2" class="text-right border px-2 py-1">TOTAL</td>
                    <td class="border px-2 py-1 text-right" id="totalDebit">0.00</td>
                    <td class="border px-2 py-1 text-right" id="totalCredit">0.00</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <button type="button" id="addRow" class="bg-blue-500 text-white px-3 py-1 rounded">+ Add Row</button>

        <div class="mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>

{{-- JS --}}
<script>
    let rowCount = {{ $disbursement->details->count() }};

    function initSelect2(element) {
        $(element).select2({
            placeholder: "Search account code...",
            allowClear: true,
            width: '100%'
        });
    }

    $(document).ready(function() {
        $('.account-code-dropdown').each(function() { initSelect2(this); });
        $('#payee').select2({ placeholder: "Search Payee...", allowClear: true, width: '100%' });
    });

    // Add new row
    $('#addRow').on('click', function() {
        let table = $('#detailsTable tbody');
        let newRow = $(`
            <tr>
                <td class="border p-2">
                    <select name="details[${rowCount}][account_codes]" class="account-code-dropdown border p-1 w-full">
                        <option value="">-- Select Account Code --</option>
                        @foreach ($accountCodes as $code)
                            <option value="{{ $code->full_code }}">{{ $code->full_code }} - {{ $code->description }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="details[${rowCount}][sub_account]" class="border p-1 w-full"></td>
                <td><input type="text" name="details[${rowCount}][debit]" class="border p-1 w-full amount-field debit" placeholder="0.00"></td>
                <td><input type="text" name="details[${rowCount}][credit]" class="border p-1 w-full amount-field credit" placeholder="0.00"></td>
                <td class="text-center"><button type="button" class="text-red-500 removeRow">✕</button></td>
            </tr>
        `);
        table.append(newRow);
        initSelect2(newRow.find('.account-code-dropdown'));
        rowCount++;
    });
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });
</script>
@endsection
