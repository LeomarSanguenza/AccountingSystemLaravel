@extends('layout')

@section('content')

<x-index-layout 
    title="Journal Entries"
    subtitle="Manage accounting journal entries and transactions"
    :create-route="route('journals.create')"
    create-text="New Journal Entry">
    
    <x-data-table 
        :headers="[
            ['label' => 'Entry No', 'class' => 'w-32'],
            ['label' => 'Voucher No', 'class' => 'w-32'],
            ['label' => 'Date', 'class' => 'w-32'],
            ['label' => 'Particulars', 'class' => 'min-w-64'],
            ['label' => 'Details Count', 'class' => 'w-24 text-center'],
            ['label' => 'Actions', 'class' => 'w-48']
        ]"
        :rows="$journals->map(function($journal) {
            return view('journals.partials.table-row', compact('journal'))->render();
        })"
        empty-message="No journal entries found."
        searchable />
        
    {{-- Pagination --}}
    @if($journals->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $journals->links() }}
        </div>
    @endif
        
</x-index-layout>

@endsection
