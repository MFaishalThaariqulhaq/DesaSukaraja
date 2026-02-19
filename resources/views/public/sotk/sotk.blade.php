@extends('layouts.public.layout')

@section('content')

  <!-- ==========================================
       APARATUR SECTION
       ========================================== -->
  <section id="aparatur" class="pt-4 pb-16 md:pt-6 md:pb-24 bg-white relative z-20">
    <div class="container mx-auto px-6">
      
      <!-- Section Header -->
      <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
        <span class="text-emerald-700 font-bold uppercase tracking-widest text-sm">
          Aparatur Desa
        </span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mt-3">
          Aparatur Pemerintahan Desa
        </h2>
        <div class="w-24 h-1 bg-emerald-600 mx-auto rounded-full mt-4"></div>
        <p class="text-base md:text-lg mt-5 text-slate-600">
          Aparatur Pemerintahan Desa Sukaraja Periode 2024-2029
        </p>
      </div>

      <!-- Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($sotks->where('jabatan', '!=', 'Bagan')->take(4) as $index => $sotk)
          <div 
            class="profile-card group bg-white rounded-2xl border border-slate-100 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden"
            data-aos="fade-up" 
            data-aos-delay="{{ $index * 100 }}">
            
            <!-- Image Container -->
            <div class="relative h-64 md:h-[17rem] overflow-hidden bg-slate-100">
              <img 
                src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($sotk->nama) . '&background=10b981&color=fff' }}" 
                alt="{{ $sotk->nama }}"
                class="profile-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 group-hover:blur-sm"
                loading="lazy">
              
              <!-- Tupoksi Overlay (Hover) -->
              <div 
                class="profile-overlay absolute inset-0 flex flex-col justify-center items-center p-5 text-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0"
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
            <div class="p-5 text-center relative flex flex-col items-center justify-center min-h-28">
              @if($sotk->colors)
                <div 
                  class="px-3.5 py-1.5 rounded-full shadow-lg text-white text-xs font-bold uppercase tracking-wide mb-2.5"
                  style="background: {{ $sotk->colors['badgeBg'] }}; white-space: nowrap;">
                  {{ $sotk->jabatan }}
                </div>
              @endif
              <h3 class="text-lg md:text-xl font-bold text-slate-800 mb-1">
                {{ $sotk->nama }}
              </h3>
              <p class="text-sm text-slate-500">{{ $sotk->keterangan ?? 'Masa Bakti 2024 - 2029' }}</p>
            </div>
          </div>
        @endforeach
      </div>

      <!-- View More Button -->
      <div class="flex justify-center mt-10" data-aos="fade-up">
        <a 
          href="{{ route('sotk.detail') }}" 
          class="group inline-flex items-center gap-3 px-8 py-3.5 bg-white text-slate-700 font-bold rounded-full shadow-lg border border-slate-200 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 hover:-translate-y-1 transition-all duration-300">
          <span>Lihat Detail Struktur</span>
          <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-white/20 transition-colors">
            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
          </div>
        </a>
      </div>

    </div>
  </section>

@endsection
