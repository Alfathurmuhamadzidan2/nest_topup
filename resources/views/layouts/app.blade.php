<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'NestTopup')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg:#06060b;
      --panel:#0b1220;
      --muted:#aeb8c8;
      --accent:#f59e0b;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: var(--bg);
      color: #e6eef8;
    }
    .menu-link{
      @apply flex items-center gap-3 px-3 py-2 rounded text-gray-300 hover:bg-[#111827] transition;
    }
    .menu-active{
      @apply bg-[#111827] text-orange-400 border-l-4 border-orange-400;
    }
  </style>
</head>

<body class="min-h-screen flex" x-data="{ openSidebar: true }">

@auth
<aside
  class="bg-[var(--panel)] border-r border-gray-800 flex flex-col transition-all duration-500 shadow-xl overflow-hidden"
  :class="openSidebar ? 'w-64' : 'w-20'"
>
  <div class="p-5 flex items-center justify-between border-b border-gray-800">
    <div class="flex items-center gap-3">
      <svg class="w-9 h-9 text-orange-400 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
        <path d="M2 17l10 5 10-5"/>
      </svg>
      <div class="text-2xl text-orange-400 font-semibold tracking-wide"
           x-show="openSidebar"
           x-transition>
           NestTopup
      </div>
    </div>

    <button @click="openSidebar = !openSidebar"
      class="text-gray-400 hover:text-orange-400 transition transform hover:scale-110">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>

  <nav class="flex-1 p-3">
    <ul class="space-y-1">
      @php $role = auth()->user()->role ?? null; @endphp

      @if($role === 'admin')
        <li>
          <a href="{{ route('admin.dashboard') }}"
             class="menu-link {{ request()->routeIs('admin.dashboard') ? 'menu-active' : '' }} hover:translate-x-1">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
            </svg>
            <span x-show="openSidebar" x-transition>Dashboard</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin.products') }}"
             class="menu-link {{ request()->routeIs('admin.products') ? 'menu-active' : '' }} hover:translate-x-1">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
            <span x-show="openSidebar" x-transition>Produk</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin.transactions') }}"
             class="menu-link {{ request()->routeIs('admin.transactions') ? 'menu-active' : '' }} hover:translate-x-1">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor">
              <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span x-show="openSidebar" x-transition>Transaksi</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin.users.index') }}"
             class="menu-link {{ request()->routeIs('admin.users') ? 'menu-active' : '' }} hover:translate-x-1">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor">
              <circle cx="12" cy="7" r="4"/>
              <path d="M6 21v-2a6 6 0 0112 0v2"/>
            </svg>
            <span x-show="openSidebar" x-transition>Pengguna</span>
          </a>
        </li>

      @else
        <li>
          <a href="{{ route('user.dashboard') }}"
             class="menu-link {{ request()->routeIs('user.dashboard') ? 'menu-active' : '' }} hover:translate-x-1">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor">
              <path d="M3 12l2-2m0 0l7-7 7 7"/>
            </svg>
            <span x-show="openSidebar" x-transition>Dashboard</span>
          </a>
        </li>

        <li>
          <a href="{{ route('user.transactions') }}"
             class="menu-link {{ request()->routeIs('user.transactions') ? 'menu-active' : '' }} hover:translate-x-1">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor">
              <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span x-show="openSidebar" x-transition>Transaksi</span>
          </a>
        </li>

        <li>
          <a href="{{ route('user.profile') }}"
             class="menu-link {{ request()->routeIs('user.profile') ? 'menu-active' : '' }} hover:translate-x-1">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor">
              <circle cx="12" cy="7" r="4"/>
              <path d="M6 21v-2a6 6 0 0112 0v2"/>
            </svg>
            <span x-show="openSidebar" x-transition>Profil</span>
          </a>
        </li>
      @endif
    </ul>
  </nav>

  <div class="p-4 border-t border-gray-800" x-show="openSidebar" x-transition>
    <div class="text-sm text-gray-400 mb-3 truncate">{{ auth()->user()->email }}</div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="w-full py-2 rounded-md bg-orange-500 hover:bg-orange-400 text-black font-semibold shadow-md hover:shadow-orange-500/30 transition">
        Keluar
      </button>
    </form>
  </div>
</aside>
@endauth

<div class="flex-1">
  <header class="flex justify-between items-center px-6 py-4 border-b border-gray-800 bg-[#071025] backdrop-blur-md bg-opacity-80 shadow-md">
    <div class="flex items-center gap-4">
      <button @click="openSidebar = !openSidebar"
        class="sm:hidden text-gray-400 hover:text-orange-400 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <h1 class="text-xl font-semibold tracking-wide">@yield('title')</h1>
      @yield('topbar')
    </div>

    @auth
    <div class="text-sm text-gray-300">
      Halo, <span class="text-orange-400 font-semibold">{{ auth()->user()->name }}</span>
    </div>
    @endauth
  </header>

  <main class="p-6 animate-fadeIn">
    @if(session('success'))
      <div class="fixed right-6 top-6 bg-green-600 text-white px-4 py-2 rounded shadow animate-slideIn">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="fixed right-6 top-6 bg-red-600 text-white px-4 py-2 rounded shadow animate-slideIn">
        {{ session('error') }}
      </div>
    @endif

    @yield('content')
  </main>

  <footer class="p-6 text-center text-gray-400 border-t border-gray-800">
    &copy; {{ date('Y') }} NestTopup — All rights reserved.
  </footer>
</div>

</body>
</html>
