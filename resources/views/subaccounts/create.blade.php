@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Create Sub Account</h1>

    <form action="{{ route('subaccounts.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Parent Account</label>
            <select name="account_code_id" class="w-full border rounded px-3 py-2 searchable-select">
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
    $(document).ready(function() {
        $('.searchable-select').select2({
            placeholder: "Select a parent account",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
