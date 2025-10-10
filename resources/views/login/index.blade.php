<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Accounting System</title>
  @vite('css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>

    @if(session('error'))
      <div class="mb-4 p-3 rounded bg-red-100 text-red-700 text-sm">
        {{ session('error') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-4 p-3 rounded bg-red-100 text-red-700 text-sm">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
      @csrf
      <div className="mb-4">
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" id="username" 
               class="mt-1 block w-full rounded-md border-gray-300 h-10 shadow-sm 
                      focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
               required autofocus>
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10
                      focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
               required>
      </div>
      <button type="submit" 
              class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md 
                     hover:bg-indigo-700 focus:outline-none focus:ring-2 
                     focus:ring-indigo-500 focus:ring-offset-1">
        Login
      </button>
    </form>
  </div>
</body>
</html>
