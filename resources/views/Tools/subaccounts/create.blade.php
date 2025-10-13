@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">
    <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <span class="text-gray-700 font-semibold">Sub Accounts</span>
    </div>

    <h1 class="text-2xl font-bold mb-4">Create Sub Account</h1>

    <form action="{{ route('tools.subaccounts.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Parent Account</label>
            <select name="account_code_id" class="w-full border rounded px-3 py-2 searchable-select">
                <option value="">-- Select Parent Account --</option>
                @foreach($accountCodes as $code)
                    <option value="{{ $code->acct_title_id }}">
                        {{ $code->description }} ({{ $code->full_code }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Sub Code</label>
            <input type="text" name="sub_code" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Description</label>
            <input type="text" name="description" class="w-full border rounded px-3 py-2">
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
            console.log('burat');
    $(document).ready(function() {
        // Initialize Select2 on the parent account dropdown
        $('.searchable-select').select2({
            placeholder: "Select a parent account",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
