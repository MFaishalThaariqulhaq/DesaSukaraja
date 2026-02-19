@extends('layouts.public.layout')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3"></script>
<script type="application/json" id="infografis-data">
{
  "age": {
    "male": [{{ ($data->kelompok_usia_0_5 ?? 0) / 2 }}, {{ ($data->kelompok_usia_6_11 ?? 0) / 2 }}, {{ ($data->kelompok_usia_12_17 ?? 0) / 2 }}, {{ ($data->kelompok_usia_18_25 ?? 0) / 2 }}, {{ ($data->kelompok_usia_61_keatas ?? 0) / 2 }}],
    "female": [{{ ($data->kelompok_usia_0_5 ?? 0) / 2 }}, {{ ($data->kelompok_usia_6_11 ?? 0) / 2 }}, {{ ($data->kelompok_usia_12_17 ?? 0) / 2 }}, {{ ($data->kelompok_usia_18_25 ?? 0) / 2 }}, {{ ($data->kelompok_usia_61_keatas ?? 0) / 2 }}]
  },
  "education": [{{ $data->pendidikan_sd }}, {{ $data->pendidikan_smp }}, {{ $data->pendidikan_sma }}, {{ $data->pendidikan_diploma }}, {{ $data->pendidikan_belum }}],
  "job": [{{ $data->pekerjaan_petani }}, {{ $data->pekerjaan_wiraswasta }}, {{ $data->pekerjaan_karyawan }}, {{ $data->pekerjaan_pns }}, {{ $data->pekerjaan_ibu_rumah_tangga }}, {{ $data->pekerjaan_belum }}],
  "religion": [{{ $data->agama_islam }}, {{ $data->agama_kristen }}, {{ $data->agama_katolik }}, {{ $data->agama_hindu }}, {{ $data->agama_buddha }}]
}
</script>
@endpush

@section('content')

<!-- Header Section -->
<header class="infografis-detail-header text-white pt-16 pb-10 md:pt-20 md:pb-12 relative overflow-hidden border-b border-slate-800 -mt-12">
  <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
    <a href="{{ route('infografis.index') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-white/10 text-white border border-white/30 hover:bg-white/20 hover:border-white/50 transition-all duration-300 mb-4 backdrop-blur-sm">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span class="font-semibold text-sm tracking-wide">Kembali ke Infografis</span>
    </a>
    <h1 class="text-3xl md:text-4xl font-bold mb-3">Dusun {{ $data->dusun }}</h1>
    <div class="flex items-center gap-4 text-slate-300 flex-wrap text-sm">
      <span class="inline-block bg-emerald-700 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
        Data Demografi
      </span>
      <span class="flex items-center gap-2">
        <i data-lucide="calendar" class="w-4 h-4"></i>
        {{ date('d F Y') }}
      </span>
    </div>
  </div>
</header>

