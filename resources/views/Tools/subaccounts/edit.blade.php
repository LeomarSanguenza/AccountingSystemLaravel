@extends('layout')

@section('content')
  <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Sub Accounts
        </span>
    </div>
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Sub Account</h1>

    <form action="{{ route('tools.subaccounts.update', $subaccount->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Parent Account</label>
            <select name="account_code_id" class="w-full border rounded px-3 py-2">
                @foreach($accountCodes as $code)
                    <option value="{{ $code->acct_title_id }}" {{ $subaccount->account_code_id == $code->acct_title_id ? 'selected' : '' }}>
                        {{ $code->description }} ({{ $code->acct_code }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Sub Code</label>
            <input type="text" name="sub_code" value="{{ $subaccount->sub_code }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Description</label>
            <input type="text" name="description" value="{{ $subaccount->description }}" class="w-full border rounded px-3 py-2">
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
