<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dasbor Admin - Desa Sukaraja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @stack('styles')
  <link rel="icon" href="https://placehold.co/32x32/10b981/ffffff?text=DS" type="image/x-icon">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f1f5f9;
    }

    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }

    /* Shared small animations used across admin pages */
    .animate-fadeIn {
      animation: fadeIn 420ms ease-out forwards;
      opacity: 0;
    }

    .animate-fadeInUp {
      animation: fadeInUp 560ms cubic-bezier(.2, .9, .2, 1) forwards;
      opacity: 0;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(6px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(18px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Respect users who prefer reduced motion */
    @media (prefers-reduced-motion: reduce) {

      .animate-fadeIn,
      .animate-fadeInUp,
      * {
        animation: none !important;
        transition: none !important;
      }
    }
  </style>
</head>

<body class="antialiased text-slate-600">
  @php
    $adminName = session('admin_name', 'Admin Desa');
    $initial = strtoupper(mb_substr($adminName, 0, 1));
    $avatarUrl = session('admin_avatar') ? asset('storage/' . session('admin_avatar')) : "https://placehold.co/40x40/94a3b8/ffffff?text={$initial}";
  @endphp
  <div class="flex h-screen bg-slate-100">
    <!-- Sidebar -->
    <aside id="sidebar"
      class="w-64 bg-white shadow-lg flex flex-col fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-30">
      <div class="flex items-center justify-center h-20 border-b">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
          <img src="https://placehold.co/40x40/10b981/ffffff?text=DS" alt="Logo Desa Sukaraja"
            class="rounded-full">
          <span class="text-xl font-bold text-slate-800">Admin Sukaraja</span>
        </a>
      </div>
      <nav class="flex-1 px-4 py-6 space-y-2">
        {{-- [FIX] Logic for active sidebar menu --}}
        <a href="{{ route('admin.dashboard') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>Dashboard</a>
        <a href="{{ route('admin.profil.index') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.profil.*') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="info" class="w-5 h-5 mr-3"></i>Profil Desa</a>
        <a href="{{ route('admin.berita.index') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.berita.*') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="newspaper" class="w-5 h-5 mr-3"></i>Berita</a>
        <a href="{{ route('admin.galeri.index') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.galeri.*') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="image" class="w-5 h-5 mr-3"></i>Galeri</a>
        <a href="{{ route('admin.infografis.index') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.infografis.*') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="bar-chart-3" class="w-5 h-5 mr-3"></i>Infografis</a>
        <a href="{{ route('admin.sotk.index') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.sotk.*') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="users" class="w-5 h-5 mr-3"></i>SOTK</a>
        <a href="{{ route('admin.pengaduan.index') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.pengaduan.*') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="message-square" class="w-5 h-5 mr-3"></i>Pengaduan</a>
        @if(session('admin_role') === 'super_admin')
        <a href="{{ route('admin.users.index') }}"
          class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-emerald-500 text-white' : 'text-slate-700 hover:bg-slate-200' }} transition-colors"><i
            data-lucide="shield-check" class="w-5 h-5 mr-3"></i>Kelola Admin</a>
        @endif

      </nav>
      <div class="px-4 py-4 border-t">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit"
            class="flex w-full items-center px-4 py-2 text-slate-700 hover:bg-red-100 hover:text-red-600 rounded-lg transition-colors">
            <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>Keluar
          </button>
        </form>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Header -->
      <header class="bg-white shadow-md z-20">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
          <button id="mobile-menu-btn" class="md:hidden text-slate-700"><i data-lucide="menu"
              class="w-6 h-6"></i></button>
          <h1 class="text-xl font-semibold text-slate-800 hidden md:block">Selamat Datang, {{ session('admin_name', 'Admin') }}!</h1>
          <div class="flex items-center space-x-4">
            <div class="relative hidden md:block">
              <i data-lucide="search"
                class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
              <input type="text" placeholder="Cari..."
                class="pl-10 pr-4 py-2 w-full border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>
            <button class="relative text-slate-600 hover:text-emerald-500">
              <i data-lucide="bell" class="w-6 h-6"></i>
              <span
                class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
            </button>
            <div class="relative">
              <button id="admin-menu-btn" class="flex items-center space-x-2">
                <img src="{{ $avatarUrl }}" alt="Avatar Admin"
                  class="w-10 h-10 rounded-full object-cover">
                <span class="hidden lg:block font-semibold">{{ session('admin_name', 'Admin Desa') }}</span>
                <i data-lucide="chevron-down" class="w-4 h-4 hidden lg:block"></i>
              </button>
              <div id="admin-menu-dropdown" class="hidden absolute right-0 mt-2 w-52 bg-white border border-slate-200 rounded-lg shadow-lg z-50 overflow-hidden">
                <div class="px-4 py-3 border-b border-slate-100">
                  <p class="text-sm font-semibold text-slate-800">{{ session('admin_name', 'Admin Desa') }}</p>
                  <p class="text-xs text-slate-500">{{ session('admin_email', '-') }}</p>
                  <p class="text-[11px] text-emerald-600 mt-1 uppercase font-bold">{{ session('admin_role', 'admin') }}</p>
                </div>
                @if(session('admin_role') === 'super_admin')
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                  <i data-lucide="shield-check" class="w-4 h-4"></i> Kelola Admin
                </a>
                @endif
                <form method="POST" action="{{ route('admin.logout') }}">
                  @csrf
                  <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 text-left">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-6">
        @if(session('success'))
          <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
            {{ session('error') }}
          </div>
        @endif
        @yield('content')
      </main>

    </div>
    <!-- Overlay for mobile sidebar -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>
  </div>
  <script>
    function initAdminImageCards() {
      const cards = document.querySelectorAll('[data-image-card]');
      cards.forEach((card) => {
        const fileInputId = card.getAttribute('data-input-id');
        if (!fileInputId) return;

        const fileInput = document.getElementById(fileInputId);
        const preview = card.querySelector('[data-image-preview]');
        const editBtn = card.querySelector('[data-image-edit]');
        const removeBtn = card.querySelector('[data-image-remove]');
        const removeInputId = card.getAttribute('data-remove-input-id');
        const removeInput = removeInputId ? document.getElementById(removeInputId) : null;
        const placeholder = preview?.dataset?.placeholder || '';
        const confirmMessage = card.getAttribute('data-remove-confirm') || 'Hapus gambar saat ini?';

        if (editBtn && fileInput) {
          editBtn.addEventListener('click', () => fileInput.click());
        }

        if (removeBtn) {
          removeBtn.addEventListener('click', () => {
            if (!window.confirm(confirmMessage)) return;

            if (removeInput) removeInput.checked = true;
            if (fileInput) fileInput.value = '';
            if (preview && placeholder) preview.src = placeholder;
          });
        }

        if (fileInput && preview) {
          fileInput.addEventListener('change', (event) => {
            const file = event.target.files && event.target.files[0];
            if (!file) return;

            if (removeInput) removeInput.checked = false;

            const reader = new FileReader();
            reader.onload = (e) => {
              preview.src = e.target?.result;
            };
            reader.readAsDataURL(file);
          });
        }
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      lucide.createIcons();
      initAdminImageCards();
      const sidebar = document.getElementById('sidebar');
      const mobileMenuBtn = document.getElementById('mobile-menu-btn');
      const sidebarOverlay = document.getElementById('sidebar-overlay');
      const adminMenuBtn = document.getElementById('admin-menu-btn');
      const adminMenuDropdown = document.getElementById('admin-menu-dropdown');

      function toggleSidebar() {
        if (sidebar && sidebarOverlay) {
          sidebar.classList.toggle('-translate-x-full');
          sidebarOverlay.classList.toggle('hidden');
        }
      }
      
      if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          toggleSidebar();
        });
      }
      
      if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', toggleSidebar);
      }
      
      // Close sidebar when clicking on a menu item
      const sidebarLinks = sidebar?.querySelectorAll('nav a');
      if (sidebarLinks) {
        sidebarLinks.forEach(link => {
          link.addEventListener('click', function() {
            if (!sidebar.classList.contains('-translate-x-full')) {
              toggleSidebar();
            }
          });
        });
      }

      if (adminMenuBtn && adminMenuDropdown) {
        adminMenuBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          adminMenuDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
          if (!adminMenuDropdown.contains(e.target) && !adminMenuBtn.contains(e.target)) {
            adminMenuDropdown.classList.add('hidden');
          }
        });
      }
    });
  </script>
  @stack('scripts')
</body>

</html>
