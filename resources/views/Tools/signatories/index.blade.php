@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow">
     <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Signatories
        </span>
    </div>
    <h1 class="text-2xl font-bold mb-4">Signatories</h1>

    <a href="{{ route('tools.signatories.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">New Signatory</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Office</th>
                <th class="px-4 py-2">Position</th>
                <th class="px-4 py-2">Designation</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($signatories as $sig)
                <tr>
                    <td class="border px-4 py-2">{{ $sig->name }}</td>
                    <td class="border px-4 py-2">{{ $sig->office }}</td>
                    <td class="border px-4 py-2">{{ $sig->position }}</td>
                    <td class="border px-4 py-2">{{ $sig->designation }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('tools.signatories.edit', $sig->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('tools.signatories.destroy', $sig->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2" onclick="return confirm('Delete this signatory?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
