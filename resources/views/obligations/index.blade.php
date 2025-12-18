@extends('layout')

@section('content')

<x-index-layout 
    title="Obligation Requests"
    subtitle="Manage and track obligation requests (OBR)"
    max-width="max-w-8xl">
    
    {{-- Fund Type Error Modal --}}
    @if ($errors->has('fund_type'))
        <div x-data="{ showError: true }" x-show="showError" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity z-40"></div>
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all max-w-lg w-full z-50">
                    <div class="bg-white px-6 py-6 sm:px-8 sm:py-7">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="ml-4 text-left">
                                <h3 class="text-xl font-semibold text-gray-900" id="modal-title">Fund Type Error</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-red-700 font-medium">{{ $errors->first('fund_type') }}</p>
                                    <p class="text-xs text-gray-500 mt-2">The Obligation Request (OBR) you selected does not belong to your assigned fund type.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-8">
                        <button @click="showError = false" type="button" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-5 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out sm:ml-3 sm:w-auto sm:text-sm">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <x-data-table 
        :headers="[
            ['label' => 'ID', 'class' => 'w-16'],
            ['label' => 'Trans No', 'class' => 'w-32'],
            ['label' => 'OBR No', 'class' => 'w-32'],
            ['label' => 'Trans Date', 'class' => 'w-32'],
            ['label' => 'OBR Date', 'class' => 'w-32'],
            ['label' => 'Payee', 'class' => 'w-32'],
            ['label' => 'Fund Type', 'class' => 'w-32'],
            ['label' => 'Quarter', 'class' => 'w-24'],
            ['label' => 'Particulars', 'class' => 'min-w-48'],
            ['label' => 'Created', 'class' => 'w-32'],
            ['label' => 'Actions', 'class' => 'w-48']
        ]"
        empty-message="No obligation requests found."
        searchable>
        
        @foreach($requests as $req)
            @include('obligations.partials.table-row', compact('req'))
        @endforeach
        
    </x-data-table>
    
    {{-- Pagination --}}
    @if($requests->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $requests->links() }}
        </div>
    @endif
        
</x-index-layout>

@endsection
