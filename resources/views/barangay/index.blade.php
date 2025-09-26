@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Barangays</h1>

    <a href="{{ route('barangays.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">New Barangay</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Barangay Name</th>
                <th class="px-4 py-2">Code</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangays as $barangay)
                <tr>
                    <td class="border px-4 py-2">{{ $barangay->barangay_name }}</td>
                    <td class="border px-4 py-2">{{ $barangay->barangay_code }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('barangays.edit', $barangay->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('barangays.destroy', $barangay->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2" onclick="return confirm('Delete this barangay?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
