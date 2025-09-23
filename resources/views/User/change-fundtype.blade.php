@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Change Fund Type for {{ $user->Username }}</h2>

    <form action="{{ route('users.updateFundType', $user->UserID) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="fund_type" class="block text-sm font-medium text-gray-700">Fund Type</label>
            <select name="fundtype" id="fund_type" 
                    class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                    required>
                <option value="">-- Select Fund Type --</option>
                @foreach($fundtypes as $fund)
                    <option value="{{ $fund->id }}" {{ $user->fundtype == $fund->id ? 'selected' : '' }}>
                        {{ $fund->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" 
                    class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition">
                Update Fund Type
            </button>
        </div>
    </form>
</div>
@endsection
