@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Fund Types</h1>

    <a href="{{ route('fundtypes.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ New Fund Type</a>

    @if(session('success'))
        <div class="mt-3 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-4 border border-gray-200 rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Description</th>
                <th class="px-4 py-2 border">Code</th>
                <th class="px-4 py-2 border">Alias</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fundtypes as $fundtype)
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2">{{ $fundtype->id }}</td>
                <td class="border px-4 py-2">{{ $fundtype->description }}</td>
                <td class="border px-4 py-2 font-mono">{{ $fundtype->code }}</td>
                <td class="border px-4 py-2">{{ $fundtype->alias }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('fundtypes.show', $fundtype->id) }}" 
                       class="text-blue-600 hover:underline">View</a>
                    <a href="{{ route('fundtypes.edit', $fundtype->id) }}" 
                       class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('fundtypes.destroy', $fundtype->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure?')" 
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
