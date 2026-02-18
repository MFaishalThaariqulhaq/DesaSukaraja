@extends('layouts.public.layout')

@section('content')

  <!-- ==========================================
       HERO SECTION
       ========================================== -->
  <header class="sotk-detail-header text-white py-10 relative overflow-hidden border-b border-slate-800 -mt-12" style="background-image: linear-gradient(to bottom, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.6)),
    url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2832&auto=format&fit=crop');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
      <a href="{{ route('sotk.index') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-white/10 text-white border border-white/30 hover:bg-white/20 hover:border-white/50 transition-all duration-300 mb-4 backdrop-blur-sm">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span class="font-semibold text-sm tracking-wide">Kembali ke SOTK</span>
      </a>
      <h1 class="text-3xl md:text-4xl font-bold mb-3">Struktur Organisasi dan Tata Kerja</h1>
      <div class="flex items-center gap-4 text-slate-300 flex-wrap text-sm">
        <span class="inline-block bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
          Pemerintahan Desa
        </span>
        <span class="flex items-center gap-2">
          <i data-lucide="calendar" class="w-4 h-4"></i>
          {{ date('d F Y') }}
        </span>
      </div>
    </div>
  </header>

  <!-- ==========================================
       MAIN CONTENT
       ========================================== -->
  <div class="bg-white text-slate-800 antialiased overflow-hidden selection:bg-emerald-500 selection:text-white">
    <div class="container mx-auto px-6 py-12">

      <!-- ==========================================
           STRUKTUR ORGANISASI SECTION (BAGAN GAMBAR)
           ========================================== -->
      <section id="struktur" class="mb-16">
        <div class="text-center mb-12" data-aos="fade-up">
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mt-3">
            Bagan Struktur Organisasi
          </h2>
          <p class="text-slate-600 mt-5 max-w-2xl mx-auto">
            Hubungan hierarki dan garis komando dalam pemerintahan desa
          </p>
        </div>

        @php
        $bagan = $sotks->where('jabatan', 'Bagan')->first();
        @endphp

        @if($bagan)
          <div class="max-w-5xl mx-auto" data-aos="zoom-in" data-aos-duration="1000">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden group">
              
              <!-- Header Card -->
              <div class="bg-white border-b border-slate-100 px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                    <i data-lucide="git-fork" class="w-5 h-5"></i>
                  </div>
                  <div>
                    <h3 class="font-bold text-slate-800">Hierarki Pemerintahan</h3>
                    <p class="text-xs text-slate-500">Skema Garis Komando Resmi</p>
                  </div>
                </div>
              </div>

              <!-- Image Container -->
              <div 
                class="relative overflow-hidden rounded-2xl bg-slate-100 aspect-video flex items-center justify-center cursor-pointer" 
                id="baganContainer"
                role="button"
                tabindex="0">
                <img 
                  src="{{ asset('storage/' . $bagan->foto) }}" 
                  alt="Bagan Struktur Organisasi"
                  class="w-full h-full object-cover transition duration-700 group-hover:scale-105 group-hover:opacity-90">

                <!-- Overlay Button -->
                <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition duration-300">
                  <button 
                    type="button" 
                    class="px-6 py-3 bg-white text-slate-900 font-bold rounded-lg shadow-lg hover:bg-emerald-50 transition transform hover:-translate-y-1"
                    aria-label="View full image">
                    Lihat Gambar Penuh
                  </button>
                </div>
              </div>

              <!-- Footer Card -->
              <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 p-6 pt-0">
                <div>
                  <p class="font-bold text-slate-800">Dokumen Resmi</p>
                  <p class="text-sm text-slate-500">Diperbarui: Januari 2026</p>
                </div>
                <button 
                  id="downloadBagan" 
                  class="flex items-center gap-2 text-emerald-600 font-semibold hover:text-emerald-700 transition"
                  aria-label="Download bagan image">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                    </path>
                  </svg>
                  Download Gambar
                </button>
              </div>

            </div>
          </div>
        @else
          <div class="max-w-5xl mx-auto text-center py-12">
            <p class="text-slate-500">Bagan struktur organisasi belum tersedia.</p>
          </div>
        @endif

      </section>

      <!-- ==========================================
           APARATUR PEMERINTAHAN LENGKAP
           ========================================== -->
      <section id="aparatur-lengkap">
        <div class="text-center mb-12" data-aos="fade-up">
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Aparatur Pemerintahan Desa</h2>
          <p class="text-slate-600 mt-5">Daftar lengkap seluruh aparatur pemerintahan desa Sukaraja</p>
        </div>

        <!-- Cards Grid - 4 Kolom -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          @forelse($sotks->where('jabatan', '!=', 'Bagan') as $index => $sotk)
            <div 
              class="profile-card group bg-white rounded-2xl border border-slate-100 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden"
              data-aos="fade-up" 
              data-aos-delay="{{ $index % 4 * 100 }}">
              
              <!-- Image Container -->
              <div class="relative h-72 overflow-hidden bg-slate-100">
                <img 
                  src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($sotk->nama) . '&background=10b981&color=fff' }}" 
                  alt="{{ $sotk->nama }}"
                  class="profile-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 group-hover:blur-sm"
                  loading="lazy">
                
                <!-- Tupoksi Overlay (Hover) -->
                <div 
                  class="profile-overlay absolute inset-0 flex flex-col justify-center items-center p-6 text-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0"
                  style="background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(20,20,30,0.9) 100%);">
                  <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center mb-3">
                    @if($sotk->colors)
                      <i data-lucide="{{ $sotk->colors['icon'] }}" class="w-5 h-5" style="color: {{ $sotk->colors['iconColor'] }}"></i>
                    @endif
                  </div>
                  <h4 class="text-white font-bold text-lg mb-2">Tupoksi</h4>
                  <div class="text-sm leading-relaxed text-white/90 text-justify w-full">
                    @if($sotk->tupoksi)
                      {!! $sotk->tupoksi !!}
                    @else
                      <p class="italic">Tupoksi belum didefinisikan</p>
                    @endif
                  </div>
                </div>
              </div>

              <!-- Info Card (Below Image) -->
              <div class="p-6 text-center relative flex flex-col items-center justify-center min-h-32">
                @if($sotk->colors)
                  <div 
                    class="px-4 py-2 rounded-full shadow-lg text-white text-xs font-bold uppercase tracking-wide mb-3"
                    style="background: {{ $sotk->colors['badgeBg'] }}; white-space: nowrap;">
                    {{ $sotk->jabatan }}
                  </div>
                @endif
                <h3 class="text-xl font-bold text-slate-800 mb-1">
                  {{ $sotk->nama }}
                </h3>
                <p class="text-sm text-slate-500">{{ $sotk->keterangan ?? 'Masa Bakti 2024 - 2029' }}</p>
              </div>
            </div>
          @empty
            <div class="col-span-full text-center py-12">
              <p class="text-slate-500">Tidak ada data aparatur pemerintahan.</p>
            </div>
          @endforelse
        </div>
      </section>

    </div>
  </div>



  <!-- ==========================================
       MODAL GAMBAR BAGAN
       ========================================== -->
  <div 
    id="baganModal" 
    class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 overflow-y-auto" 
    role="dialog" 
    aria-modal="true">
    
    <div class="relative max-w-5xl w-full my-auto">
      <!-- Close Button -->
      <button 
        id="closeModal" 
        class="absolute -top-10 right-0 text-white text-4xl font-light hover:text-emerald-400 transition" 
        aria-label="Close modal">
        ×
      </button>
      
      <!-- Image -->
      <img
        src=""
        alt="Bagan Struktur Organisasi Penuh"
        id="baganModalImg"
        class="rounded-xl shadow-2xl w-full h-auto border-4 border-white">
    </div>
  </div>

@endsection
