<header id="main-header" class="public-header fixed w-full top-0 z-50 transition-all duration-300">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <a href="/" class="flex items-center space-x-3 group">
      <div class="relative w-10 h-10 md:w-12 md:h-12 flex-shrink-0 transition-transform group-hover:rotate-12 duration-500">
        <img src="{{ asset('images/logo.png') }}"
             alt="Logo Desa Sukaraja"
             class="w-full h-full object-contain drop-shadow-sm"
             onerror="this.src='https://placehold.co/48x48/10b981/ffffff?text=DS'">
      </div>
      <div class="flex flex-col">
        <span class="public-header-brand-title text-xs md:text-sm font-bold font-sans text-slate-800 tracking-wide leading-tight transition-colors">PEMERINTAH DESA SUKARAJA</span>
        <span class="text-[10px] md:text-xs font-medium font-sans text-slate-500 tracking-wider uppercase public-header-subtitle">Kabupaten Karawang</span>
      </div>
    </a>
    <!-- Desktop Menu -->
    <nav class="hidden lg:flex items-center gap-8 font-sans">
      <a href="/" class="text-base font-medium text-slate-600 transition-colors nav-link">Home</a>
      <a href="/profil" class="text-base font-medium text-slate-600 transition-colors nav-link">Profil</a>
      <a href="/berita" class="text-base font-medium text-slate-600 transition-colors nav-link">Berita</a>
      <a href="/galeri" class="text-base font-medium text-slate-600 transition-colors nav-link">Galeri</a>
      <a href="/infografis" class="text-base font-medium text-slate-600 transition-colors nav-link">Infografis</a>
      <a href="/sotk" class="text-base font-medium text-slate-600 transition-colors nav-link">SOTK</a>
      <a href="/#peta-wilayah" class="text-base font-medium text-slate-600 transition-colors nav-link">Peta Desa</a>
    </nav>
    <!-- Action Button & Mobile Menu -->
    <div class="flex items-center gap-4">
      <button id="openPengaduanModalBtn"
         class="public-header-cta hidden md:inline-flex items-center gap-2 text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-300">
        <i data-lucide="message-square" class="w-4 h-4"></i>
        <span>Layanan Pengaduan</span>
      </button>
      <button id="mobile-menu-button" class="public-hamburger lg:hidden p-2 rounded-lg text-slate-700 z-50 relative">
        <i data-lucide="menu" class="w-6 h-6"></i>
      </button>
    </div>
  </div>
  <!-- Mobile Menu Dropdown -->
  <div id="mobile-menu" class="public-mobile-menu hidden lg:hidden z-50 h-screen absolute w-full left-0 top-full">
    <div class="container mx-auto px-6 py-6 space-y-4">
      <a href="/" class="public-mobile-link flex items-center gap-3 px-4 py-3 text-base font-semibold rounded-xl">
        <i data-lucide="home" class="w-5 h-5"></i> Home
      </a>
      <a href="/profil" class="public-mobile-link flex items-center gap-3 px-4 py-3 text-base font-medium rounded-xl transition-colors">
        <i data-lucide="info" class="w-5 h-5"></i> Profil
      </a>
      <a href="/berita" class="public-mobile-link flex items-center gap-3 px-4 py-3 text-base font-medium rounded-xl transition-colors">
        <i data-lucide="file-text" class="w-5 h-5"></i> Berita
      </a>
      <a href="/galeri" class="public-mobile-link flex items-center gap-3 px-4 py-3 text-base font-medium rounded-xl transition-colors">
        <i data-lucide="image" class="w-5 h-5"></i> Galeri
      </a>
      <a href="/infografis" class="public-mobile-link flex items-center gap-3 px-4 py-3 text-base font-medium rounded-xl transition-colors">
        <i data-lucide="bar-chart-2" class="w-5 h-5"></i> Infografis
      </a>
      <a href="/sotk" class="public-mobile-link flex items-center gap-3 px-4 py-3 text-base font-medium rounded-xl transition-colors">
        <i data-lucide="users" class="w-5 h-5"></i> SOTK
      </a>
      <a href="/#peta-wilayah" class="public-mobile-link flex items-center gap-3 px-4 py-3 text-base font-medium rounded-xl transition-colors">
        <i data-lucide="map" class="w-5 h-5"></i> Peta Desa
      </a>
      <button id="openPengaduanModalBtnMobile" class="public-mobile-cta block w-full text-center mt-6 text-base font-bold px-5 py-4 rounded-xl transition-all duration-300 active:scale-95">
        Buat Laporan
      </button>
    </div>
  </div>
</header>

