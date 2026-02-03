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
           STRUKTUR ORGANISASI SECTION
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
           BAGAN INTERAKTIF (TREE)
           ========================================== -->
      <section class="mb-16">
        <div class="text-center mb-12" data-aos="fade-up">
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Bagan Struktur Interaktif</h2>
          <p class="text-slate-600 mt-5">Klik untuk membuka/tutup struktur organisasi</p>
        </div>

        <!-- Tree Container -->
        <div class="bg-slate-50 rounded-3xl shadow-lg border border-slate-200 overflow-hidden" data-aos="zoom-in-up">
          
          <!-- Header -->
          <div class="bg-white border-b border-slate-100 px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                <i data-lucide="git-fork" class="w-5 h-5"></i>
              </div>
              <div>
                <h3 class="font-bold text-slate-800">Hierarki Interaktif</h3>
                <p class="text-xs text-slate-500">Klik jabatan untuk buka/tutup cabang</p>
              </div>
            </div>
            <button onclick="expandAll()" class="text-xs font-bold text-emerald-600 hover:underline">
              Tampilkan Semua
            </button>
          </div>

          <!-- The Tree -->
          <div class="p-10 overflow-x-auto bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:20px_20px]">
            <div class="tree min-w-[800px]">
              <ul>
                <!-- LEVEL 1: KEPALA DESA -->
                @php
                $kepalaDesa = $sotks->where('jabatan', 'Kepala Desa')->first();
                @endphp
                
                @if($kepalaDesa)
                <li>
                  <a href="javascript:void(0)" class="org-node group" onclick="toggleNode(this)">
                    <div class="absolute top-2 right-2 toggle-icon">
                      <i data-lucide="minus-circle" class="w-4 h-4 text-slate-400"></i>
                    </div>
                    <img 
                      src="{{ $kepalaDesa->foto ? asset('storage/' . $kepalaDesa->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kepalaDesa->nama) . '&background=10b981&color=fff' }}" 
                      alt="{{ $kepalaDesa->nama }}">
                    <span class="role-badge bg-role-emerald">Kepala Desa</span>
                    <div class="font-bold text-slate-800 text-sm leading-tight">{{ $kepalaDesa->nama }}</div>
                  </a>

                  <ul>
                    <!-- LEVEL 2: SEKRETARIS DESA & KASI -->
                    @php
                    $sekdes = $sotks->where('jabatan', 'Sekretaris Desa')->first();
                    $kasis = $sotks->whereIn('jabatan', ['Kasi Pemerintahan', 'Kasi Pelayanan', 'Kasi Kesra']);
                    @endphp

                    @if($sekdes)
                    <li>
                      <a href="javascript:void(0)" class="org-node" onclick="toggleNode(this)">
                        <div class="absolute top-2 right-2 toggle-icon">
                          <i data-lucide="minus-circle" class="w-4 h-4 text-slate-400"></i>
                        </div>
                        <img 
                          src="{{ $sekdes->foto ? asset('storage/' . $sekdes->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($sekdes->nama) . '&background=3b82f6&color=fff' }}" 
                          alt="{{ $sekdes->nama }}">
                        <span class="role-badge bg-role-blue">Sekretaris Desa</span>
                        <div class="font-bold text-slate-800 text-sm leading-tight">{{ $sekdes->nama }}</div>
                      </a>

                      <!-- LEVEL 3: KAUR (Di bawah Sekdes) -->
                      <ul>
                        @php
                        $kaurs = $sotks->whereIn('jabatan', ['Kaur Umum & TU', 'Kaur Keuangan', 'Kaur Perencanaan']);
                        @endphp
                        
                        @foreach($kaurs as $kaur)
                        <li>
                          <a href="javascript:void(0)" class="org-node">
                            <img 
                              src="{{ $kaur->foto ? asset('storage/' . $kaur->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kaur->nama) . '&background=f59e0b&color=fff' }}" 
                              alt="{{ $kaur->nama }}">
                            <span class="role-badge bg-role-amber">{{ $kaur->jabatan }}</span>
                            <div class="font-bold text-slate-800 text-sm leading-tight">{{ $kaur->nama }}</div>
                          </a>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                    @endif

                    <!-- KASI SECTIONS -->
                    @foreach($kasis as $kasi)
                    <li>
                      <a href="javascript:void(0)" class="org-node" onclick="toggleNode(this)">
                        <div class="absolute top-2 right-2 toggle-icon">
                          <i data-lucide="minus-circle" class="w-4 h-4 text-slate-400"></i>
                        </div>
                        <img 
                          src="{{ $kasi->foto ? asset('storage/' . $kasi->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kasi->nama) . '&background=7e22ce&color=fff' }}" 
                          alt="{{ $kasi->nama }}">
                        <span class="role-badge bg-role-purple">{{ $kasi->jabatan }}</span>
                        <div class="font-bold text-slate-800 text-sm leading-tight">{{ $kasi->nama }}</div>
                      </a>

                      <!-- LEVEL 3: KADUS (Di bawah Kasi) -->
                      <ul>
                        @php
                        $kadusInKasi = $sotks->where('parent_id', $kasi->id)->orWhere('jabatan', 'like', '%Kadus%');
                        @endphp
                        
                        @if($kadusInKasi->count() > 0)
                          @foreach($kadusInKasi as $kadus)
                          <li>
                            <a href="javascript:void(0)" class="org-node">
                              <img 
                                src="{{ $kadus->foto ? asset('storage/' . $kadus->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kadus->nama) . '&background=be185d&color=fff' }}" 
                                alt="{{ $kadus->nama }}">
                              <span class="role-badge bg-role-pink">{{ $kadus->jabatan }}</span>
                              <div class="font-bold text-slate-800 text-sm leading-tight">{{ $kadus->nama }}</div>
                            </a>
                          </li>
                          @endforeach
                        @endif
                      </ul>
                    </li>
                    @endforeach

                  </ul>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>

  <!-- ==========================================
       MODAL GAMBAR PENUH
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
@endpush
