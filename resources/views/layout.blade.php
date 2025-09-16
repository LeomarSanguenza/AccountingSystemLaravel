<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Laravel App')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/css/app.css')

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    /* let hover temporarily expand collapsed sidebar */
    #sidebar.collapsed:hover {
      width: 16rem;
    }
    #sidebar.collapsed:hover .sidebar-label {
      display: inline;
    }
    #sidebar.collapsed:hover ~ #mainContent {
      margin-left: 16rem;
    }
  </style>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow-md fixed w-full top-0 z-50">
  <div class="flex items-center space-x-4">
    <!-- Hamburger -->
    <button id="sidebarToggle" class="p-2 hover:bg-blue-500 rounded">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
    <a href="{{ route('employees.index') }}" class="text-lg font-semibold">Accounting Management System</a>
  </div>
  <form action="{{ route('logout') }}" method="POST">@csrf
    <button type="submit" class="hover:underline">Logout</button>
  </form>
</nav>

<!-- SIDEBAR (starts collapsed) -->
<nav id="sidebar"
     class="bg-white border-r h-screen fixed top-16 left-0 p-4 shadow transition-all duration-300 collapsed w-16">
  <ul class="space-y-3">

    <!-- Dashboard -->
    <li>
      <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 0h8"/>
        </svg>
        <span class="sidebar-label hidden">Dashboard</span>
      </a>
    </li>

    <!-- Employees -->
    <li>
      <a href="{{ route('employees.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A4 4 0 017 17h10a4 4 0 011.879.804M15 11a3 3 0 10-6 0 3 3 0 006 0z"/>
        </svg>
        <span class="sidebar-label hidden">Employees</span>
      </a>
    </li>

    <!-- Users -->
    <li>
      <a href="{{ route('user.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" class="h-5 w-5 flex-shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 4a1 1 0 011-1h16a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/>
        </svg>
        <span class="sidebar-label hidden">Users</span>
      </a>
    </li>

    <!-- Disbursements -->
    <li>
      <a href="{{ route('disbursements.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="sidebar-label hidden">Disbursements</span>
      </a>
    </li>

    <!-- Journal Books -->
    <li>
      <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="h-5 w-5 flex-shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25
                   A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292
                   m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25
                   A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292
                   m0-14.25v14.25" />
        </svg>
        <span class="sidebar-label hidden">Journal Books</span>
      </a>
    </li>
    <li>
      <a href="{{ route('obligations.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v7.5m2.25-6.466a9.016 9.016 0 0 0-3.461-.203c-.536.072-.974.478-1.021 1.017a4.559 4.559 0 0 0-.018.402c0 .464.336.844.775.994l2.95 1.012c.44.15.775.53.775.994 0 .136-.006.27-.018.402-.047.539-.485.945-1.021 1.017a9.077 9.077 0 0 1-3.461-.203M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
      </svg>
        <span class="sidebar-label hidden">OBR Lists</span>
      </a>
    </li>

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
  $(function() {
    $('.js-account-select').select2({
      placeholder: "Search account code...",
      allowClear: true
    });
  });
</script>
</body>
</html>
