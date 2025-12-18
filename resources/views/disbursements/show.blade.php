@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Disbursement Details</h2>
        <div class="flex gap-2">
            <a href="{{ route('disbursements.edit', $disbursement->hdr_id) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">
                Edit Disbursement
            </a>
            <a href="{{ route('disbursements.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                Back to List
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <!-- Header Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Disbursement Information</h3>
                <div class="space-y-2">
                    <div><strong>DV Number:</strong> {{ $disbursement->dv_number }}</div>
                    <div><strong>Date of Voucher:</strong> {{ $disbursement->date_of_voucher }}</div>
                    <div><strong>Mode of Payment:</strong> {{ $disbursement->mode_of_payment }}</div>
                    <div><strong>Fund Type:</strong> {{ $disbursement->fund_type }}</div>
                    <div><strong>Status:</strong> 
                        <span class="px-2 py-1 rounded text-sm
                            @if($disbursement->status == 1) bg-yellow-100 text-yellow-800
                            @elseif($disbursement->status == 2) bg-green-100 text-green-800
                            @elseif($disbursement->status == 7) bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            @switch($disbursement->status)
                                @case(1) Pending @break
                                @case(2) Approved @break
                                @case(4) Processing @break
                                @case(7) Cancelled @break
                                @default Unknown
                            @endswitch
                        </span>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Payee Information</h3>
                <div class="space-y-2">
                    <div><strong>Payee:</strong> {{ $disbursement->payee }}</div>
                    <div><strong>TIN:</strong> {{ $disbursement->tin }}</div>
                    <div><strong>Address:</strong> {{ $disbursement->address }}</div>
                    <div><strong>Obligation Number:</strong> {{ $disbursement->obligation_number }}</div>
                </div>
            </div>
        </div>

        <!-- Check Information (if applicable) -->
        @if($disbursement->check_number)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Check Information</h3>
            <div class="bg-gray-50 p-4 rounded-lg grid grid-cols-1 md:grid-cols-3 gap-4">
                <div><strong>Bank:</strong> {{ $disbursement->bank }}</div>
                <div><strong>Check Number:</strong> {{ $disbursement->check_number }}</div>
                <div><strong>Check Amount:</strong> ₱{{ number_format($disbursement->check_amount, 2) }}</div>
                <div><strong>Date of Check:</strong> {{ $disbursement->date_of_check }}</div>
            </div>
        </div>
        @endif

        <!-- Particulars -->
        @if($disbursement->particulars)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Particulars</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                {{ $disbursement->particulars }}
            </div>
        </div>
        @endif

        <!-- Disbursement Details -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Disbursement Details</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 border">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-2 border">Account Code</th>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($disbursement->details as $detail)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $detail->account_code }}</td>
                            <td class="px-4 py-2 border">{{ $detail->description ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border text-right">₱{{ number_format($detail->amount, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-500 border">
                                No disbursement details found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-100 font-semibold">
                        <tr>
                            <td colspan="2" class="px-4 py-2 border text-right">Total:</td>
                            <td class="px-4 py-2 border text-right">
                                ₱{{ number_format($disbursement->details->sum('amount'), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        @if($disbursement->status == 1)
        <div class="mt-8 flex gap-2">
            @can('approve disbursements')
            <form action="{{ route('disbursements.approve', $disbursement->hdr_id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
                        onclick="return confirm('Approve this disbursement?')">
                    Approve
                </button>
            </form>
            <form action="{{ route('disbursements.reject', $disbursement->hdr_id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                        onclick="return confirm('Reject this disbursement?')">
                    Reject
                </button>
            </form>
            @endcan
        </div>
        @endif
    </div>
</div>
@endsection