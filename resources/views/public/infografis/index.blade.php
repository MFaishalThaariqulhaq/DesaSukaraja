@extends('layouts.public.layout')

@section('content')

<!-- Hero Header Section -->
<section class="hero-bg relative h-[35vh] md:h-[45vh] flex items-center justify-center text-white overflow-hidden -mt-24">
  <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold font-serif leading-tight drop-shadow-2xl mb-4">
      Infografis <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-200">Desa</span>
    </h1>
    <p class="text-lg md:text-2xl text-slate-100 drop-shadow-md">Data dan statistik desa dalam visualisasi menarik</p>
  </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<section id="infografis-list" class="py-16 bg-slate-50">
<style>
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .bg-pattern {
    background-color: #f8fafc;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e2e8f0' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }

  @keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
  }

  .animate-float {
    animation: float 6s ease-in-out infinite;
  }

  @keyframes pulse-soft {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.05); }
  }

  .animate-pulse-soft {
    animation: pulse-soft 3s infinite;
  }

  .hover-elastic {
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s ease;
  }

  .hover-elastic:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  }

  .dusun-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85));
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .dusun-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
  }

  .dusun-card:hover::before {
    left: 100%;
  }

  .dusun-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  }
</style>

<div class="bg-pattern text-slate-800 antialiased overflow-x-hidden selection:bg-emerald-500 selection:text-white">
  <!-- Header -->
  <header class="relative bg-slate-900 text-white pb-32 pt-12 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-30">
      <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2232&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-overlay" alt="Desa Background">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-900 z-0"></div>

    <div class="container mx-auto px-6 relative z-10">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
        <div data-aos="fade-right" data-aos-duration="1200">
          <span class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 text-xs font-bold tracking-wider uppercase mb-3 animate-pulse-soft">Statistik Desa 2024</span>
          <h1 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight">Infografis <span class="text-emerald-400">Kependudukan</span></h1>
          <p class="text-slate-400 text-lg max-w-xl">Pilih salah satu dusun untuk melihat data demografi lengkap dan detail statistik penduduk.</p>
        </div>
        <div class="text-right" data-aos="fade-left" data-aos-duration="1200">
          <div class="text-slate-300 text-sm font-semibold mb-2">Update Terakhir</div>
          <div class="text-3xl md:text-4xl font-bold text-emerald-400">{{ date('F Y') }}</div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto px-6 pt-12 relative z-20 pb-20">
    <!-- Title Section -->
    <div class="mb-12" data-aos="fade-up">
      <h2 class="text-3xl font-bold text-slate-900 mb-3">Data Kependudukan per Dusun</h2>
      <p class="text-slate-600 text-lg">Klik pada dusun untuk melihat detail statistik lengkap termasuk struktur usia, pendidikan, mata pencaharian, dan agama.</p>
    </div>

    <!-- Grid Dusun -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      @forelse($data as $index => $item)
        <a href="{{ route('infografis.detail', $item->dusun) }}" class="dusun-card rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-lg hover-elastic group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
          <!-- Header dengan Icon -->
          <div class="flex items-start justify-between mb-6">
            <div>
              <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition">{{ $item->dusun }}</h3>
              <p class="text-slate-500 text-sm mt-1">Dusun</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xl group-hover:scale-110 transition-transform">
              <i class="fas fa-map-location-dot"></i>
            </div>
          </div>

          <!-- Stats Grid -->
          <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Total Penduduk -->
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 group-hover:border-emerald-200 transition">
              <div class="text-sm text-slate-600 font-medium mb-2">Total Penduduk</div>
              <div class="text-2xl font-bold text-slate-900">{{ number_format($item->total_penduduk ?? 0) }}</div>
            </div>

            <!-- Kepala Keluarga -->
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 group-hover:border-blue-200 transition">
              <div class="text-sm text-slate-600 font-medium mb-2">KK</div>
              <div class="text-2xl font-bold text-slate-900">{{ number_format($item->kepala_keluarga ?? 0) }}</div>
            </div>

            <!-- Laki-laki -->
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 group-hover:border-blue-200 transition">
              <div class="text-sm text-slate-600 font-medium mb-2">Laki-laki</div>
              <div class="text-2xl font-bold text-blue-600">{{ number_format($item->laki_laki ?? 0) }}</div>
            </div>

            <!-- Perempuan -->
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 group-hover:border-pink-200 transition">
              <div class="text-sm text-slate-600 font-medium mb-2">Perempuan</div>
              <div class="text-2xl font-bold text-pink-600">{{ number_format($item->perempuan ?? 0) }}</div>
            </div>
          </div>

          <!-- Footer -->
          <div class="flex items-center justify-between pt-4 border-t border-slate-100">
            <span class="text-sm text-slate-500">Klik untuk lihat detail</span>
            <span class="text-emerald-600 font-semibold group-hover:translate-x-1 transition-transform">
              <i class="fas fa-arrow-right"></i>
            </span>
          </div>
        </a>
      @empty
        <div class="col-span-full text-center py-12">
          <div class="text-slate-400 mb-4">
            <i class="fas fa-inbox text-4xl"></i>
          </div>
          <p class="text-slate-600 text-lg">Belum ada data dusun</p>
        </div>
      @endforelse
    </div>
  </div>

  <!-- Footer -->
  <footer class="border-t border-slate-200 bg-white mt-12">
    <div class="container mx-auto px-6 py-8">
      <div class="text-center text-slate-600 text-sm">
        <p>© {{ date('Y') }} Desa Sukaraja. Semua data diperbarui secara berkala.</p>
      </div>
    </div>
  </footer>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true,
    offset: 50
  });
</script>

@endsection
