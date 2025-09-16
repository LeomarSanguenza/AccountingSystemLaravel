{{-- resources/views/obligations/index.blade.php --}}
@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-6">Obligation Requests</h1>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-3 py-2">#</th>
                <th class="border px-3 py-2">Transaction No</th>
                <th class="border px-3 py-2">OBR No</th>
                <th class="border px-3 py-2">Transaction Date</th>
                <th class="border px-3 py-2">OBR Date</th>
                <th class="border px-3 py-2">Payee</th>
                <th class="border px-3 py-2">Fund Type</th>
                <th class="border px-3 py-2">Quarter</th>
                <th class="border px-3 py-2">Particulars</th>
                <th class="border px-3 py-2">Created</th>
                <th class="border px-3 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $req)
                <tr>
                    <td class="border px-3 py-2">{{ $req->id }}</td>
                    <td class="border px-3 py-2">{{ $req->trans_no }}</td>
                    <td class="border px-3 py-2">{{ $req->obr_no }}</td>
                    <td class="border px-3 py-2">{{ $req->trans_date }}</td>
                    <td class="border px-3 py-2">{{ $req->obr_date }}</td>
                    <td class="border px-3 py-2">{{ $req->payee_id }}</td> {{-- Replace with relation if available --}}
                    <td class="border px-3 py-2">{{ $req->fund_type_id }}</td> {{-- Replace with relation --}}
                    <td class="border px-3 py-2">{{ $req->quarter }}</td>
                    <td class="border px-3 py-2 truncate max-w-xs">{{ Str::limit($req->particulars, 50) }}</td>
                    <td class="border px-3 py-2">{{ $req->created_at }}</td>
                    <td class="border px-3 py-2 text-center">
                        <a href="{{ route('obligations.show', $req->id) }}" 
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View
                        </a>
                        <a href="{{ route('disbursements.createFromObr', $req->id) }}" 
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            Make Disbursement
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center py-4">No Obligation Requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $requests->links() }}
    </div>
</div>
@endsection
