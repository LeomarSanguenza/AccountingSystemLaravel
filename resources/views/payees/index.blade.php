@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Payees</h1>

    <a href="{{ route('payees.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">New Payee</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Payee Name</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payees as $payee)
                <tr>
                    <td class="border px-4 py-2">{{ $payee->payee_name }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('payees.edit', $payee->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('payees.destroy', $payee->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2" onclick="return confirm('Delete this payee?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
