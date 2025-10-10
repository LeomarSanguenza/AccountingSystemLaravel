@extends('layout')

@section('content')
<div class="max-w-8xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Disbursement Vouchers</h2>

    <a href="{{ route('disbursements.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + New Disbursement
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto min-h-[350px]">
          @if ($errors->has('fund_type'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first('fund_type') }}</span>
                
                </div>
        @endif
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">DV No.</th>
                    <th class="p-2 border">Payee</th>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Debit</th>
                    <th class="p-2 border">Credit</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($headers as $hdr)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $hdr->dv_no }}</td>
                        {{-- <td class="p-2 border">{{ $hdr->payee->payee_name ?? 'N/A' }}</td> --}}
                        <td class="p-2 border">{{ $hdr->payee_name }}</td>
                        <td class="p-2 border">{{ $hdr->date_of_voucher }}</td>
                        <td class="p-2 border text-right">{{ number_format($hdr->details->sum('debit'), 2) }}</td>
                        <td class="p-2 border text-right">{{ number_format($hdr->details->sum('credit'), 2) }}</td>
                        <td class="p-2 border text-center relative">
                            <div class="inline-block text-left">
                                <button type="button" 
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    onclick="this.nextElementSibling.classList.toggle('hidden')">
                                    {{$hdr->statusRecord?->status_name ?? 'Unknown'}}
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" 
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg z-50">
                                    <div class="flex flex-col min-h-[180px]"> {{-- fixed dropdown height --}}

                                        {{-- Step 1: Approve / Reject --}}
                                        @if ($hdr->status == 1)
                                            <form action="{{ route('disbursements.approve', $hdr->dv_hdr_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 text-left text-green-600 bg-green-50 hover:bg-green-100 w-full">
                                                    ✔ Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('disbursements.reject', $hdr->dv_hdr_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 text-left text-red-600 bg-red-50 hover:bg-red-100 w-full">
                                                    ✖ Reject
                                                </button>
                                            </form>
                                        @elseif ($hdr->status > 1)
                                            <p class="px-4 py-2 text-gray-700 bg-green-100">✔ Approved</p>
                                        @endif

                                        {{-- Step 2: Document Process --}}
                                        @if ($hdr->status == 1)
                                            <p class="px-4 py-2 text-gray-400 bg-gray-50 cursor-not-allowed">Document Process</p>
                                        @elseif ($hdr->status == 2)
                                            <form action="{{ route('disbursements.process', $hdr->dv_hdr_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 text-left text-blue-600 bg-blue-250 hover:bg-blue-200 w-full">
                                                    Document Process
                                                </button>
                                            </form>
                                        @elseif ($hdr->status > 2)
                                            <p class="px-4 py-2 text-gray-700 bg-blue-100">✔ Document Completed</p>
                                        @endif

                                        {{-- Step 3: Entry Processed --}}
                                        @if ($hdr->details->count() > 0)
                                            <p class="px-4 py-2 text-gray-700 bg-white-100 border-2">✔ Entries Processed</p>
                                        @else
                                            <form action="{{ route('disbursements.entry', $hdr->dv_hdr_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 text-left text-indigo-600 bg-indigo-50 hover:bg-indigo-100 w-full">
                                                    Mark Entry Processed
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Step 4: Cancelled --}}
                                        @if ($hdr->status == 7)
                                            <p class="px-4 py-2 text-red-500 bg-red-100">✖ Cancelled</p>
                                        @endif

                                        {{-- Step 4: Link to JEV --}}
                                        @if ($hdr->status > 2 && $hdr->details->count() > 0)
                                            <form action="#" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 text-left text-indigo-600 bg-indigo-50 hover:bg-indigo-100 w-full">
                                                    Link to JEV
                                                </button>
                                            </form>  
                                        @elseif ($hdr->status == 1)
                                            <p class="px-4 py-2 text-gray-400 bg-gray-50 cursor-not-allowed">
                                                Link to JEV (Pending Approval)
                                            </p>
                                        @elseif ($hdr->status == 2)
                                            <p class="px-4 py-2 text-gray-400 bg-gray-50 cursor-not-allowed">
                                                Link to JEV
                                            </p>
                                        @elseif ($hdr->details->count() == 0)
                                            <p class="px-4 py-2 text-gray-400 bg-gray-50 cursor-not-allowed">
                                                Process Entries First
                                            </p>
                                        @endif



                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- OPTIONS: Edit + Delete --}}
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
