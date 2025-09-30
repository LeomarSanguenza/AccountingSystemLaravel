@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow mt-6">
    <h2 class="text-2xl font-bold mb-6">Fund Type Details</h2>

    <div class="space-y-3">
        <p><strong>ID:</strong> {{ $fundtype->id }}</p>
        <p><strong>Description:</strong> {{ $fundtype->description }}</p>
        <p><strong>Code:</strong> <span class="font-mono">{{ $fundtype->code }}</span></p>
        <p><strong>Alias:</strong> {{ $fundtype->alias }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('fundtypes.index') }}" 
           class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
            Back
        </a>
    </div>
</div>
@endsection
