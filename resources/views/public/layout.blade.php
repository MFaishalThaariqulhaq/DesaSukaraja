<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Desa Sukaraja')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
    }

    /* Tambahkan efek bayangan saat scroll */
    .scrolled {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
  @stack('styles')
</head>

<body class="bg-slate-50 text-slate-700">

  <!-- 🔹 HEADER: sticky + responsif -->
  <header id="main-header" class="fixed top-0 left-0 w-full bg-white z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-3">
      <a href="/" class="flex items-center space-x-2">
        <img src="{{ asset('assets/logo.png') }}"
          alt="Logo Desa Sukaraja"
          class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-full flex-shrink-0"
          onerror="this.src='https://placehold.co/48x48/10b981/ffffff?text=DS'">
        <div class="flex flex-col">
          <span class="text-xs md:text-sm font-semibold text-slate-800">PEMERINTAH DESA SUKARAJA</span>
          <span class="text-xs md:text-sm text-slate-600">KABUPATEN KARAWANG</span>
        </div>
      </a>

      <!-- Tombol menu untuk mobile -->
      <button id="menu-toggle" class="md:hidden text-slate-700 focus:outline-none">
        <i data-lucide="menu"></i>
      </button>

      <!-- Navigasi -->
      <nav id="nav-menu" class="hidden md:flex items-center space-x-6">
        <a href="/" class="text-slate-600 hover:text-emerald-600 font-medium {{ request()->is('/') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Home</a>
        <a href="/profil" class="text-slate-600 hover:text-emerald-600 font-medium {{ request()->is('profil') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Profil</a>
        <a href="/berita" class="text-slate-600 hover:text-emerald-600 font-medium {{ (request()->is('berita') || request()->is('berita/*')) ? 'border-b-4 border-emerald-500 pb-1' : '' }}">Berita</a>
        <a href="/#galeri" class="text-slate-600 hover:text-emerald-600 font-medium {{ (request()->is('galeri/*') || request()->routeIs('galeri.detail')) ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Galeri</a>
        <a href="/infografis" class="text-slate-600 hover:text-emerald-600 font-medium {{ request()->is('infografis*') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Infografis</a>
        <a href="/#sotk" class="text-slate-600 hover:text-emerald-600 font-medium {{ request()->is('#sotk') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">SOTK</a>
        <a href="/#pengaduan" class="text-slate-600 hover:text-emerald-600 font-medium {{ request()->is('#pengaduan') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Pengaduan</a>
      </nav>
    </div>

    <!-- Navigasi versi mobile -->
    <div id="mobile-menu" class="hidden bg-white border-t border-slate-200 md:hidden">
      <nav class="flex flex-col px-4 py-3 space-y-2">
        <a href="/" class="text-slate-700 hover:text-emerald-600 {{ request()->is('/') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Home</a>
        <a href="/profil" class="text-slate-700 hover:text-emerald-600 {{ request()->is('profil') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Profil</a>
        <a href="/berita" class="text-slate-700 hover:text-emerald-600 {{ request()->is('berita') || request()->is('berita/*') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Berita</a>
        <a href="/#galeri" class="text-slate-700 hover:text-emerald-600 {{ request()->is('#galeri') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Galeri</a>
        <a href="/infografis" class="text-slate-700 hover:text-emerald-600 {{ request()->is('infografis*') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Infografis</a>
        <a href="/#sotk" class="text-slate-700 hover:text-emerald-600 {{ request()->is('#sotk') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">SOTK</a>
        <a href="/#pengaduan" class="text-slate-700 hover:text-emerald-600 {{ request()->is('#pengaduan') ? 'border-b-2 border-emerald-500 pb-1' : '' }}">Pengaduan</a>
      </nav>
    </div>
  </header>


  <!-- Tambahkan padding agar konten tidak tertutup header -->
  <div class="pt-24"></div>
  @yield('content')

  <!-- 🔹 FOOTER -->
  <footer class="bg-slate-800 text-white pt-16 pb-8 mt-16">
    <div class="container mx-auto px-6">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-xl font-bold mb-4">Desa Sukaraja</h3>
          <p class="text-slate-300">Kecamatan Rawamerta, <br>Kabupaten Karawang, <br>Jawa Barat, Indonesia</p>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
          <ul class="space-y-2">
            <li><a href="#profil" class="text-slate-300 hover:text-emerald-400 transition">Profil Desa</a></li>
            <li><a href="#berita" class="text-slate-300 hover:text-emerald-400 transition">Berita Terkini</a></li>
            <li><a href="#pengaduan" class="text-slate-300 hover:text-emerald-400 transition">Layanan Pengaduan</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Hubungi Kami</h3>
          <p class="text-slate-300">Email: kontak@sukaraja.desa.id</p>
          <p class="text-slate-300">Telepon: (0267) 123-456</p>
          <div class="flex space-x-4 mt-4">
            <a href="#" class="text-slate-300 hover:text-emerald-400 transition"><i data-lucide="facebook"></i></a>
            <a href="#" class="text-slate-300 hover:text-emerald-400 transition"><i data-lucide="instagram"></i></a>
            <a href="#" class="text-slate-300 hover:text-emerald-400 transition"><i data-lucide="youtube"></i></a>
          </div>
        </div>
      </div>
      <hr class="border-t border-slate-700 my-8">
      <div class="text-center text-slate-400 text-sm">
        &copy; 2025 Pemerintah Desa Sukaraja. All rights reserved.
      </div>
    </div>
  </footer>

  <script>
    lucide.createIcons();

    // Header shadow saat scroll
    window.addEventListener('scroll', function() {
      const header = document.getElementById('main-header');
      if (window.scrollY > 10) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Toggle menu mobile
    document.getElementById('menu-toggle').addEventListener('click', function() {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });
  </script>
  @stack('scripts')
</body>

</html>