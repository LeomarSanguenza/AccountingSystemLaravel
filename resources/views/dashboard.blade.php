@extends('layout')

@section('title', 'Dashboard - Accounting System')

@section('content')
<div class="space-y-6">
  <!-- Welcome Section -->
  <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-6 text-white">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold mb-2">
          Welcome back, {{ Auth::user()->FirstName }}!
        </h1>
        <p class="text-blue-100">
          Here's what's happening with your accounting system today.
        </p>
      </div>
      <div class="hidden md:block">
        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
          <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @can('view disbursements')
    <!-- Total Disbursements -->
    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <div class="ml-4">
          <p class="text-sm font-medium text-gray-600">Total Disbursements</p>
          <p class="text-2xl font-bold text-gray-900">₱2,450,000</p>
          <p class="text-sm text-green-600">+12% from last month</p>
        </div>
      </div>
    </div>
    @endcan

    @can('view obligations')
    <!-- Pending OBRs -->
    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <div class="ml-4">
          <p class="text-sm font-medium text-gray-600">Pending OBRs</p>
          <p class="text-2xl font-bold text-gray-900">24</p>
          <p class="text-sm text-yellow-600">Requires attention</p>
        </div>
      </div>
    </div>
    @endcan

    @can('view employees')
    <!-- Active Employees -->
    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
        </div>
        <div class="ml-4">
          <p class="text-sm font-medium text-gray-600">Active Employees</p>
          <p class="text-2xl font-bold text-gray-900">156</p>
          <p class="text-sm text-blue-600">All departments</p>
        </div>
      </div>
    </div>
    @endcan

    @can('view journals')
    <!-- Journal Entries -->
    <div class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 003 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
            </svg>
          </div>
        </div>
        <div class="ml-4">
          <p class="text-sm font-medium text-gray-600">Journal Entries</p>
          <p class="text-2xl font-bold text-gray-900">89</p>
          <p class="text-sm text-purple-600">This month</p>
        </div>
      </div>
    </div>
    @endcan
  </div>

  <!-- Main Content Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Recent Activities -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Recent Activities</h3>
        </div>
        <div class="p-6">
          <div class="space-y-4">
            @can('view disbursements')
            <div class="flex items-start space-x-3">
              <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-sm text-gray-900">
                  <span class="font-medium">Disbursement #DV-2024-001</span> was approved
                </p>
                <p class="text-xs text-gray-500">2 hours ago</p>
              </div>
            </div>
            @endcan

            @can('view obligations')
            <div class="flex items-start space-x-3">
              <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                  <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3h4v1a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-sm text-gray-900">
                  <span class="font-medium">New OBR #OBR-2024-045</span> submitted for review
                </p>
                <p class="text-xs text-gray-500">4 hours ago</p>
              </div>
            </div>
            @endcan

            @can('view journals')
            <div class="flex items-start space-x-3">
              <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                  <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-sm text-gray-900">
                  <span class="font-medium">Journal Entry #JE-2024-089</span> posted successfully
                </p>
                <p class="text-xs text-gray-500">6 hours ago</p>
              </div>
            </div>
            @endcan

            @can('view employees')
            <div class="flex items-start space-x-3">
              <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-sm text-gray-900">
                  <span class="font-medium">Employee record</span> updated for John Doe
                </p>
                <p class="text-xs text-gray-500">1 day ago</p>
              </div>
            </div>
            @endcan
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions & Notifications -->
    <div class="space-y-6">
      
      <!-- Quick Actions -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
        </div>
        <div class="p-6 space-y-3">
          @can('create disbursements')
          <a href="{{ route('disbursements.create') }}" 
             class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">New Disbursement</span>
          </a>
          @endcan

          @can('create employees')
          <a href="{{ route('employees.create') }}" 
             class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">Add Employee</span>
          </a>
          @endcan

          @can('create journals')
          <a href="{{ route('journals.create') }}" 
             class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">New Journal Entry</span>
          </a>
          @endcan

          @can('view reports')
          <a href="#" 
             class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">Generate Report</span>
          </a>
          @endcan
        </div>
      </div>

      <!-- Notifications -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
            <span class="notification-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
              3
            </span>
          </div>
        </div>
        <div class="p-6 space-y-4">
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0 w-2 h-2 bg-red-400 rounded-full mt-2"></div>
            <div>
              <p class="text-sm text-gray-900 font-medium">Budget Alert</p>
              <p class="text-xs text-gray-500">Department budget 85% utilized</p>
            </div>
          </div>
          
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0 w-2 h-2 bg-yellow-400 rounded-full mt-2"></div>
            <div>
              <p class="text-sm text-gray-900 font-medium">Approval Required</p>
              <p class="text-xs text-gray-500">5 disbursements pending approval</p>
            </div>
          </div>
          
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0 w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
            <div>
              <p class="text-sm text-gray-900 font-medium">System Update</p>
              <p class="text-xs text-gray-500">New features available</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Recent Transactions Table -->
  @can('view disbursements')
  <div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
      <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900">Recent Transactions</h3>
        <a href="{{ route('disbursements.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
          View all →
        </a>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Transaction ID
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Type
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Amount
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Status
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Date
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              DV-2024-001
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Disbursement
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              ₱125,000.00
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                Approved
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Dec 15, 2024
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              OBR-2024-045
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Obligation
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              ₱75,500.00
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                Pending
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Dec 14, 2024
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              JE-2024-089
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Journal Entry
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              ₱50,000.00
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                Posted
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Dec 13, 2024
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  @endcan

</div>
@endsection