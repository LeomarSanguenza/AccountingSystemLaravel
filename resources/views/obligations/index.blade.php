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
            {{-- @if ($errors->has('fund_type'))
                <!-- 
                    Modal Wrapper: 
                    - x-data initializes the state to show the error.
                    - x-show controls visibility.
                    - fixed inset-0 ensures it covers the whole screen.
                    - z-50 ensures it's above all page content.
                -->
                <div x-data="{ showError: true }" x-show="showError" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    
                    <!-- Background Overlay: fixed inset-0, z-40 ensures it sits just beneath the modal content -->
                    <div class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity z-40"></div>

                    <!-- Modal Center/Content Wrapper -->
                    <div class="flex items-center justify-center min-h-screen p-4">
                        
                        <!-- Modal Panel: z-50 ensures it's above the z-40 overlay -->
                        <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all max-w-lg w-full z-50">
                            
                            <!-- Modal Header/Body -->
                            <div class="bg-white px-6 py-6 sm:px-8 sm:py-7">
                                <div class="flex items-start">
                                    <!-- Icon Area -->
                                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                        <!-- SVG Icon -->
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    
                                    <!-- Content Text -->
                                    <div class="ml-4 text-left">
                                        <h3 class="text-xl font-semibold text-gray-900" id="modal-title">
                                            Fund Type Error
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-red-700 font-medium">
                                                {{ $errors->first('fund_type') }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-2">
                                                The Obligation Request (OBR) you selected does not belong to your assigned fund type.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Footer with Okay Button -->
                            <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-8">
                                <!-- Okay Button: uses Alpine.js @click to hide the modal -->
                                <button @click="showError = false" type="button" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-5 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out sm:ml-3 sm:w-auto sm:text-sm">
                                    Okay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
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
                    <td class="border px-3 py-2 text-center" style="min-width: 200px;">
                        <a href="{{ route('obligations.show', $req->id) }}" 
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View
                        </a>
                        <a href="{{ route('disbursements.createFromObr', $req->id) }}" 
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            Make Dv
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
