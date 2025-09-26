@extends('layout')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Payee</h1>

    <form action="{{ route('payees.update', $payee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Payee Name</label>
            <input type="text" name="payee_name" value="{{ $payee->payee_name }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('payees.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
