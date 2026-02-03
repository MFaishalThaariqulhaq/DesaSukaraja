@extends('layouts.public.layout')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  if (window.AOS) {
    AOS.init({
      once: true,
      offset: 50,
      duration: 800,
      easing: 'ease-out-cubic'
    });
  }
</script>
@endpush

<!-- Header Section -->
<header class="bg-slate-900 text-white py-20 relative overflow-hidden">
  <div class="absolute inset-0 overflow-hidden opacity-30">
    <img src="https://images.unsplash.com/photo-2532622783378-1a191e5b21b6?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Background Pemerintahan">
  </div>
  <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
  <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up">
    <span class="text-emerald-400 font-bold uppercase tracking-widest text-sm mb-2 block">Pemerintahan Desa</span>
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi Pemerintah Desa</h1>
    <p class="text-slate-300 max-w-2xl mx-auto text-lg">Susunan Organisasi dan Tata Kerja (SOTK) Pemerintah Desa Sukaraja Periode 2024-2029</p>
  </div>
</header>

<!-- BAGAN STRUKTUR SECTION -->
<section id="struktur" class="pt-20 pb-8 bg-slate-50">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Pemerintahan</span>
      <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mt-2">Struktur Pemerintah</h2>
      <p class="text-slate-600 mt-4 max-w-2xl mx-auto">Sinergi antara aparat desa dan lembaga masyarakat dalam mewujudkan visi misi Desa Sukaraja.</p>
    </div>

    @php
    $bagan = $sotks->where('jabatan', 'Bagan')->first();
    @endphp

    @if($bagan)
    <div class="max-w-5xl mx-auto" data-aos="zoom-in" data-aos-duration="1000">
      <div class="bg-white p-4 rounded-2xl shadow-xl border border-slate-100 overflow-hidden group">
        <div class="relative overflow-hidden rounded-xl bg-slate-100 aspect-[16/10] flex items-center justify-center cursor-pointer">
          <img 
            src="{{ asset('storage/' . $bagan->foto) }}" 
            alt="Bagan Struktur Organisasi"
            id="baganImage"
            class="w-full h-full object-cover transition duration-700 group-hover:scale-105 group-hover:opacity-90 cursor-pointer">

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

        <div class="mt-6 flex justify-between items-center px-2">
          <div>
            <p class="font-bold text-slate-800">Dokumen Resmi</p>
            <p class="text-sm text-slate-500">Diperbarui: Januari 2024</p>
          </div>
          <button id="downloadBagan" class="flex items-center text-emerald-600 font-semibold hover:text-emerald-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
<section id="sotk" class="pt-8 pb-20 bg-slate-50 relative overflow-hidden">
  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Aparatur Desa</span>
      <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mt-2">Aparatur Desa</h2>
      <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full mt-4"></div>
      <p class="text-lg mt-4 text-slate-600">Aparatur Pemerintahan Desa Sukaraja Periode 2024-2029</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
      @foreach($sotks->where('jabatan', '!=', 'Bagan')->take(3) as $index => $sotk)
      <div 
        class="group bg-white rounded-2xl shadow-lg overflow-hidden w-full max-w-xs hover:shadow-2xl transition duration-500 border border-slate-100 relative"
        data-aos="fade-up" 
        data-aos-delay="{{ $index * 100 }}">
        <div class="h-64 overflow-hidden relative">
          <div class="absolute inset-0 bg-emerald-900/20 group-hover:bg-emerald-900/0 transition duration-500 z-10"></div>
          <img 
            src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://placehold.co/400x500/94a3b8/ffffff?text=Foto' }}" 
            alt="{{ $sotk->nama }}"
            class="w-full h-full object-cover object-top transform group-hover:scale-110 transition duration-700">
        </div>
        <div class="p-6 text-center relative">
          <h3 class="font-bold text-xl text-slate-800 mb-1 group-hover:text-emerald-600 transition">{{ $sotk->nama }}</h3>
          <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">{{ $sotk->jabatan }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Tombol Lihat Selengkapnya -->
    <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-delay="400">
      <a href="{{ route('sotk.struktur') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
        <i class="fas fa-sitemap"></i>
        <span>Lihat Struktur Lengkap</span>
      </a>
    </div>
  </div>
</section>

<!-- MODAL UNTUK LIHAT BAGAN PENUH -->
<div id="baganModal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 animate-fadeIn overflow-y-auto">
  <div class="relative max-w-5xl w-full my-auto">
    <button id="closeModal" class="absolute -top-10 right-0 text-white text-4xl font-light hover:text-emerald-400 transition">
      &times;
    </button>
    <img
      src=""
      alt="Bagan Besar"
      id="baganModalImg"
      class="rounded-xl shadow-2xl w-full h-auto border-4 border-white">
  </div>
</div>

@endsection