<div class="bg-white text-slate-800 antialiased overflow-hidden selection:bg-emerald-500 selection:text-white">

  <!-- Main Content -->
  <div class="container mx-auto px-6 pt-10 pb-12 md:pt-12 text-slate-800">

    <!-- Key Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      <!-- Total Penduduk -->
      <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36 hover:shadow-lg hover:border-emerald-200 transition-all duration-300 group cursor-default" data-aos="fade-up">
        <div class="flex justify-between items-start">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wider group-hover:text-emerald-600 transition-colors">Total Penduduk</span>
          <div class="p-2 bg-emerald-50 rounded-lg group-hover:bg-emerald-100 transition-colors">
            <i data-lucide="users" class="w-5 h-5 text-emerald-600"></i>
          </div>
        </div>
        <div>
          <div class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ number_format($data->total_penduduk ?? 0) }}</div>
          <div class="text-sm font-medium text-slate-400 mt-1">Jiwa</div>
        </div>
      </div>

      <!-- Kepala Keluarga -->
      <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36 hover:shadow-lg hover:border-blue-200 transition-all duration-300 group cursor-default" data-aos="fade-up" data-aos-delay="100">
        <div class="flex justify-between items-start">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wider group-hover:text-blue-600 transition-colors">Kepala Keluarga</span>
          <div class="p-2 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors">
            <i data-lucide="home" class="w-5 h-5 text-blue-600"></i>
          </div>
        </div>
        <div>
          <div class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ number_format($data->kepala_keluarga ?? 0) }}</div>
          <div class="text-sm font-medium text-slate-400 mt-1">KK</div>
        </div>
      </div>

      <!-- Laki-laki -->
      <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36 hover:shadow-lg hover:border-cyan-200 transition-all duration-300 group cursor-default" data-aos="fade-up" data-aos-delay="200">
        <div class="flex justify-between items-start">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wider group-hover:text-cyan-600 transition-colors">Laki-laki</span>
          <div class="p-2 bg-cyan-50 rounded-lg group-hover:bg-cyan-100 transition-colors">
            <i data-lucide="user" class="w-5 h-5 text-cyan-600"></i>
          </div>
        </div>
        <div>
          <div class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ number_format($data->laki_laki ?? 0) }}</div>
          <div class="text-sm font-medium text-slate-400 mt-1">Jiwa</div>
        </div>
      </div>

      <!-- Perempuan -->
      <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36 hover:shadow-lg hover:border-pink-200 transition-all duration-300 group cursor-default" data-aos="fade-up" data-aos-delay="300">
        <div class="flex justify-between items-start">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wider group-hover:text-pink-600 transition-colors">Perempuan</span>
          <div class="p-2 bg-pink-50 rounded-lg group-hover:bg-pink-100 transition-colors">
            <i data-lucide="user" class="w-5 h-5 text-pink-600"></i>
          </div>
        </div>
        <div>
          <div class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ number_format($data->perempuan ?? 0) }}</div>
          <div class="text-sm font-medium text-slate-400 mt-1">Jiwa</div>
        </div>
      </div>
    </div>

    <!-- Charts Section Row 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
      <!-- Age Chart -->
      <div class="bg-white rounded-3xl shadow-[0_2px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up">
        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-sm font-bold">1</div>
          Kelompok Usia
        </h3>
        <div class="relative h-72">
          <canvas id="ageChart"></canvas>
        </div>
      </div>

      <!-- Education Chart -->
      <div class="bg-white rounded-3xl shadow-[0_2px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="100">
        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 text-sm font-bold">2</div>
          Pendidikan
        </h3>
        <div class="relative h-72 flex justify-center">
          <canvas id="educationChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Charts Section Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
      <!-- Job Chart -->
      <div class="bg-white rounded-3xl shadow-[0_2px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up">
        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-sm font-bold">3</div>
          Mata Pencaharian
        </h3>
        <div class="relative h-72">
          <canvas id="jobChart"></canvas>
        </div>
      </div>

      <!-- Religion Chart -->
      <div class="bg-white rounded-3xl shadow-[0_2px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="100">
        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 text-sm font-bold">4</div>
          Agama & Kepercayaan
        </h3>
        <div class="relative h-72 flex justify-center">
          <canvas id="religionChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Population Mutation Report -->
    <div class="bg-slate-900 rounded-3xl shadow-2xl p-8 md:p-12 overflow-hidden relative group" data-aos="fade-up">
      <!-- Animated Background Gradients -->
      <div class="absolute right-0 top-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3 animate-pulse"></div>
      <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/3"></div>

      <div class="relative z-10 mb-10 text-center md:text-left">
        <span class="inline-block py-1 px-3 rounded-full bg-slate-800 border border-slate-700 text-emerald-400 text-xs font-bold tracking-widest uppercase mb-4">Live Report</span>
        <h3 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Laporan Mutasi Penduduk</h3>
        <p class="text-slate-400 mt-2 text-lg">Pergerakan dinamika penduduk periode {{ $data->bulan ?? date('m') }}/{{ $data->tahun ?? date('Y') }}</p>
      </div>

      <!-- Mutation Stats Grid -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 relative z-10">
        <!-- Kelahiran -->
        <div class="relative group/card bg-slate-800/40 backdrop-blur-md rounded-2xl border border-slate-700/50 p-6 flex flex-col items-center justify-center text-center transition-all duration-300 hover:bg-slate-800 hover:border-emerald-500/30 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(16,185,129,0.2)]">
          <div class="w-14 h-14 rounded-full bg-slate-700/50 flex items-center justify-center mb-4 group-hover/card:bg-emerald-500/20 group-hover/card:scale-110 transition-all duration-300">
            <i data-lucide="baby" class="w-7 h-7 text-slate-400 group-hover/card:text-emerald-400 transition-colors"></i>
          </div>
          <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1 group-hover/card:text-emerald-200 transition-colors">Kelahiran</span>
          <span class="text-4xl font-black text-white group-hover/card:text-emerald-400 transition-colors">{{ number_format($data->lahir ?? 0) }}</span>
        </div>

        <!-- Meninggal -->
        <div class="relative group/card bg-slate-800/40 backdrop-blur-md rounded-2xl border border-slate-700/50 p-6 flex flex-col items-center justify-center text-center transition-all duration-300 hover:bg-slate-800 hover:border-red-500/30 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(239,68,68,0.2)]">
          <div class="w-14 h-14 rounded-full bg-slate-700/50 flex items-center justify-center mb-4 group-hover/card:bg-red-500/20 group-hover/card:scale-110 transition-all duration-300">
            <i data-lucide="activity" class="w-7 h-7 text-slate-400 group-hover/card:text-red-400 transition-colors"></i>
          </div>
          <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1 group-hover/card:text-red-200 transition-colors">Meninggal</span>
          <span class="text-4xl font-black text-white group-hover/card:text-red-400 transition-colors">{{ number_format($data->mati ?? 0) }}</span>
        </div>

        <!-- Pindah Masuk -->
        <div class="relative group/card bg-slate-800/40 backdrop-blur-md rounded-2xl border border-slate-700/50 p-6 flex flex-col items-center justify-center text-center transition-all duration-300 hover:bg-slate-800 hover:border-blue-500/30 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(59,130,246,0.2)]">
          <div class="w-14 h-14 rounded-full bg-slate-700/50 flex items-center justify-center mb-4 group-hover/card:bg-blue-500/20 group-hover/card:scale-110 transition-all duration-300">
            <i data-lucide="log-in" class="w-7 h-7 text-slate-400 group-hover/card:text-blue-400 transition-colors"></i>
          </div>
          <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1 group-hover/card:text-blue-200 transition-colors">Masuk</span>
          <span class="text-4xl font-black text-white group-hover/card:text-blue-400 transition-colors">{{ number_format($data->datang ?? 0) }}</span>
        </div>

        <!-- Pindah Keluar -->
        <div class="relative group/card bg-slate-800/40 backdrop-blur-md rounded-2xl border border-slate-700/50 p-6 flex flex-col items-center justify-center text-center transition-all duration-300 hover:bg-slate-800 hover:border-orange-500/30 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(249,115,22,0.2)]">
          <div class="w-14 h-14 rounded-full bg-slate-700/50 flex items-center justify-center mb-4 group-hover/card:bg-orange-500/20 group-hover/card:scale-110 transition-all duration-300">
            <i data-lucide="log-out" class="w-7 h-7 text-slate-400 group-hover/card:text-orange-400 transition-colors"></i>
          </div>
          <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1 group-hover/card:text-orange-200 transition-colors">Keluar</span>
          <span class="text-4xl font-black text-white group-hover/card:text-orange-400 transition-colors">{{ number_format($data->pindah ?? 0) }}</span>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
