<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - Accounting System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-lg p-8 text-center">
        <!-- Error Icon -->
        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
        </div>

        <!-- Error Message -->
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Access Denied</h1>
        <p class="text-gray-600 mb-6">
            You don't have permission to access this resource. Please contact your administrator if you believe this is an error.
        </p>

        <!-- User Info -->
        @auth
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <p class="text-sm text-gray-700">
                <span class="font-medium">Logged in as:</span> {{ Auth::user()->FirstName }} {{ Auth::user()->LastName }}
            </p>
            <p class="text-sm text-gray-500">
                <span class="font-medium">Role:</span> 
                @if(Auth::user()->roles->isNotEmpty())
                    {{ Auth::user()->roles->first()->name }}
                @else
                    {{ Auth::user()->UserRole }}
                @endif
            </p>
        </div>
        @endauth

        <!-- Action Buttons -->
        <div class="space-y-3">
            <a href="{{ route('dashboard') }}" 
               class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200 inline-block">
                Go to Dashboard
            </a>
            
            <button onclick="history.back()" 
                    class="w-full bg-gray-200 text-gray-800 py-3 px-4 rounded-lg font-medium hover:bg-gray-300 transition-colors duration-200">
                Go Back
            </button>
        </div>

        <!-- Contact Info -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-xs text-gray-500">
                Need help? Contact your system administrator or IT support.
            </p>
        </div>
    </div>
</body>
</html>