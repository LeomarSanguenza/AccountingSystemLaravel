<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Accounting System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body { font-family: 'Inter', sans-serif; }
    .login-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      position: relative;
      overflow: hidden;
    }
    .login-bg::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
      opacity: 0.3;
    }
    .glass-effect {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .input-focus {
      transition: all 0.3s ease;
      min-height: 48px !important;
      height: 48px;
      font-size: 16px;
      line-height: 1.5;
      padding: 12px 16px 12px 40px;
    }
    .input-focus:focus {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Fallback styles in case Tailwind doesn't load */
    input[type="text"], input[type="password"] {
      min-height: 48px !important;
      height: 48px !important;
      font-size: 16px !important;
      line-height: 1.5 !important;
      padding: 12px 16px 12px 40px !important;
      border: 1px solid #d1d5db !important;
      border-radius: 8px !important;
      width: 100% !important;
      box-sizing: border-box !important;
      display: block !important;
      background-color: white !important;
      color: #111827 !important;
    }
    
    input[type="text"]:focus, input[type="password"]:focus {
      outline: none !important;
      border-color: #6366f1 !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
    }
    
    button[type="submit"] {
      min-height: 48px !important;
      height: 48px !important;
      font-size: 16px !important;
      font-weight: 600 !important;
      padding: 12px 16px !important;
      border-radius: 8px !important;
      width: 100% !important;
      border: none !important;
      cursor: pointer !important;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
      color: white !important;
    }
    
    /* Ensure proper form styling */
    .glass-effect {
      background: rgba(255, 255, 255, 0.95) !important;
      backdrop-filter: blur(20px) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 16px !important;
      padding: 32px !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
    }
    
    /* Icon positioning */
    .relative .absolute {
      position: absolute !important;
      top: 50% !important;
      transform: translateY(-50%) !important;
      left: 12px !important;
      pointer-events: none !important;
    }
    
    /* Label styling */
    label {
      display: block !important;
      font-size: 14px !important;
      font-weight: 600 !important;
      color: #374151 !important;
      margin-bottom: 8px !important;
    }
    .btn-gradient {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transition: all 0.3s ease;
    }
    .btn-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    .floating-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }
    .shape {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }
    .shape:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }
    .shape:nth-child(2) {
      width: 120px;
      height: 120px;
      top: 60%;
      right: 10%;
      animation-delay: 2s;
    }
    .shape:nth-child(3) {
      width: 60px;
      height: 60px;
      bottom: 20%;
      left: 20%;
      animation-delay: 4s;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }
  </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center p-4">
  <div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
  
  <div class="w-full max-w-md relative z-10">
    <!-- Logo/Brand Section -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
      </div>
      <h1 class="text-3xl font-bold text-white mb-2">Accounting System</h1>
      <p class="text-white/80">Welcome back! Please sign in to continue.</p>
    </div>

    <!-- Login Form -->
    <div class="glass-effect rounded-2xl shadow-2xl p-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign In</h2>

      @if(session('error'))
        <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-red-700 text-sm font-medium">{{ session('error') }}</span>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
          <div class="flex items-start">
            <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <div>
              @foreach($errors->all() as $error)
                <p class="text-red-700 text-sm">{{ $error }}</p>
              @endforeach
            </div>
          </div>
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf
        <div>
          <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
            <input type="text" name="username" id="username" 
                   class="input-focus block w-full pl-10 pr-3 py-3 min-h-[48px] border border-gray-300 rounded-lg 
                          focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                          placeholder-gray-400 text-gray-900 text-base" 
                   placeholder="Enter your username"
                   value="{{ old('username') }}"
                   required autofocus>
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <input type="password" name="password" id="password" 
                   class="input-focus block w-full pl-10 pr-3 py-3 min-h-[48px] border border-gray-300 rounded-lg 
                          focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                          placeholder-gray-400 text-gray-900 text-base" 
                   placeholder="Enter your password"
                   required>
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember-me" name="remember" type="checkbox" 
                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
              Remember me
            </label>
          </div>
        </div>

        <button type="submit" 
                class="btn-gradient w-full text-white py-3 px-4 rounded-lg font-semibold
                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                       disabled:opacity-50 disabled:cursor-not-allowed">
          <span class="flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            Sign In
          </span>
        </button>
      </form>

      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
          Secure access to your accounting dashboard
        </p>
      </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-8">
      <p class="text-white/60 text-sm">
        © {{ date('Y') }} Accounting System. All rights reserved.
      </p>
    </div>
  </div>

  <script>
    // Ensure proper styling is applied even if CSS doesn't load immediately
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
      inputs.forEach(input => {
        // Ensure minimum height
        input.style.minHeight = '48px';
        input.style.height = '48px';
        input.style.fontSize = '16px';
        input.style.lineHeight = '1.5';
        
        // Add focus handlers for better UX
        input.addEventListener('focus', function() {
          this.style.borderColor = '#6366f1';
          this.style.boxShadow = '0 0 0 3px rgba(99, 102, 241, 0.1)';
        });
        
        input.addEventListener('blur', function() {
          this.style.borderColor = '#d1d5db';
          this.style.boxShadow = 'none';
        });
      });
      
      // Ensure button styling
      const button = document.querySelector('button[type="submit"]');
      if (button) {
        button.style.minHeight = '48px';
        button.style.height = '48px';
        button.style.fontSize = '16px';
      }
    });
    
    // Handle form submission loading state
    document.querySelector('form').addEventListener('submit', function() {
      const button = this.querySelector('button[type="submit"]');
      button.disabled = true;
      button.innerHTML = '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Signing in...</span>';
    });
  </script>
</body>
</html>
