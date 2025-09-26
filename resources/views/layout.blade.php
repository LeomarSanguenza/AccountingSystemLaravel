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
    <a href="{{ route('users.editFundType', Auth::id()) }}" class="text-lg font-semibold">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
      </svg>

    </a>
    @if(Auth::check() && Auth::user()->fundTypeRelation)
      <span class="text-lg font-medium text-white-200">
          {{ Auth::user()->fundTypeRelation->code }} - {{ Auth::user()->fundTypeRelation->description }}
      </span>
    @endif
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

     <li>
      <a href="{{ route('roles.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>

        <span class="sidebar-label hidden">User Roles</span>
      </a>
    </li>

    <li>
      <a href="{{ route('fundtypes.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
        </svg>
        <span class="sidebar-label hidden">Fund Types</span>
      </a>
    </li>
    <li>
      <a href="{{ route('tags.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
      </svg>
        <span class="sidebar-label hidden">Tags</span>
      </a>
    </li>
    <li>
      <a href={{ route('subaccounts.index') }} class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
        </svg>
        <span class="sidebar-label hidden">Sub Accounts</span>
      </a>
    </li>
    <li>
      <a href="{{ route('barangays.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
        </svg>
        <span class="sidebar-label hidden">Barangay</span>
      </a>
    </li>
    <li>
      <a href="{{ route('banks.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
        </svg>
        <span class="sidebar-label hidden">Banks</span>
      </a>
    </li>
     <li>
      <a href="{{ route('payees.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <span class="sidebar-label hidden">Payee</span>
      </a>
    </li>
     <li>
      <a href="{{ route('signatories.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
        </svg>
        <span class="sidebar-label hidden">Signatories</span>
      </a>
    </li>
       <li>
      <a href="{{ route('offices.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
        </svg>

        <span class="sidebar-label hidden">Offices</span>
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
