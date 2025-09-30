@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">
    <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Payees
        </span>
    </div>
    <h1 class="text-2xl font-bold mb-4">Payees</h1>

    <a href="{{ route('tools.payees.create') }}" 
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
                        <form action="{{ route('tools.payees.destroy', $payee->id) }}" method="POST" class="inline">
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
