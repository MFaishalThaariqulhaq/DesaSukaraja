@extends('layouts.public.layout')

@section('content')

<!-- Hero Header Section -->
<section class="hero-bg relative h-screen md:h-[75vh] flex items-center justify-center text-white overflow-hidden -mt-20">
  <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
    <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold font-serif leading-tight drop-shadow-2xl mb-4">
      SOTK <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-200">Desa</span>
    </h1>
    <p class="text-lg md:text-2xl text-slate-100 drop-shadow-md">Struktur Organisasi dan Tata Kerja Pemerintah Desa</p>
  </div>
  <!-- Scroll Down Indicator -->
  <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce opacity-80 cursor-pointer hover:text-emerald-300 transition-colors">
    <a href="#struktur">
      <svg class="w-8 h-8" data-lucide="mouse" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"></svg>
    </a>
  </div>
</section>

<!-- BAGAN STRUKTUR SECTION -->
<section id="struktur" class="py-16 md:py-20 bg-slate-50">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Pemerintahan</span>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mt-3">Struktur Organisasi Pemerintah Desa</h2>
      <p class="text-slate-600 mt-5 max-w-2xl mx-auto">Sinergi antara aparat desa dan lembaga masyarakat dalam mewujudkan visi misi Desa Sukaraja.</p>
    </div>

    @php
    $bagan = $sotks->where('jabatan', 'Bagan')->first();
    @endphp

    @if($bagan)
    <div class="max-w-5xl mx-auto" data-aos="zoom-in" data-aos-duration="1000">
      <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden group">
        <div class="relative overflow-hidden rounded-2xl bg-slate-100 aspect-video flex items-center justify-center cursor-pointer" id="baganContainer">
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
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mt-3">Aparatur Pemerintahan Desa</h2>
      <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full mt-4"></div>
      <p class="text-base md:text-lg mt-5 text-slate-600">Aparatur Pemerintahan Desa Sukaraja Periode 2024-2029</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($sotks->where('jabatan', '!=', 'Bagan')->take(3) as $index => $sotk)
      <div 
        class="group relative overflow-hidden rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500"
        data-aos="fade-up" 
        data-aos-delay="{{ $index * 100 }}">
        
        <!-- Background Image -->
        <div class="relative h-72 overflow-hidden bg-slate-100">
          <img 
            src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://placehold.co/400x500/94a3b8/ffffff?text=Foto' }}" 
            alt="{{ $sotk->nama }}"
            class="w-full h-full object-cover object-top transform group-hover:scale-110 transition-transform duration-700">
          
          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>

        <!-- Content -->
        <div class="relative p-6 text-center">
          <h3 class="font-bold text-lg text-slate-800 mb-1 group-hover:text-emerald-600 transition-colors duration-300">{{ $sotk->nama }}</h3>
          <p class="text-sm font-medium text-emerald-600 uppercase tracking-wider">{{ $sotk->jabatan }}</p>
          
          <!-- Bottom Badge -->
          <div class="absolute top-0 right-0 w-0 h-0 border-l-[40px] border-t-[40px] border-l-transparent border-t-emerald-500 group-hover:border-t-emerald-600 transition-colors duration-300"></div>
          <div class="absolute top-2 right-3 text-white text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <svg class="w-4 h-4" data-lucide="user" fill="white"></svg>
          </div>
        </div>

        <!-- Hover Info -->
        <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-emerald-600 to-teal-700 pointer-events-none">
          <svg class="w-12 h-12 text-white mb-3" data-lucide="user-check" stroke="currentColor" fill="none" stroke-width="1.5"></svg>
          <p class="text-white font-semibold text-center px-4">{{ $sotk->jabatan }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Tombol Lihat Selengkapnya -->
    <div class="mt-16 flex justify-center" data-aos="fade-up" data-aos-delay="400">
      <a href="{{ route('sotk.struktur') }}" class="group relative inline-flex items-center gap-3 px-10 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
        <!-- Background Animation -->
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
        
        <!-- Icon -->
        <svg class="w-5 h-5 relative z-10 group-hover:animate-bounce" data-lucide="network" stroke="currentColor" fill="none" stroke-width="2"></svg>
        
        <!-- Text -->
        <span class="relative z-10">Lihat Struktur Lengkap</span>
        
        <!-- Arrow -->
        <svg class="w-5 h-5 relative z-10 group-hover:translate-x-1 transition-transform duration-300" data-lucide="arrow-right" stroke="currentColor" fill="none" stroke-width="2"></svg>
      </a>
    </div>
  </div>
</section>

<!-- MODAL UNTUK LIHAT BAGAN PENUH -->
<div id="baganModal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 overflow-y-auto" role="dialog" aria-modal="true">
  <div class="relative max-w-5xl w-full my-auto animate-fade-in-scale">
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