@extends('layouts.public.layout')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/sotk.css') }}">
@endpush

@section('content')

  <!-- ==========================================
       HERO SECTION
       ========================================== -->
  <header class="sotk-detail-header text-white py-10 relative overflow-hidden border-b border-slate-800 -mt-12">
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
      <a href="{{ route('sotk.index') }}"
        class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition mb-3">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span class="font-medium text-sm">Kembali ke SOTK</span>
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

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          @forelse($sotks->where('jabatan', '!=', 'Bagan') as $index => $sotk)
            <div 
              class="group relative bg-white rounded-2xl overflow-hidden shadow-xl border border-slate-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer"
              data-aos="fade-up" 
              data-aos-delay="{{ $index % 4 * 100 }}"
              onclick="openTupoksiModal('{{ addslashes($sotk->nama) }}', '{{ addslashes($sotk->jabatan) }}', @json($sotk->tupoksi))">
              
              <div class="aspect-[4/5] overflow-hidden relative">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent z-10"></div>
                
                <!-- Image -->
                <img 
                  src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($sotk->nama) . '&background=10b981&color=fff' }}" 
                  alt="{{ $sotk->nama }}"
                  class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                  loading="lazy">
                
                <!-- Content -->
                <div class="absolute bottom-0 left-0 p-6 z-20 w-full">
                  <span class="inline-block px-3 py-1 bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider rounded-full mb-2 shadow-lg">
                    {{ $sotk->jabatan }}
                  </span>
                  <h3 class="text-xl font-bold text-white leading-tight">
                    {{ $sotk->nama }}
                  </h3>
                </div>

                <!-- Click Indicator -->
                <div class="absolute top-4 right-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <div class="bg-emerald-600 text-white rounded-full p-2">
                    <i data-lucide="info" class="w-4 h-4"></i>
                  </div>
                </div>
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
       MODAL TUPOKSI
       ========================================== -->
  <div 
    id="tupoksiModal" 
    class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" 
    role="dialog" 
    aria-modal="true"
    onclick="closeTupoksiModal(event)">
    
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[80vh] overflow-y-auto" onclick="event.stopPropagation()">
      <!-- Header -->
      <div class="sticky top-0 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-4 flex items-start justify-between gap-4">
        <div>
          <h2 id="modalNama" class="text-2xl font-bold"></h2>
          <p id="modalJabatan" class="text-emerald-100 text-sm mt-1"></p>
        </div>
        <button 
          onclick="closeTupoksiModal()" 
          class="text-white hover:bg-emerald-800 rounded-full p-2 transition"
          aria-label="Close modal">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Content -->
      <div class="p-6">
        <div class="mb-4">
          <h3 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-3">Tugas Pokok dan Fungsi</h3>
          <div id="modalTupoksi" class="prose prose-sm max-w-none">
            <!-- Tupoksi akan diisi oleh JavaScript -->
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="border-t border-slate-200 px-6 py-3 bg-slate-50 flex justify-end">
        <button 
          onclick="closeTupoksiModal()" 
          class="px-4 py-2 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition">
          Tutup
        </button>
      </div>
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

@push('scripts')
  <script src="{{ asset('js/sotk.js') }}"></script>
  <script>
    function openTupoksiModal(nama, jabatan, tupoksi) {
      document.getElementById('modalNama').textContent = nama;
      document.getElementById('modalJabatan').textContent = jabatan;
      
      if (tupoksi) {
        document.getElementById('modalTupoksi').innerHTML = tupoksi;
      } else {
        document.getElementById('modalTupoksi').innerHTML = '<p class="text-slate-500 italic">Tupoksi belum didefinisikan</p>';
      }
      
      document.getElementById('tupoksiModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeTupoksiModal(event) {
      if (event && event.target.id !== 'tupoksiModal') {
        return;
      }
      document.getElementById('tupoksiModal').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    // Close modal on escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !document.getElementById('tupoksiModal').classList.contains('hidden')) {
        closeTupoksiModal();
      }
    });
  </script>
@endpush
