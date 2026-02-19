@extends('layouts.public.layout')

@section('content')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush

<!-- Header Section -->
<header class="berita-detail-header text-white pt-16 pb-10 md:pt-20 md:pb-12 relative overflow-hidden border-b border-slate-800 -mt-12">
  <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
    <a href="{{ route('berita.index') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-white/10 text-white border border-white/30 hover:bg-white/20 hover:border-white/50 transition-all duration-300 mb-4 backdrop-blur-sm">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span class="font-semibold text-sm tracking-wide">Kembali ke Arsip Berita</span>
    </a>
    <h1 class="text-3xl md:text-4xl font-bold mb-3">{{ $berita->judul }}</h1>
    <div class="flex items-center gap-4 text-slate-300 flex-wrap text-sm">
      <span class="inline-block bg-emerald-700 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
        {{ $berita->kategori ?? 'Umum' }}
      </span>
      <span class="flex items-center gap-2">
        <i data-lucide="calendar" class="w-4 h-4"></i>
        {{ $berita->created_at->format('d F Y') }}
      </span>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-6 pt-10 pb-12 md:pt-12">
  <div class="grid lg:grid-cols-12 gap-12">
    <!-- Main Content -->
    <main class="lg:col-span-8 lg:col-start-1">
      <!-- Featured Image -->
      <article class="bg-white rounded-xl shadow-md overflow-hidden mb-8" data-aos="fade-up" data-aos-delay="100">
        <div class="relative h-96 overflow-hidden group">
          <img
            src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/800x450/60a5fa/ffffff?text=Berita' }}"
            alt="{{ $berita->judul }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        </div>

        <!-- Content -->
        <div class="p-8 md:p-10">
          <div class="mb-6 pb-6 border-b border-slate-200">
            <div class="flex items-center gap-4 text-slate-600 text-sm mb-4">
              <span class="flex items-center gap-1">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                {{ $berita->created_at->format('d F Y') }}
              </span>
              <span class="flex items-center gap-1">
                <i data-lucide="clock" class="w-4 h-4"></i>
                {{ $berita->created_at->format('H:i') }} WIB
              </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-slate-800 leading-tight">
              {{ $berita->judul }}
            </h1>
          </div>

          <!-- Article Content -->
          <div class="prose prose-slate max-w-none mb-8">
            <div class="berita-isi text-slate-700 leading-relaxed">
              {!! $berita->isi !!}
            </div>
          </div>
        </div>
      </article>
    </main>

    <!-- Sidebar (Share & Related Berita) -->
    <aside class="lg:col-span-4 space-y-8" data-aos="fade-left" data-aos-delay="100">
      <!-- Share Section -->
      <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-4 font-sans">Bagikan Berita</h3>
        <div class="flex flex-col gap-2">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
            target="_blank"
            class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg transition-colors duration-300 font-medium">
            <i data-lucide="facebook" class="w-4 h-4"></i>
            Facebook
          </a>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}"
            target="_blank"
            class="flex items-center justify-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2.5 rounded-lg transition-colors duration-300 font-medium">
            <i data-lucide="twitter" class="w-4 h-4"></i>
            Twitter
          </a>
          <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}"
            target="_blank"
            class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-lg transition-colors duration-300 font-medium">
            <i data-lucide="message-circle" class="w-4 h-4"></i>
            WhatsApp
          </a>
        </div>
      </div>

      <!-- Berita Terkait -->
      <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-4 font-sans">Berita Terkait</h3>
        <div class="space-y-4">
          @forelse($beritaTerkait ?? [] as $b)
          <a href="{{ route('berita.detail', $b->slug) }}"
            class="flex items-start gap-3 p-3 rounded-lg hover:bg-emerald-50 transition-all duration-300 group border border-transparent hover:border-emerald-300"
            data-aos="fade-up" data-aos-delay="{{ 200 + $loop->index * 100 }}">
            <img
              src="{{ $b->gambar ? asset('storage/' . $b->gambar) : 'https://placehold.co/100x80/60a5fa/ffffff?text=Berita' }}"
              alt="{{ $b->judul }}"
              class="w-24 h-20 object-cover rounded-md shrink-0 group-hover:scale-105 transition-transform duration-300">
            <div class="flex-1 min-w-0">
              <h4 class="font-semibold text-slate-800 text-sm line-clamp-2 group-hover:text-emerald-700 transition">
                {{ $b->judul }}
              </h4>
              <p class="text-xs text-slate-500 mt-2 flex items-center gap-1">
                <i data-lucide="calendar" class="w-3 h-3"></i>
                {{ $b->created_at->format('d M Y') }}
              </p>
            </div>
          </a>
          @empty
          <p class="text-slate-500 text-sm text-center py-8">Tidak ada berita terkait</p>
          @endforelse
        </div>
      </div>
    </aside>
  </div>
</div>

@endsection
