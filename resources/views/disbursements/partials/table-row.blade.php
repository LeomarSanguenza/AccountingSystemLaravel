{{-- Disbursement Table Row Partial --}}
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
    {{ $hdr->dv_no }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    <div class="flex items-center">
        <div class="flex-shrink-0 h-8 w-8">
            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
        <div class="ml-3">
            <div class="text-sm font-medium text-gray-900">{{ $hdr->payee_name }}</div>
        </div>
    </div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ \Carbon\Carbon::parse($hdr->date_of_voucher)->format('M d, Y') }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-mono">
    ₱{{ number_format($hdr->details->sum('debit'), 2) }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-mono">
    ₱{{ number_format($hdr->details->sum('credit'), 2) }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    <div class="relative inline-block text-left">
        <button type="button" 
                class="inline-flex justify-center items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
            @php
                $statusColors = [
                    1 => 'bg-yellow-100 text-yellow-800',
                    2 => 'bg-blue-100 text-blue-800', 
                    3 => 'bg-green-100 text-green-800',
                    7 => 'bg-red-100 text-red-800'
                ];
                $statusColor = $statusColors[$hdr->status] ?? 'bg-gray-100 text-gray-800';
            @endphp
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                {{ $hdr->statusRecord?->status_name ?? 'Unknown' }}
            </span>
            <svg class="-mr-1 ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
            </svg>
        </button>

        <div class="hidden absolute right-0 z-10 mt-2 w-64 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
                {{-- Step 1: Approve / Reject --}}
                @if ($hdr->status == 1)
                    <form action="{{ route('disbursements.approve', $hdr->dv_hdr_id) }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-green-700 hover:bg-green-50">
                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approve
                        </button>
                    </form>
                    <form action="{{ route('disbursements.reject', $hdr->dv_hdr_id) }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject
                        </button>
                    </form>
                @elseif ($hdr->status > 1)
                    <div class="px-4 py-2 text-sm text-green-700 bg-green-50">
                        <div class="flex items-center">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approved
                        </div>
                    </div>
                @endif

                {{-- Step 2: Document Process --}}
                @if ($hdr->status == 2)
                    <form action="{{ route('disbursements.process', $hdr->dv_hdr_id) }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-blue-700 hover:bg-blue-50">
                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Process Document
                        </button>
                    </form>
                @elseif ($hdr->status > 2)
                    <div class="px-4 py-2 text-sm text-blue-700 bg-blue-50">
                        <div class="flex items-center">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Document Processed
                        </div>
                    </div>
                @elseif ($hdr->status == 1)
                    <div class="px-4 py-2 text-sm text-gray-500 bg-gray-50">
                        <div class="flex items-center">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Pending Approval
                        </div>
                    </div>
                @endif

                {{-- Cancelled Status --}}
                @if ($hdr->status == 7)
                    <div class="px-4 py-2 text-sm text-red-700 bg-red-50">
                        <div class="flex items-center">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelled
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    <x-action-buttons 
        :view-route="route('disbursements.show', $hdr)"
        :edit-route="route('disbursements.edit', $hdr)"
        :delete-route="route('disbursements.destroy', $hdr)"
        delete-confirm="Are you sure you want to delete this disbursement voucher?" />
</td>