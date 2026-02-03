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
<header class="infografis-detail-header text-white py-10 relative overflow-hidden border-b border-slate-800 -mt-12">
  <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
    <a href="{{ route('infografis.index') }}"
      class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition mb-3">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span class="font-medium text-sm">Kembali ke Infografis</span>
    </a>
    <h1 class="text-3xl md:text-4xl font-bold mb-3">Dusun {{ $data->dusun }}</h1>
    <div class="flex items-center gap-4 text-slate-300 flex-wrap text-sm">
      <span class="inline-block bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
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
  <div class="container mx-auto px-6 py-12 text-slate-800">

    <!-- Key Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      <!-- Total Penduduk -->
      <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300 transform" data-aos="fade-up">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-white/20 p-3 rounded-lg">
            <i data-lucide="users" class="w-6 h-6 text-black"></i>
          </div>
        </div>
        <p class="text-sm font-medium text-emerald-950">Total Penduduk</p>
        <h3 class="text-4xl font-bold mt-2 text-black">{{ number_format($data->total_penduduk ?? 0) }}</h3>
      </div>

      <!-- Kepala Keluarga -->
      <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300 transform" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-white/20 p-3 rounded-lg">
            <i data-lucide="home" class="w-6 h-6 text-black"></i>
          </div>
        </div>
        <p class="text-sm font-medium text-blue-950">Kepala Keluarga</p>
        <h3 class="text-4xl font-bold mt-2 text-black">{{ number_format($data->kepala_keluarga ?? 0) }}</h3>
      </div>

      <!-- Laki-laki -->
      <div class="bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300 transform" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-white/20 p-3 rounded-lg">
            <i data-lucide="user" class="w-6 h-6 text-black"></i>
          </div>
        </div>
        <p class="text-sm font-medium text-blue-950">Laki-laki</p>
        <h3 class="text-4xl font-bold mt-2 text-black">{{ number_format($data->laki_laki ?? 0) }}</h3>
      </div>

      <!-- Perempuan -->
      <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300 transform" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-white/20 p-3 rounded-lg">
            <i data-lucide="user" class="w-6 h-6 text-black"></i>
          </div>
        </div>
        <p class="text-sm font-medium text-pink-950">Perempuan</p>
        <h3 class="text-4xl font-bold mt-2 text-black">{{ number_format($data->perempuan ?? 0) }}</h3>
      </div>
    </div>

    <!-- Charts Section Row 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
      <!-- Age Chart -->
      <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up">
        <h3 class="text-xl font-bold text-slate-900 mb-2">Kelompok Usia</h3>
        <p class="text-slate-500 text-sm mb-6">Distribusi penduduk per kelompok usia</p>
        <div class="relative h-80">
          <canvas id="ageChart"></canvas>
        </div>
      </div>

      <!-- Education Chart -->
      <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="100">
        <h3 class="text-xl font-bold text-slate-900 mb-2">Pendidikan</h3>
        <p class="text-slate-500 text-sm mb-6">Jenjang pendidikan terakhir penduduk</p>
        <div class="relative h-80 flex justify-center">
          <canvas id="educationChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Charts Section Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
      <!-- Job Chart -->
      <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up">
        <h3 class="text-xl font-bold text-slate-900 mb-2">Mata Pencaharian</h3>
        <p class="text-slate-500 text-sm mb-6">Sektor pekerjaan utama penduduk</p>
        <div class="relative h-80">
          <canvas id="jobChart"></canvas>
        </div>
      </div>

      <!-- Religion Chart -->
      <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-8 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="100">
        <h3 class="text-xl font-bold text-slate-900 mb-2">Agama & Kepercayaan</h3>
        <p class="text-slate-500 text-sm mb-6">Komposisi pemeluk agama penduduk</p>
        <div class="relative h-80 flex justify-center">
          <canvas id="religionChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Population Mutation Report -->
    <div class="bg-gradient-to-br from-emerald-600 to-teal-600 rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up">
      <div class="p-8 md:p-12">
        <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">Laporan Mutasi Penduduk</h3>
        <p class="text-slate-900 mb-8 font-medium">Pergerakan penduduk periode {{ $data->bulan ?? date('m') }}/{{ $data->tahun ?? date('Y') }}</p>

        <!-- Mutation Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
          <!-- Birth -->
          <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 text-center hover:bg-white/20 transition">
            <div class="text-3xl font-bold mb-2 text-black">{{ number_format($data->lahir ?? 0) }}</div>
            <p class="text-sm text-black font-medium">Kelahiran</p>
          </div>

          <!-- Death -->
          <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 text-center hover:bg-white/20 transition">
            <div class="text-3xl font-bold mb-2 text-black">{{ number_format($data->mati ?? 0) }}</div>
            <p class="text-sm text-black font-medium">Meninggal</p>
          </div>

          <!-- In Migration -->
          <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 text-center hover:bg-white/20 transition">
            <div class="text-3xl font-bold mb-2 text-black">{{ number_format($data->datang ?? 0) }}</div>
            <p class="text-sm text-black font-medium">Pindah Masuk</p>
          </div>

          <!-- Out Migration -->
          <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 text-center hover:bg-white/20 transition">
            <div class="text-3xl font-bold mb-2 text-black">{{ number_format($data->pindah ?? 0) }}</div>
            <p class="text-sm text-black font-medium">Pindah Keluar</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
