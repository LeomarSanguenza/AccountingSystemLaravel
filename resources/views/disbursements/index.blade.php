@extends('layout')

@section('content')

<x-index-layout 
    title="Disbursement Vouchers"
    subtitle="Manage and track financial disbursement vouchers"
    :create-route="route('disbursements.create')"
    create-text="New Disbursement"
    max-width="max-w-8xl">
    
    <x-data-table 
        :headers="[
            ['label' => 'DV No.', 'class' => 'w-32'],
            ['label' => 'Payee', 'class' => 'min-w-48'],
            ['label' => 'Date', 'class' => 'w-32'],
            ['label' => 'Debit', 'class' => 'w-32 text-right'],
            ['label' => 'Credit', 'class' => 'w-32 text-right'],
            ['label' => 'Status', 'class' => 'w-48'],
            ['label' => 'Actions', 'class' => 'w-48']
        ]"
        empty-message="No disbursement vouchers found."
        searchable>
        
        @foreach($headers as $hdr)
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                @include('disbursements.partials.table-row', compact('hdr'))
            </tr>
        @endforeach
        
    </x-data-table>
        
</x-index-layout>

@endsection
