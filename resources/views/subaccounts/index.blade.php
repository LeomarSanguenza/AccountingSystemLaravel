@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Sub Accounts</h1>

    <a href="{{ route('subaccounts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">New Sub Account</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Sub Code</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Parent Account</th>
                <th class="px-4 py-2">Active</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subAccounts as $sub)
                <tr>
                    <td class="border px-4 py-2">{{ $sub->sub_code }}</td>
                    <td class="border px-4 py-2">{{ $sub->description }}</td>
                    <td class="border px-4 py-2">{{ $sub->accountCode->description ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $sub->active ? 'Yes' : 'No' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('subaccounts.edit', $sub->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('subaccounts.destroy', $sub->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2" onclick="return confirm('Delete this sub account?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
