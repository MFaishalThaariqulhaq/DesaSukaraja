@push('styles')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endpush
@push('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
<script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
@endpush
@extends('layouts.public.layout')
@section('title', 'Website Resmi Desa Sukaraja, Rawamerta, Karawang')




@section('content')
  @include('components.public.hero')

<section id="profil" class="py-20 bg-white relative overflow-hidden">
  <!-- Background Blob -->
  <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-50 rounded-full blur-3xl opacity-50 -z-0 translate-x-1/2 -translate-y-1/2"></div>
  
  <div class="container mx-auto px-6 relative z-10">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div class="relative group" data-aos="fade-right" data-aos-duration="1000">
        <div class="absolute -top-4 -left-4 w-24 h-24 bg-emerald-200 rounded-full blur-2xl -z-10 group-hover:bg-emerald-300 transition-colors duration-500"></div>
        <div class="tilt-card rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
          @if($profil && $profil->gambar)
          <img src="{{ asset('storage/' . $profil->gambar) }}" alt="Gambar Profil Desa" class="profil-image">
          @else
          <img src="https://placehold.co/800x500/34d399/ffffff?text=Kantor+Desa+Sukaraja" alt="Kantor Desa Sukaraja" class="profil-image">
          @endif
        </div>
      </div>
      <div data-aos="fade-left" data-aos-duration="1000">
        <div class="flex items-center gap-3 mb-4">
          <div class="h-0.5 w-12 bg-slate-900"></div>
          <span class="text-slate-900 font-bold uppercase tracking-widest text-sm">Tentang Kami</span>
        </div>
        <h2 class="text-4xl lg:text-6xl font-bold text-slate-900 mb-6 font-serif leading-tight">
          @if($profil && $profil->judul)
          {!! nl2br(e($profil->judul)) !!}
          @else
          Membangun Desa <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Menuju Kemandirian</span>
          @endif
        </h2>
        <p class="text-slate-600 text-lg mb-8 leading-relaxed">
          @if($profil && $profil->deskripsi_profil)
          {{ $profil->deskripsi_profil }}
          @else
          Selamat datang di Desa Sukaraja, sebuah desa yang asri dan penuh dengan kearifan lokal. Terletak di <strong class="text-slate-800">Kecamatan Rawamerta, Kabupaten Karawang</strong>, desa kami berkomitmen untuk terus berkembang menjadi desa yang maju, mandiri, dan sejahtera.
          @endif
        </p>
        <div class="bg-gradient-to-r from-emerald-50 to-white p-8 rounded-2xl border border-emerald-100 mb-10 shadow-sm hover:shadow-md transition-shadow">
          <i data-lucide="quote" class="text-emerald-300 w-8 h-8 mb-2"></i>
          <p class="text-slate-800 italic font-medium text-lg leading-relaxed">
            @if($profil && $profil->motto_profil)
            "{{ $profil->motto_profil }}"
            @else
            "Visi kami adalah terwujudnya Desa Sukaraja yang Maju, Mandiri, Berdaya Saing, dan Berakhlak Mulia Berlandaskan Gotong Royong."
            @endif
          </p>
        </div>

        <div class="flex flex-wrap gap-4">
          <a href="/profil#sejarah" class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold text-white bg-slate-900 rounded-xl hover:bg-slate-800 transition duration-300 shadow-lg transform hover:-translate-y-1">
            Sejarah Desa
          </a>
          <a href="/profil#struktur" class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold text-emerald-700 bg-white border border-emerald-200 rounded-xl hover:bg-emerald-50 hover:border-emerald-300 transition duration-300 transform hover:-translate-y-1">
            Struktur Organisasi
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: Berita Desa (Hover Cards) -->
<section id="berita" class="py-24 bg-slate-50 relative">
  <div class="container mx-auto px-6 relative z-10">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6" data-aos="fade-up">
      <div class="max-w-2xl">
        <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm block mb-2">Kabar Desa</span>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-900 font-serif">Berita & Kegiatan</h2>
      </div>
          </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Berita Card 1: Lingkungan (Emerald) -->
      <article class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 group cursor-pointer border border-slate-100 h-full flex flex-col overflow-hidden" data-aos="fade-up" data-aos-delay="0">
        <div class="relative h-64 overflow-hidden rounded-t-3xl">
          <img src="{{ count($beritas) > 0 ? ($beritas[0]->gambar ? asset('storage/' . $beritas[0]->gambar) : 'https://placehold.co/600x400/10b981/ffffff?text=Lingkungan') : 'https://placehold.co/600x400/10b981/ffffff?text=Lingkungan' }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="Berita">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="berita-badge kategori-lingkungan">Lingkungan</div>
        </div>
        <div class="p-8 flex-1 flex flex-col">
          <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-semibold uppercase tracking-wider">
            <i data-lucide="calendar" class="w-3 h-3"></i> {{ count($beritas) > 0 ? $beritas[0]->created_at->format('d F Y') : '18 Sep 2025' }}
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-3 transition-colors line-clamp-2 berita-title-lingkungan">
            <a href="{{ count($beritas) > 0 ? route('berita.detail', $beritas[0]->slug) : '#' }}">{{ count($beritas) > 0 ? $beritas[0]->judul : 'Warga Antusias Laksanakan Kerja Bakti Saluran Irigasi' }}</a>
          </h3>
          <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
            {{ count($beritas) > 0 ? \Illuminate\Support\Str::limit(strip_tags($beritas[0]->isi), 120) : 'Kegiatan ini bertujuan untuk mencegah penyebaran penyakit dan menjaga kebersihan lingkungan desa.' }}
          </p>
          <a href="{{ count($beritas) > 0 ? route('berita.detail', $beritas[0]->slug) : '#' }}" class="inline-flex items-center text-sm font-bold berita-cta-lingkungan group-hover:translate-x-2 transition-transform duration-300">
            Baca Selengkapnya <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
          </a>
        </div>
      </article>

      <!-- Berita Card 2: Ekonomi (Blue) -->
      <article class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 group cursor-pointer border border-slate-100 h-full flex flex-col overflow-hidden" data-aos="fade-up" data-aos-delay="100">
        <div class="relative h-64 overflow-hidden rounded-t-3xl">
          <img src="{{ count($beritas) > 1 ? ($beritas[1]->gambar ? asset('storage/' . $beritas[1]->gambar) : 'https://placehold.co/600x400/2563eb/ffffff?text=Ekonomi') : 'https://placehold.co/600x400/2563eb/ffffff?text=Ekonomi' }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="Berita">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="berita-badge kategori-ekonomi">Ekonomi</div>
        </div>
        <div class="p-8 flex-1 flex flex-col">
          <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-semibold uppercase tracking-wider">
            <i data-lucide="calendar" class="w-3 h-3"></i> {{ count($beritas) > 1 ? $beritas[1]->created_at->format('d F Y') : '15 Sep 2025' }}
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-3 transition-colors line-clamp-2 berita-title-ekonomi">
            <a href="{{ count($beritas) > 1 ? route('berita.detail', $beritas[1]->slug) : '#' }}">{{ count($beritas) > 1 ? $beritas[1]->judul : 'Pelatihan Digital Marketing untuk Pelaku UMKM Desa' }}</a>
          </h3>
          <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
          </p>
          <a href="{{ count($beritas) > 1 ? route('berita.detail', $beritas[1]->slug) : '#' }}" class="inline-flex items-center text-sm font-bold berita-cta-ekonomi group-hover:translate-x-2 transition-transform duration-300">
            Baca Selengkapnya <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
          </a>
        </div>
      </article>

      <!-- Berita Card 3: Kesehatan (Pink) -->
      <article class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 group cursor-pointer border border-slate-100 h-full flex flex-col overflow-hidden" data-aos="fade-up" data-aos-delay="200">
        <div class="relative h-64 overflow-hidden rounded-t-3xl">
          <img src="{{ count($beritas) > 2 ? ($beritas[2]->gambar ? asset('storage/' . $beritas[2]->gambar) : 'https://placehold.co/600x400/ec4899/ffffff?text=Kesehatan') : 'https://placehold.co/600x400/ec4899/ffffff?text=Kesehatan' }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="Berita">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="berita-badge kategori-kesehatan">Kesehatan</div>
        </div>
        <div class="p-8 flex-1 flex flex-col">
          <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-semibold uppercase tracking-wider">
            <i data-lucide="calendar" class="w-3 h-3"></i> {{ count($beritas) > 2 ? $beritas[2]->created_at->format('d F Y') : '12 Sep 2025' }}
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-3 transition-colors line-clamp-2 berita-title-kesehatan">
            <a href="{{ count($beritas) > 2 ? route('berita.detail', $beritas[2]->slug) : '#' }}">{{ count($beritas) > 2 ? $beritas[2]->judul : 'Posyandu Melati Sukses Gelar Imunisasi Balita' }}</a>
          </h3>
          <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
          </p>
          <a href="{{ count($beritas) > 2 ? route('berita.detail', $beritas[2]->slug) : '#' }}" class="inline-flex items-center text-sm font-bold berita-cta-kesehatan group-hover:translate-x-2 transition-transform duration-300">
            Baca Selengkapnya <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
          </a>
        </div>
      </article>
    </div>
  </div>
</section>

<section id="infografis" class="py-24 bg-slate-900 text-white relative overflow-hidden">
  <!-- Abstract Shapes -->
  <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-600 rounded-full blur-[128px] opacity-20"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-600 rounded-full blur-[128px] opacity-20"></div>
  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="text-emerald-400 font-bold uppercase tracking-widest text-sm mb-2 block">Transparansi Data</span>
      <h2 class="text-4xl md:text-5xl font-bold font-serif mb-4">Statistik Kependudukan</h2>
      <p class="text-slate-400 max-w-2xl mx-auto">Data demografi yang akurat sebagai dasar pembangunan desa yang terukur.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Stat Card 1 -->
      <div class="bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 hover:bg-white/10 transition-colors group text-center" data-aos="zoom-in" data-aos-delay="0">
        <h3 class="text-5xl font-bold mb-2 counter text-white" data-target="{{ $stat_penduduk['total_penduduk'] }}">0</h3>
        <p class="text-emerald-400 font-bold uppercase text-xs tracking-wider mb-4">Total Penduduk</p>
        <div class="w-12 h-1 bg-emerald-500 mx-auto rounded-full group-hover:w-20 transition-all duration-300"></div>
      </div>
      <!-- Stat Card 2 -->
      <div class="bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 hover:bg-white/10 transition-colors group text-center" data-aos="zoom-in" data-aos-delay="100">
        <h3 class="text-5xl font-bold mb-2 counter text-blue-300" data-target="{{ $stat_penduduk['total_kk'] }}">0</h3>
        <p class="text-blue-400 font-bold uppercase text-xs tracking-wider mb-4">Kepala Keluarga</p>
        <div class="w-12 h-1 bg-blue-500 mx-auto rounded-full group-hover:w-20 transition-all duration-300"></div>
      </div>
      <!-- Stat Card 3 -->
      <div class="bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 hover:bg-white/10 transition-colors group text-center" data-aos="zoom-in" data-aos-delay="200">
        <h3 class="text-5xl font-bold mb-2 counter text-cyan-300" data-target="{{ $stat_penduduk['total_laki'] }}">0</h3>
        <p class="text-cyan-400 font-bold uppercase text-xs tracking-wider mb-4">Laki-Laki</p>
        <div class="w-12 h-1 bg-cyan-500 mx-auto rounded-full group-hover:w-20 transition-all duration-300"></div>
      </div>
      <!-- Stat Card 4 -->
      <div class="bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 hover:bg-white/10 transition-colors group text-center" data-aos="zoom-in" data-aos-delay="300">
        <h3 class="text-5xl font-bold mb-2 counter text-pink-300" data-target="{{ $stat_penduduk['total_perempuan'] }}">0</h3>
        <p class="text-pink-400 font-bold uppercase text-xs tracking-wider mb-4">Perempuan</p>
        <div class="w-12 h-1 bg-pink-500 mx-auto rounded-full group-hover:w-20 transition-all duration-300"></div>
      </div>
    </div>
  </div>
</section>

<section class="py-24 bg-white" data-aos="fade-up">
  <div class="container mx-auto px-6 grid lg:grid-cols-12 gap-12">
    <div id="peta" class="lg:col-span-7 space-y-6">
      <div class="flex items-center gap-3">
        <div class="h-8 w-1 bg-emerald-600 rounded-full"></div>
        <h2 class="text-3xl font-bold text-slate-900 font-serif">Peta Wilayah</h2>
      </div>
      <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white h-[500px] w-full relative group">
        <iframe src="https://www.google.com/maps?q=-6.3265,107.4297&hl=id&z=15&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    <div id="pengaduan" class="lg:col-span-5">
      <div class="bg-gradient-to-br from-white to-slate-50 p-8 rounded-3xl shadow-xl border border-slate-100 h-full">
        <h2 class="text-2xl font-bold text-slate-900 mb-2 flex items-center gap-2 font-serif">
          <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg"><i data-lucide="message-circle" class="w-5 h-5"></i></div>
          Layanan Pengaduan
        </h2>
        <p class="text-slate-500 mb-6 text-sm leading-relaxed">
          Sampaikan aspirasi Anda untuk kemajuan Desa Sukaraja. Identitas pelapor dijamin kerahasiaannya.
        </p>
        
        <!-- Quick Access Links -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
          <a href="{{ route('pengaduan.index') }}" class="flex flex-col items-center justify-center p-5 bg-emerald-50 hover:bg-emerald-100 rounded-2xl transition-all duration-300 border border-emerald-200 group shadow-sm hover:shadow-md">
            <i data-lucide="edit" class="w-7 h-7 text-emerald-600 mb-3 group-hover:scale-110 transition-transform"></i>
            <span class="text-sm font-bold text-slate-800 text-center">Buat<br>Laporan</span>
          </a>
          <a href="{{ route('pengaduan.status') }}" class="flex flex-col items-center justify-center p-5 bg-blue-50 hover:bg-blue-100 rounded-2xl transition-all duration-300 border border-blue-200 group shadow-sm hover:shadow-md">
            <i data-lucide="search" class="w-7 h-7 text-blue-600 mb-3 group-hover:scale-110 transition-transform"></i>
            <span class="text-sm font-bold text-slate-800 text-center">Cek<br>Status</span>
          </a>
          <a href="{{ route('pengaduan.list') }}" class="flex flex-col items-center justify-center p-5 bg-slate-100 hover:bg-slate-200 rounded-2xl transition-all duration-300 border border-slate-300 group shadow-sm hover:shadow-md">
            <i data-lucide="bar-chart-2" class="w-7 h-7 text-slate-700 mb-3 group-hover:scale-110 transition-transform"></i>
            <span class="text-sm font-bold text-slate-800 text-center">Dashboard<br>Pengaduan</span>
          </a>
        </div>
        
      </div>
    </div>
  </div>
</section>

@endsection

