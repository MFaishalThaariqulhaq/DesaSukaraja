<header id="main-header" class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-slate-200/50">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <a href="/" class="flex items-center space-x-3 group">
      <div class="relative w-10 h-10 md:w-12 md:h-12 flex-shrink-0 transition-transform group-hover:rotate-12 duration-500">
        <img src="{{ asset('images/logo.png') }}"
             alt="Logo Desa Sukaraja"
             class="w-full h-full object-contain drop-shadow-sm"
             onerror="this.src='https://placehold.co/48x48/10b981/ffffff?text=DS'">
      </div>
      <div class="flex flex-col">
        <span class="text-xs md:text-sm font-bold text-slate-800 tracking-wide leading-tight group-hover:text-emerald-600 transition-colors">PEMERINTAH DESA SUKARAJA</span>
        <span class="text-[10px] md:text-xs font-medium text-slate-500 tracking-wider uppercase">Kabupaten Karawang</span>
      </div>
    </a>
    <!-- Desktop Menu -->
    <nav class="hidden lg:flex items-center gap-8">
      <a href="/" class="text-sm font-medium text-emerald-600 nav-link">Home</a>
      <a href="/profil" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors nav-link">Profil</a>
      <a href="/berita" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors nav-link">Berita</a>
      <a href="/galeri" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors nav-link">Galeri</a>
      <a href="/infografis" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors nav-link">Infografis</a>
      <a href="/sotk" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors nav-link">SOTK</a>
      <a href="/#peta" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors nav-link">Peta Desa</a>
    </nav>
    <!-- Action Button & Mobile Menu -->
    <div class="flex items-center gap-4">
      <a href="#pengaduan"
         class="hidden md:inline-flex items-center gap-2 bg-emerald-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg shadow-emerald-500/30 hover:bg-emerald-700 hover:shadow-xl hover:scale-105 transition-all duration-300">
        <i data-lucide="message-square" class="w-4 h-4"></i>
        <span>Layanan Pengaduan</span>
      </a>
      <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500">
        <i data-lucide="menu" class="w-6 h-6"></i>
      </button>
    </div>
  </div>
  <!-- Mobile Menu Dropdown -->
  <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-100 bg-white/95 backdrop-blur-md h-screen absolute w-full left-0 top-full shadow-xl">
    <div class="container mx-auto px-6 py-6 space-y-4">
      <a href="/" class="flex items-center gap-3 px-4 py-3 text-emerald-600 bg-emerald-50 rounded-xl font-bold">
        <i data-lucide="home" class="w-5 h-5"></i> Home
      </a>
      <a href="/profil" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors">
        <i data-lucide="info" class="w-5 h-5"></i> Profil
      </a>
      <a href="/berita" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors">
        <i data-lucide="file-text" class="w-5 h-5"></i> Berita
      </a>
      <a href="/galeri" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors">
        <i data-lucide="image" class="w-5 h-5"></i> Galeri
      </a>
      <a href="/infografis" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors">
        <i data-lucide="bar-chart-2" class="w-5 h-5"></i> Infografis
      </a>
      <a href="/sotk" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors">
        <i data-lucide="users" class="w-5 h-5"></i> SOTK
      </a>
      <a href="/#pengaduan" class="block w-full text-center mt-6 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold px-5 py-4 rounded-xl shadow-lg transition-transform active:scale-95">
        Buat Laporan
      </a>
    </div>
  </div>

  <script>
    // Header scroll effect & mobile menu toggle
    document.addEventListener('DOMContentLoaded', function () {
      // Lucide icons
      if (window.lucide) lucide.createIcons();

      // Header shadow saat scroll
      const header = document.getElementById('main-header');
      window.addEventListener('scroll', function () {
        if (window.scrollY > 20) {
          header.classList.add('scrolled');
        } else {
          header.classList.remove('scrolled');
        }
      });

      // Mobile menu toggle
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');
      if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function (e) {
          e.stopPropagation();
          mobileMenu.classList.toggle('hidden');
          const icon = mobileMenuButton.querySelector('i');
          if (mobileMenu.classList.contains('hidden')) {
            icon.setAttribute('data-lucide', 'menu');
          } else {
            icon.setAttribute('data-lucide', 'x');
          }
          if (window.lucide) lucide.createIcons();
        });

        // Close menu ketika klik di menu links
        mobileMenu.querySelectorAll('a').forEach(link => {
          link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            if (mobileMenuButton.querySelector('i')) {
              mobileMenuButton.querySelector('i').setAttribute('data-lucide', 'menu');
            }
            if (window.lucide) lucide.createIcons();
          });
        });
      }
      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
          const targetId = this.getAttribute('href').slice(1);
          const target = document.getElementById(targetId);
          if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
          }
        });
      });
    });
  </script>
</header>
