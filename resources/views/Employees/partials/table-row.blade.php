{{-- Employee Table Row Partial --}}
<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        {{ $employee->EmpID }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                    <span class="text-sm font-medium text-indigo-700">
                        {{ strtoupper(substr($employee->FirstName, 0, 1) . substr($employee->LastName, 0, 1)) }}
                    </span>
                </div>
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    {{ $employee->FirstName }} {{ $employee->LastName }}
                </div>
                <div class="text-sm text-gray-500">
                    Employee ID: {{ $employee->EmpID }}
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div class="text-sm text-gray-900">{{ $employee->Position }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-mono">
        ₱{{ number_format($employee->Salary, 2) }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $employee->Gender === 'Male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
            {{ $employee->Gender }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ \Carbon\Carbon::parse($employee->Birthdate)->format('M d, Y') }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex items-center space-x-2">
            <x-action-buttons 
                :edit-route="route('employees.edit', $employee->EmpID)"
                :delete-route="route('employees.destroy', $employee->EmpID)"
                delete-confirm="Are you sure you want to delete this employee?"
                :custom-actions="[
                    [
                        'type' => 'link',
                        'route' => route('users.create', ['EmpID' => $employee->EmpID]),
                        'label' => 'Create Account',
                        'class' => 'bg-green-600 hover:bg-green-700',
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
                    ]
                ]" />
        </div>
    </td>
</tr>