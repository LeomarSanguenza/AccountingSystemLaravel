@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-bold mb-6">Employees List</h2>

    <div class="flex gap-3 mb-6">
        <a href="{{ route('employees.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow">
           Add Employee
        </a>
        <a href="{{ route('employees.summary') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow">
           Employee Summary
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Position</th>
                    <th class="px-4 py-2 text-left">Salary</th>
                    <th class="px-4 py-2 text-left">Gender</th>
                    <th class="px-4 py-2 text-left">Birthdate</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $employee->EmpID }}</td>
                    <td class="px-4 py-2">{{ $employee->FirstName }} {{ $employee->LastName }}</td>
                    <td class="px-4 py-2">{{ $employee->Position }}</td>
                    <td class="px-4 py-2">${{ number_format($employee->Salary, 2) }}</td>
                    <td class="px-4 py-2">{{ $employee->Gender }}</td>
                    <td class="px-4 py-2">{{ date('F d, Y', strtotime($employee->Birthdate)) }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('employees.edit', $employee->EmpID) }}" 
                           class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                           Edit
                        </a>
                        <form action="{{ route('employees.destroy', $employee->EmpID) }}" 
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Delete this employee?')">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>
                        <a href="{{ route('users.create', ['EmpID' => $employee->EmpID]) }}" 
                           class="inline-block bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                           Make Account
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
