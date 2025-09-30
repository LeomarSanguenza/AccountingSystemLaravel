@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">
      <div class="mb-4 text-sm text-gray-500 flex items-center space-x-1">
        <a href="{{ route('tools.index') }}" class="hover:underline">Tools</a>
        
        {{-- Separator --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>

        <span class="text-gray-700 font-semibold">Tags
        </span>
    </div>
    <h1 class="text-2xl font-bold mb-4">Tags</h1>

    <a href="{{ route('tools.tags.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">New Tag</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Journal Type</th>
                <th class="px-4 py-2">Fund Type</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td class="border px-4 py-2">{{ $tag->description }}</td>
                    <td class="border px-4 py-2">{{ $tag->journal_type }}</td>
                    <td class="border px-4 py-2">
                        {{ $tag->fundtype ? $tag->fundtypeRelation->description : 'All' }}
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('tools.tags.edit', $tag->tags_id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('tools.tags.destroy', $tag->tags_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2" onclick="return confirm('Delete this tag?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
