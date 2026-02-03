@extends('layouts.public.layout')

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (window.AOS) {
      AOS.init({
        once: true,
        offset: 50,
        duration: 800,
        easing: 'ease-out-cubic'
      });
    }
  });
</script>
@vite('resources/js/sotk.js')
@endpush

@section('content')

<!-- Hero Header Section -->
<section class="hero-bg relative h-screen md:h-[75vh] flex items-center justify-center text-white overflow-hidden -mt-20">
  <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
    <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold font-serif leading-tight drop-shadow-2xl mb-4">
      SOTK <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-200">Desa</span>
    </h1>
    <p class="text-lg md:text-2xl text-slate-100 drop-shadow-md">Struktur Organisasi dan Tata Kerja Pemerintah Desa</p>
  </div>
</section>

<!-- Header Section -->
<header class="bg-slate-900 text-white py-16 md:py-20 relative overflow-hidden">
  <div class="absolute inset-0 overflow-hidden opacity-20">
    <img src="https://images.unsplash.com/photo-2532622783378-1a191e5b21b6?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Background Pemerintahan">
  </div>
  <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
  <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up">
    <span class="text-emerald-400 font-bold uppercase tracking-widest text-sm mb-3 block">Pemerintahan Desa</span>
    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">Struktur Organisasi Pemerintah Desa</h2>
    <p class="text-slate-300 max-w-2xl mx-auto text-base md:text-lg">Susunan Organisasi dan Tata Kerja (SOTK) Pemerintah Desa Sukaraja Periode 2024-2029</p>
  </div>
</header>

<!-- BAGAN STRUKTUR SECTION -->
<section id="struktur" class="py-16 md:py-20 bg-slate-50">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Pemerintahan</span>
      <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mt-3">Struktur Pemerintah</h3>
      <p class="text-slate-600 mt-5 max-w-2xl mx-auto">Sinergi antara aparat desa dan lembaga masyarakat dalam mewujudkan visi misi Desa Sukaraja.</p>
    </div>

    @php
    $bagan = $sotks->where('jabatan', 'Bagan')->first();
    @endphp

    @if($bagan)
    <div class="max-w-5xl mx-auto" data-aos="zoom-in" data-aos-duration="1000">
      <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden group">
        <div class="relative overflow-hidden rounded-2xl bg-slate-100 aspect-[16/10] flex items-center justify-center cursor-pointer" id="baganContainer">
          <img 
            src="{{ asset('storage/' . $bagan->foto) }}" 
            alt="Bagan Struktur Organisasi"
            class="w-full h-full object-cover transition duration-700 group-hover:scale-105 group-hover:opacity-90">

          <!-- Overlay Button -->
          <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition duration-300">
            <button type="button" class="px-6 py-3 bg-white text-slate-900 font-bold rounded-lg shadow-lg hover:bg-emerald-50 transition transform hover:-translate-y-1">
              Lihat Gambar Penuh
            </button>
          </div>

          <!-- Label -->
          <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none group-hover:opacity-0 transition duration-300">
            <div class="bg-white/90 backdrop-blur px-6 py-4 rounded-xl shadow-lg text-center border-l-4 border-emerald-500">
              <h4 class="text-xl font-bold text-slate-800">Bagan Organisasi 2024-2029</h4>
              <p class="text-slate-500 text-sm">Klik untuk memperbesar</p>
            </div>
          </div>
        </div>

        <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 p-6 pt-0">
          <div>
            <p class="font-bold text-slate-800">Dokumen Resmi</p>
            <p class="text-sm text-slate-500">Diperbarui: Januari 2024</p>
          </div>
          <button id="downloadBagan" class="flex items-center gap-2 text-emerald-600 font-semibold hover:text-emerald-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Download PDF
          </button>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>

<!-- Aparatur Desa Section -->
<section id="aparatur" class="py-16 md:py-20 bg-white relative overflow-hidden">
  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Aparatur Desa</span>
      <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mt-3">Aparatur Pemerintahan Desa</h3>
      <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full mt-4"></div>
      <p class="text-base md:text-lg mt-5 text-slate-600">Aparatur Pemerintahan Desa Sukaraja Periode 2024-2029</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($sotks->where('jabatan', '!=', 'Bagan')->take(3) as $index => $sotk)
      <div 
        class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-all duration-300"
        data-aos="fade-up" 
        data-aos-delay="{{ $index * 100 }}">
        <div class="h-64 overflow-hidden relative">
          <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/10 transition duration-500 z-10"></div>
          <img 
            src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://placehold.co/400x500/94a3b8/ffffff?text=Foto' }}" 
            alt="{{ $sotk->nama }}"
            class="w-full h-full object-cover object-top transform group-hover:scale-110 transition duration-700">
        </div>
        <div class="p-6 text-center">
          <h4 class="font-bold text-lg text-slate-800 mb-2 group-hover:text-emerald-600 transition">{{ $sotk->nama }}</h4>
          <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">{{ $sotk->jabatan }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Tombol Lihat Selengkapnya -->
    <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-delay="400">
      <a href="{{ route('sotk.struktur') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
        <span>Lihat Struktur Lengkap</span>
      </a>
    </div>
  </div>
</section>

<!-- MODAL UNTUK LIHAT BAGAN PENUH -->
<div id="baganModal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 overflow-y-auto" role="dialog" aria-modal="true">
  <div class="relative max-w-5xl w-full my-auto">
    <button id="closeModal" class="absolute -top-10 right-0 text-white text-4xl font-light hover:text-emerald-400 transition" aria-label="Close modal">
      ×
    </button>
    <img
      src=""
      alt="Bagan Struktur Organisasi Penuh"
      id="baganModalImg"
      class="rounded-xl shadow-2xl w-full h-auto border-4 border-white">
  </div>
</div>

@endsection