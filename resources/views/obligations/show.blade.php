{{-- resources/views/obligations/show.blade.php --}}
@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-6">Obligation Request Details</h1>

    {{-- HEADER FIELDS --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <p><strong>Transaction No:</strong> {{ $request->trans_no }}</p>
            <p><strong>OBR No:</strong> {{ $request->obr_no }}</p>
            <p><strong>Transaction Date:</strong> {{ $request->trans_date }}</p>
            <p><strong>OBR Date:</strong> {{ $request->obr_date }}</p>
            <p><strong>Quarter:</strong> {{ $request->quarter }}</p>
        </div>
        <div>
            <p><strong>Payee:</strong> {{ $request->payee_id }}</p> {{-- Replace with payee name if joined --}}
            <p><strong>Fund Type:</strong> {{ $request->fund_type_id }}</p> {{-- Replace with fund type name if joined --}}
            <p><strong>Department:</strong> {{ $request->dep_id }}</p> {{-- Replace with relation if you want --}}
            <p><strong>Handler:</strong> {{ $request->handler_id }}</p>
        </div>
    </div>

    {{-- PARTICULARS --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Particulars</h2>
        <p class="whitespace-pre-line">{{ $request->particulars }}</p>
    </div>

    {{-- ENTRIES TABLE --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Entries</h2>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Account Code</th>
                    <th class="border px-3 py-2">Description</th>
                    <th class="border px-3 py-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($request->entries as $entry)
                    <tr>
                        <td class="border px-3 py-2">{{ $entry->id }}</td>
                        <td class="border px-3 py-2">{{ $entry->account_code }}</td>
                        <td class="border px-3 py-2">{{ $entry->description }}</td>
                        <td class="border px-3 py-2 text-right">{{ number_format($entry->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No entries found for this request.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER INFO --}}
    <div class="text-sm text-gray-600">
        <p><strong>Created At:</strong> {{ $request->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $request->updated_at }}</p>
    </div>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('obligations.index') }}" 
        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Back
        </a>

        <a href="{{ route('disbursements.createFromObr', $request->id) }}" 
        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
        Make Disbursement
        </a>
    </div>

</div>
@endsection
