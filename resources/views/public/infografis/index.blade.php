@extends('layouts.public.layout')

@section('content')

<section id="infografis-list" class="pt-3 pb-12 md:pt-5 bg-slate-50">
  <div class="container mx-auto px-6">
    <div class="mb-8 md:mb-10" data-aos="fade-up">
      <span class="text-emerald-700 font-bold uppercase tracking-widest text-sm">Statistik Desa</span>
      <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mt-2 leading-tight">Data Kependudukan per Dusun</h2>
      <p class="text-slate-600 mt-4 max-w-3xl text-base leading-relaxed">Klik pada dusun untuk melihat detail statistik lengkap termasuk struktur usia, pendidikan, mata pencaharian, dan agama.</p>
    </div>

    <!-- Grid Dusun -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($data as $index => $item)
        <a href="{{ route('infografis.detail', $item->dusun) }}" class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-slate-100 group flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
          <!-- Card Header -->
          <div class="p-5 bg-gradient-to-br from-emerald-50 to-white border-b border-slate-100">
            <div class="flex items-start justify-between mb-2">
              <div>
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 group-hover:text-emerald-700 transition">{{ $item->dusun }}</h3>
                <p class="text-slate-500 text-sm mt-1">Dusun</p>
              </div>
              <div class="w-10 h-10 md:w-11 md:h-11 rounded-full bg-emerald-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                <i data-lucide="map-pin" class="w-5 h-5"></i>
              </div>
            </div>
          </div>

          <!-- Card Body -->
          <div class="p-5 flex-1 flex flex-col">
            <!-- Stats Grid -->
            <div class="grid grid-cols-2 gap-3 mb-4">
              <!-- Total Penduduk -->
              <div class="bg-slate-50 rounded-xl p-3 md:p-3.5 border border-slate-100 group-hover:border-emerald-200 group-hover:bg-emerald-50 transition">
                <div class="text-xs text-slate-600 font-medium mb-1 uppercase tracking-wider">Total Penduduk</div>
                <div class="text-xl md:text-2xl font-bold text-slate-900">{{ number_format($item->total_penduduk ?? 0) }}</div>
              </div>

              <!-- Kepala Keluarga -->
              <div class="bg-slate-50 rounded-xl p-3 md:p-3.5 border border-slate-100 group-hover:border-emerald-200 group-hover:bg-emerald-50 transition">
                <div class="text-xs text-slate-600 font-medium mb-1 uppercase tracking-wider">KK</div>
                <div class="text-xl md:text-2xl font-bold text-slate-900">{{ number_format($item->kepala_keluarga ?? 0) }}</div>
              </div>

              <!-- Laki-laki -->
              <div class="bg-slate-50 rounded-xl p-3 md:p-3.5 border border-slate-100 group-hover:border-blue-200 group-hover:bg-blue-50 transition">
                <div class="text-xs text-slate-600 font-medium mb-1 uppercase tracking-wider">Laki-laki</div>
                <div class="text-xl md:text-2xl font-bold text-blue-600">{{ number_format($item->laki_laki ?? 0) }}</div>
              </div>

              <!-- Perempuan -->
              <div class="bg-slate-50 rounded-xl p-3 md:p-3.5 border border-slate-100 group-hover:border-pink-200 group-hover:bg-pink-50 transition">
                <div class="text-xs text-slate-600 font-medium mb-1 uppercase tracking-wider">Perempuan</div>
                <div class="text-xl md:text-2xl font-bold text-pink-600">{{ number_format($item->perempuan ?? 0) }}</div>
              </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between pt-3 border-t border-slate-100 mt-auto">
              <span class="text-sm text-slate-500">Klik untuk lihat detail</span>
              <span class="text-emerald-700 font-semibold group-hover:translate-x-1 transition-transform">
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
              </span>
            </div>
          </div>
        </a>
      @empty
        <div class="col-span-full text-center py-16">
          <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          <p class="text-slate-500 font-medium">Belum ada data dusun</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

@endsection
