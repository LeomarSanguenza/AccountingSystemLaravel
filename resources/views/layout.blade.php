<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Accounting System')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    body { font-family: 'Inter', sans-serif; }
    
    /* Sidebar animations */
    #sidebar.collapsed:hover {
      width: 16rem;
    }
    #sidebar.collapsed:hover .sidebar-label {
      display: inline;
    }
    #sidebar.collapsed:hover ~ #mainContent {
      margin-left: 16rem;
    }
    
    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 3px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
    
    /* Navbar gradient */
    .navbar-gradient {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    /* Active sidebar item */
    .sidebar-item.active {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }
    
    /* Notification badge */
    .notification-badge {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }
    
    /* Card hover effects */
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-gray-50">

<!-- NAVBAR -->
<nav class="navbar-gradient text-white px-6 py-4 flex justify-between items-center shadow-lg fixed w-full top-0 z-50">
  <div class="flex items-center space-x-4">
    <!-- Hamburger -->
    <button id="sidebarToggle" class="p-2 hover:bg-white/20 rounded-lg transition-colors duration-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
    
    <!-- Brand -->
    <div class="flex items-center space-x-3">
      <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
      </div>
      <span class="text-xl font-bold">Accounting System</span>
    </div>
    
    <!-- Fund Type Info -->
    @if(Auth::check() && Auth::user()->fundTypeRelation)
      <div class="hidden md:flex items-center space-x-2 bg-white/20 rounded-lg px-3 py-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <span class="text-sm font-medium">
          {{ Auth::user()->fundTypeRelation->code }} - {{ Auth::user()->fundTypeRelation->description }}
        </span>
      </div>
    @endif
  </div>
  
  <!-- Right side -->
  <div class="flex items-center space-x-4">
    <!-- User Info -->
    <div class="hidden md:flex items-center space-x-3">
      <div class="text-right">
        <p class="text-sm font-medium">{{ Auth::user()->FirstName }} {{ Auth::user()->LastName }}</p>
        <p class="text-xs text-white/70">
          @if(Auth::user()->roles->isNotEmpty())
            {{ Auth::user()->roles->first()->name }}
          @else
            {{ Auth::user()->UserRole }}
          @endif
        </p>
      </div>
      <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
      </div>
    </div>
    
    <!-- Settings -->
    <a href="{{ route('users.editFundType', Auth::id()) }}" 
       class="p-2 hover:bg-white/20 rounded-lg transition-colors duration-200" 
       title="Settings">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
      </svg>
    </a>
    
    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST" class="inline">
      @csrf
      <button type="submit" 
              class="p-2 hover:bg-white/20 rounded-lg transition-colors duration-200" 
              title="Logout">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
        </svg>
      </button>
    </form>
  </div>
</nav>

<!-- SIDEBAR (starts collapsed) -->
<nav id="sidebar"
     class="bg-white border-r h-screen fixed top-16 left-0 p-4 shadow-lg transition-all duration-300 collapsed w-16 custom-scrollbar overflow-y-auto">
  <ul class="space-y-2">

    <!-- Dashboard -->
    <li>
      <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 0h8"/>
        </svg>
        <span class="sidebar-label hidden font-medium">Dashboard</span>
      </a>
    </li>

    <!-- Employees - Only for HR and Admin -->
    @can('view employees')
    <li>
      <a href="{{ route('employees.index') }}" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span class="sidebar-label hidden font-medium">Employees</span>
      </a>
    </li>
    @endcan

    <!-- Users - Only for Admin -->
    @can('manage users')
    <li>
      <a href="{{ route('user.index') }}" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" class="h-5 w-5 flex-shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
        </svg>
        <span class="sidebar-label hidden font-medium">Users</span>
      </a>
    </li>
    @endcan

    <!-- Disbursements -->
    @can('view disbursements')
    <li>
      <a href="{{ route('disbursements.index') }}" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="sidebar-label hidden font-medium">Disbursements</span>
      </a>
    </li>
    @endcan

    <!-- Obligations -->
    @can('view obligations')
    <li>
      <a href="{{ route('obligations.index') }}" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 flex-shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
        </svg>
        <span class="sidebar-label hidden font-medium">OBRs</span>
      </a>
    </li>
    @endcan

    <!-- Journals -->
    @can('view journals')
    <li>
      <a href="{{ route('journals.index') }}" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 flex-shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
        </svg>
        <span class="sidebar-label hidden font-medium">Journals</span>
      </a>
    </li>
    @endcan

    <!-- Tools - Only for Admin -->
    @can('manage system')
    <li>
      <a href="{{ route('tools.index') }}" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 flex-shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
        </svg>
        <span class="sidebar-label hidden font-medium">System Tools</span>
      </a>
    </li>
    @endcan

    <!-- Divider -->
    <li class="pt-4">
      <div class="border-t border-gray-200"></div>
    </li>

    <!-- Quick Actions -->
    <li class="pt-2">
      <p class="sidebar-label hidden text-xs font-semibold text-gray-400 uppercase tracking-wider px-3">Quick Actions</p>
    </li>

    <!-- Reports -->
    @can('view reports')
    <li>
      <a href="#" class="sidebar-item flex items-center space-x-3 text-gray-700 hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 flex-shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
        </svg>
        <span class="sidebar-label hidden font-medium">Reports</span>
      </a>
    </li>
    @endcan

  </ul>
</nav>

<!-- MAIN -->
<main id="mainContent" class="mt-16 ml-16 p-6 transition-all duration-300">
  @yield('content')
</main>

<script>
  const toggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const main = document.getElementById('mainContent');

  // restore previous state
  if (localStorage.getItem('sidebar-collapsed') === 'false') {
    sidebar.classList.remove('collapsed', 'w-16');
    sidebar.classList.add('w-64');
    main.classList.remove('ml-16');
    main.classList.add('ml-64');
    document.querySelectorAll('.sidebar-label').forEach(el => el.classList.remove('hidden'));
  }

  toggle.addEventListener('click', () => {
    const isCollapsed = sidebar.classList.contains('collapsed');

    if (isCollapsed) {
      // expand
      sidebar.classList.remove('collapsed', 'w-16');
      sidebar.classList.add('w-64');
      main.classList.remove('ml-16');
      main.classList.add('ml-64');
      document.querySelectorAll('.sidebar-label').forEach(el => el.classList.remove('hidden'));
      localStorage.setItem('sidebar-collapsed', 'false');
    } else {
      // collapse
      sidebar.classList.add('collapsed');
      sidebar.classList.remove('w-64');
      sidebar.classList.add('w-16');
      main.classList.remove('ml-64');
      main.classList.add('ml-16');
      document.querySelectorAll('.sidebar-label').forEach(el => el.classList.add('hidden'));
      localStorage.setItem('sidebar-collapsed', 'true');
    }
  });

  // init select2
  // $(function() {
  //   $('.js-account-select').select2({
  //     placeholder: "Search account code...",
  //     allowClear: true
  //   });
  // });
</script>
</body>
</html>
