@extends('public.layout')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
  .pagination {
    @apply flex items-center justify-center gap-2;
  }

  .pagination .page-item a,
  .pagination .page-item span {
    @apply px-4 py-2 rounded-lg text-sm font-medium transition;
  }

  .pagination .page-item a {
    @apply text-slate-600 hover:bg-emerald-100 hover:text-emerald-700;
  }

  .pagination .page-item.active span {
    @apply bg-emerald-500 text-white shadow-md;
  }

  .pagination .page-item.disabled span {
    @apply text-slate-400;
  }
</style>

<header class="bg-slate-900 text-white py-20 relative overflow-hidden">
  <div class="absolute inset-0 overflow-hidden opacity-20">
    <img src="https://images.unsplash.com/photo-1464618663641-bbdd760ae84a?q=80&w=2070&auto=format&fit=crop"
      class="w-full h-full object-cover" alt="Background">
  </div>
  <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
  <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up">
    <span class="text-emerald-400 font-bold uppercase tracking-widest text-sm mb-2 block">Pusat Informasi</span>
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Arsip Berita & Kegiatan</h1>
    <p class="text-slate-300 max-w-2xl mx-auto text-lg">Temukan informasi terbaru, pengumuman, dan dokumentasi kegiatan Desa Sukaraja.</p>
  </div>
</header>

<div class="container mx-auto px-6 py-12">
  <div class="grid lg:grid-cols-12 gap-12">

    <aside class="lg:col-span-4 space-y-8" data-aos="fade-right" data-aos-delay="100">
      <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-4 font-sans">Cari Berita</h3>
        <div class="relative">
          <input type="text" id="searchInput" placeholder="Kata kunci..."
            class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
          <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-4 font-sans">Kategori</h3>
        <ul class="space-y-2">
          <li>
            <a href="{{ route('berita.index') }}"
              class="flex items-center justify-between p-2 rounded-lg bg-emerald-50 text-emerald-700 font-medium hover:bg-emerald-100 transition">
              <span>Semua Berita</span>
              <span class="bg-white text-emerald-600 py-0.5 px-2 rounded text-xs font-bold shadow-sm">{{ \App\Models\Berita::count() }}</span>
            </a>
          </li>
          @php
          $categories = \App\Models\Berita::distinct()->pluck('kategori')->sort();
          @endphp
          @forelse($categories as $category)
          <li>
            <a href="?kategori={{ urlencode($category) }}"
              class="flex items-center justify-between p-2 rounded-lg text-slate-700 font-medium hover:bg-emerald-50 hover:text-emerald-700 transition">
              <span>{{ $category }}</span>
              <span class="bg-slate-100 text-slate-600 py-0.5 px-2 rounded text-xs font-bold">{{ \App\Models\Berita::where('kategori', $category)->count() }}</span>
            </a>
          </li>
          @empty
          @endforelse
        </ul>
      </div>
    </aside>

    <main class="lg:col-span-8">
      <div class="grid md:grid-cols-2 gap-8">
        @forelse($beritas as $index => $berita)
        <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-slate-100 group flex flex-col h-full berita-item"
          data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}">
          <div class="relative h-48 overflow-hidden">
            <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/600x400/60a5fa/ffffff?text=Berita' }}"
              alt="{{ $berita->judul }}"
              class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
            <div class="absolute top-4 left-4 bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
              {{ $berita->kategori }}
            </div>
          </div>
          <div class="p-6 flex-1 flex flex-col">
            <div class="text-slate-400 text-xs mb-3 flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              {{ $berita->created_at->format('d F Y') }}
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition leading-snug">
              <a href="{{ route('berita.detail', $berita->slug) }}">{{ $berita->judul }}</a>
            </h3>
            <p class="text-slate-600 text-sm line-clamp-3 mb-4 flex-1">
              {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}
            </p>
            <a href="{{ route('berita.detail', $berita->slug) }}" class="text-emerald-600 font-semibold text-sm hover:underline inline-flex items-center mt-auto">
              Baca Selengkapnya <span class="ml-1 transition-transform group-hover:translate-x-1">&rarr;</span>
            </a>
          </div>
        </article>
        @empty
        <div class="col-span-2 text-center py-16">
          <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          <p class="text-slate-500 font-medium">Belum ada berita</p>
        </div>
        @endforelse
      </div>

      <div class="text-center mt-12">
        <nav class="flex justify-center">
          {{ $beritas->links('vendor.pagination.tailwind') }}
        </nav>
      </div>
    </main>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Initialize AOS
    AOS.init({
      once: true,
      duration: 800,
      easing: 'ease-out-cubic'
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
      searchInput.addEventListener('keyup', (e) => {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('.berita-item').forEach(item => {
          const text = item.textContent.toLowerCase();
          item.style.display = text.includes(query) ? '' : 'none';
        });
      });
    }
  });
</script>

@endsection