@extends('layouts.public.layout')

@section('content')

<!-- Hero Header Section -->
<section class="hero-bg relative h-screen md:h-[75vh] flex items-center justify-center text-white overflow-hidden -mt-20">
  <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
    <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold font-serif leading-tight drop-shadow-2xl mb-4 animate-fade-in-down">
      Berita & <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-200">Kegiatan</span>
    </h1>
    <p class="text-lg md:text-2xl text-slate-100 drop-shadow-md animate-fade-in-up">Temukan informasi terbaru dan dokumentasi kegiatan desa</p>
  </div>
  <!-- Scroll Down Indicator -->
  <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-smooth-lucid-mouse opacity-80 cursor-pointer hover:opacity-100 hover:text-emerald-300 transition-all duration-300">
    <a href="#berita-list"><i data-lucide="mouse" class="w-8 h-8"></i></a>
  </div>
</section>

<section id="berita-list" class="py-12 bg-slate-50">
  <div class="container mx-auto px-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

      <!-- Sidebar -->
      <aside class="lg:col-span-1" data-aos="fade-right" data-aos-delay="100">
        <!-- Search Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 sticky top-28 space-y-6">
          <div>
            <h3 class="text-lg font-bold text-slate-800 mb-4 font-sans">Cari Berita</h3>
            <div class="relative">
              <input type="text" id="searchInput" placeholder="Kata kunci..."
                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
              <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>
          </div>

          <!-- Category Filter -->
          <div class="pt-4 border-t border-slate-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 font-sans">Kategori</h3>
            <ul class="space-y-2">
              <li>
                <a href="{{ route('berita.index') }}"
                  class="kategori-all flex items-center justify-between px-4 py-3 rounded-lg text-slate-700 font-medium hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 border-2 border-transparent"
                  data-kategori="all">
                  <span>Semua Berita</span>
                  <span class="bg-emerald-100 text-emerald-700 py-1 px-2.5 rounded-full text-xs font-bold">{{ \App\Models\Berita::count() }}</span>
                </a>
              </li>
              @php
              $categories = \App\Models\Berita::distinct()->pluck('kategori')->sort()->filter(fn($cat) => $cat !== null);
              $currentCategory = request('kategori');
              @endphp
              @forelse($categories as $category)
              <li>
                <a href="{{ route('berita.index', ['kategori' => $category]) }}#berita-list"
                  class="kategori-link flex items-center justify-between px-4 py-3 rounded-lg text-slate-700 font-medium hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 border-2 border-transparent {{ strtolower($currentCategory ?? '') === strtolower($category) ? 'bg-emerald-50 text-emerald-700 border-emerald-300' : '' }}"
                  data-kategori="{{ strtolower($category) }}">
                  <span>{{ $category }}</span>
                  <span class="bg-slate-100 text-slate-600 py-1 px-2.5 rounded-full text-xs font-bold">{{ \App\Models\Berita::whereRaw('LOWER(TRIM(kategori)) = LOWER(?)', [$category])->count() }}</span>
                </a>
              </li>
              @empty
                <li><p class="text-slate-500 text-sm text-center py-2">Tidak ada kategori</p></li>
              @endforelse
            </ul>
          </div>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="lg:col-span-3">
        <!-- Berita Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @forelse($beritas as $index => $berita)
          <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-500 border border-slate-100 group flex flex-col h-full berita-item"
            data-aos="fade-up" data-aos-delay="{{ 100 + ($index % 4 * 100) }}"
            data-category="{{ strtolower($berita->kategori ?? 'kegiatan') }}">
            <!-- Image Container with smooth zoom -->
            <div class="relative h-56 overflow-hidden bg-slate-100">
              <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/600x400/60a5fa/ffffff?text=Berita' }}"
                alt="{{ $berita->judul }}"
                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
              <!-- Category Badge -->
              <div class="absolute top-4 left-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-lg">
                {{ $berita->kategori }}
              </div>
              <!-- Read Time Estimate -->
              <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                {{ ceil(str_word_count(strip_tags($berita->isi)) / 200) }} min read
              </div>
            </div>

            <!-- Content -->
            <div class="p-6 flex-1 flex flex-col">
              <!-- Date -->
              <div class="text-slate-500 text-xs font-semibold mb-3 flex items-center gap-2 uppercase tracking-wide">
                <i data-lucide="calendar" class="w-4 h-4 text-emerald-600"></i>
                {{ $berita->created_at->format('d M Y') }}
              </div>

              <!-- Title -->
              <h3 class="text-lg font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors duration-300 leading-snug line-clamp-2">
                <a href="{{ route('berita.detail', $berita->slug) }}">{{ $berita->judul }}</a>
              </h3>

              <!-- Description -->
              <p class="text-slate-600 text-sm line-clamp-3 mb-4 flex-1">
                {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}
              </p>

              <!-- CTA Button -->
              <a href="{{ route('berita.detail', $berita->slug) }}" class="inline-flex items-center gap-2 text-emerald-600 font-semibold text-sm hover:text-emerald-700 transition-all duration-300 group/btn mt-auto">
                Baca Selengkapnya
                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1"></i>
              </a>
            </div>
          </article>
          @empty
          <div class="lg:col-span-3 w-full text-center py-20">
            <i data-lucide="inbox" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
            <p class="text-slate-500 font-semibold text-lg">Belum ada berita untuk kategori ini</p>
            <p class="text-slate-400 text-sm mt-1">Coba cari kategori lain atau kembali ke semua berita</p>
          </div>
          @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16" id="berita-pagination">
          <!-- Pagination will be generated by JavaScript -->
        </div>
      </main>
    </div>
  </div>
</section>

<script type="module">
  document.addEventListener('DOMContentLoaded', () => {
    // Initialize AOS
    if (window.AOS) {
      AOS.init({
        once: true,
        duration: 800,
        easing: 'ease-out-cubic'
      });
    }

    // Initialize Lucide icons
    if (window.lucide) {
      lucide.createIcons();
    }

    // Search functionality with smooth transitions
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
      searchInput.addEventListener('keyup', (e) => {
        const query = e.target.value.toLowerCase();
        const hasQuery = query.trim() !== '';
        
        document.querySelectorAll('.berita-item').forEach(item => {
          const itemText = item.textContent.toLowerCase();
          const matches = itemText.includes(query);
          
          if (!hasQuery || matches) {
            item.style.display = '';
            item.classList.add('animate-fadeInUp');
          } else {
            item.style.display = 'none';
          }
        });
      });
    }

    // Category filter - highlight active category
    const kategoriLinks = document.querySelectorAll('.kategori-link, .kategori-all');
    const currentKategori = new URLSearchParams(window.location.search).get('kategori')?.toLowerCase() || 'all';
    
    kategoriLinks.forEach(link => {
      const linkKategori = link.getAttribute('data-kategori');
      if (linkKategori === currentKategori) {
        link.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
      }
    });
  });
</script>

@endsection
