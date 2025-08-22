<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
      <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css') <!-- Make sure Tailwind builds this -->
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow-md fixed w-full top-0 z-50">
        <a href="{{ route('employees.index') }}" class="text-lg font-semibold">Accounting Management System</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:underline">Logout</button>
        </form>
    </nav>

    <!-- Sidebar -->
    <nav class="bg-white border-r w-64 h-screen fixed top-16 left-0 p-6 shadow">
        <ul class="space-y-3">
            <li><a href="#" class="block text-gray-700 hover:text-blue-600">Dashboard</a></li>
            <li><a href="{{ route('employees.index') }}" class="block text-gray-700 hover:text-blue-600">Employees Lists</a></li>
            <li><a href="{{ route('user.index') }}" class="block text-gray-700 hover:text-blue-600">Users Accounts Lists</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600">Disbursement Voucher</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600">Reports</a></li>
            <li><a href="#" class="block text-gray-700 hover:text-blue-600">Settings</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="ml-64 mt-16 p-6">
        @yield('content')
    </main>

</body>
</html>
