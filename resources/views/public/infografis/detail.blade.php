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

<div class="bg-white text-slate-800 antialiased overflow-hidden selection:bg-emerald-500 selection:text-white">
  <!-- Header -->
  <header class="relative bg-gradient-to-r from-emerald-600 to-emerald-700 py-8 overflow-hidden -mt-20 pt-32">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=%2760%27 height=%2760%27 viewBox=%270 0 60 60%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cg fill=%27none%27 fill-rule=%27evenodd%27%3E%3Cg fill=%27%23ffffff%27 fill-opacity=%270.05%27%3E%3Cpath d=%27M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%27/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>

    <!-- Header Content -->
    <div class="container mx-auto px-6 relative z-10">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
        <!-- Left Section: Back Button + Title -->
        <div data-aos="fade-right" data-aos-duration="1000">
          <a href="{{ route('infografis.index') }}" class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-lg bg-white/20 hover:bg-white/30 border border-white/30 text-white transition duration-300 font-medium text-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali</span>
          </a>
          <h1 class="text-4xl md:text-5xl font-bold font-serif leading-tight text-black drop-shadow-lg">
            Dusun <span class="text-black">{{ $data->dusun }}</span>
          </h1>
          <p class="text-slate-900 text-lg mt-3 font-medium">Data demografi lengkap penduduk</p>
        </div>

        <!-- Right Section: Last Update -->
        <div class="bg-white/10 backdrop-blur-md border border-white/20 px-6 py-4 rounded-xl" data-aos="fade-left" data-aos-duration="1000">
          <p class="text-xs uppercase tracking-wider font-medium text-black">Update Terakhir</p>
          <p class="text-2xl font-bold mt-1 text-black">{{ date('F Y') }}</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto px-6 py-12 text-slate-800">

    <!-- Key Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      <!-- Total Penduduk -->
      <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 shadow-lg hover:shadow-xl transition" data-aos="fade-up">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-white/20 p-3 rounded-lg">
            <i data-lucide="users" class="w-6 h-6 text-black"></i>
          </div>
        </div>
        <p class="text-sm font-medium text-emerald-950">Total Penduduk</p>
        <h3 class="text-4xl font-bold mt-2 text-black">{{ number_format($data->total_penduduk ?? 0) }}</h3>
      </div>

      <!-- Kepala Keluarga -->
      <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-white/20 p-3 rounded-lg">
            <i data-lucide="home" class="w-6 h-6 text-black"></i>
          </div>
        </div>
        <p class="text-sm font-medium text-blue-950">Kepala Keluarga</p>
        <h3 class="text-4xl font-bold mt-2 text-black">{{ number_format($data->kepala_keluarga ?? 0) }}</h3>
      </div>

      <!-- Laki-laki -->
      <div class="bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl p-6 shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-white/20 p-3 rounded-lg">
            <i data-lucide="user" class="w-6 h-6 text-black"></i>
          </div>
        </div>
        <p class="text-sm font-medium text-blue-950">Laki-laki</p>
        <h3 class="text-4xl font-bold mt-2 text-black">{{ number_format($data->laki_laki ?? 0) }}</h3>
      </div>

      <!-- Perempuan -->
      <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl p-6 shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="300">
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
