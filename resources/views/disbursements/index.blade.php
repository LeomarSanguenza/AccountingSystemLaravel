@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Disbursements Vouchers</h2>

    <a href="{{ route('disbursements.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + New Disbursement
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">DV No.</th>
                    <th class="p-2 border">Payee</th>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">debit</th>
                    <th class="p-2 border">credit</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($headers as $hdr)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $hdr->dv_no }}</td>
                        <td class="p-2 border">{{ $hdr->payee }}</td>
                        <td class="p-2 border">{{ $hdr->date_of_voucher }}</td>
                        <td class="p-2 border text-right">{{ number_format($hdr->details->sum('debit'), 2) }}</td>
                        <td class="p-2 border text-right">{{ number_format($hdr->details->sum('credit'), 2) }}</td>
                        <td class="p-2 border">{{ $hdr->status }}</td>
                        <td class="p-2 border space-x-2">
                            <a href="{{ route('disbursements.edit', $hdr) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                            <form action="{{ route('disbursements.destroy', $hdr) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this voucher?')" 
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
