@extends('layouts.public.layout')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Data untuk infografis charts -->
<script>
  window.infografisData = {
    ageChart: {
      labels: ['Balita (0-5)', 'Anak (6-12)', 'Remaja (13-17)', 'Dewasa (18-59)', 'Lansia (60+)'],
      male: [{{ ($data->kelompok_usia_0_5 ?? 0) / 2 }}, {{ ($data->kelompok_usia_6_11 ?? 0) / 2 }}, {{ ($data->kelompok_usia_12_17 ?? 0) / 2 }}, {{ ($data->kelompok_usia_18_25 ?? 0) / 2 }}, {{ ($data->kelompok_usia_61_keatas ?? 0) / 2 }}],
      female: [{{ ($data->kelompok_usia_0_5 ?? 0) / 2 }}, {{ ($data->kelompok_usia_6_11 ?? 0) / 2 }}, {{ ($data->kelompok_usia_12_17 ?? 0) / 2 }}, {{ ($data->kelompok_usia_18_25 ?? 0) / 2 }}, {{ ($data->kelompok_usia_61_keatas ?? 0) / 2 }}]
    },
    educationChart: {
      labels: ['SD', 'SMP', 'SMA/K', 'Diploma/Sarjana', 'Belum Sekolah'],
      data: [{{ $data->pendidikan_sd }}, {{ $data->pendidikan_smp }}, {{ $data->pendidikan_sma }}, {{ $data->pendidikan_diploma }}, {{ $data->pendidikan_belum }}]
    },
    jobChart: {
      labels: ['Petani', 'Wiraswasta', 'Karyawan Swasta', 'PNS/TNI/Polri', 'Ibu Rumah Tangga', 'Belum Bekerja'],
      data: [{{ $data->pekerjaan_petani }}, {{ $data->pekerjaan_wiraswasta }}, {{ $data->pekerjaan_karyawan }}, {{ $data->pekerjaan_pns }}, {{ $data->pekerjaan_ibu_rumah_tangga }}, {{ $data->pekerjaan_belum }}]
    },
    religionChart: {
      labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'],
      data: [{{ $data->agama_islam }}, {{ $data->agama_kristen }}, {{ $data->agama_katolik }}, {{ $data->agama_hindu }}, {{ $data->agama_buddha }}]
    }
  };

  // Initialize AOS
  if (window.AOS) {
    AOS.init({
      duration: 1000,
      once: true,
      offset: 50,
      easing: 'ease-out-cubic',
      delay: 50
    });
  }
</script>
@endpush

<div class="bg-pattern text-slate-800 antialiased overflow-x-hidden selection:bg-emerald-500 selection:text-white">
  <!-- Header -->
  <header class="relative text-white py-10 overflow-hidden border-b border-slate-800 -mt-12" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.85), rgba(51, 65, 85, 0.85)), url('https://images.unsplash.com/photo-1469022563149-aa64dbd37dae?q=80&w=2070&auto=format&fit=crop') center/cover;">
    <div class="container mx-auto px-6 relative z-10">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
        <div data-aos="fade-right" data-aos-duration="1200" class="w-full md:w-auto">
          <a href="{{ route('infografis.index') }}" class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-lg bg-slate-700/50 hover:bg-slate-600 border border-slate-600 hover:border-emerald-400 text-slate-300 hover:text-emerald-400 transition duration-300 font-medium text-sm">
            <i class="fas fa-arrow-left"></i>Kembali
          </a>
          <span class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 text-xs font-bold tracking-wider uppercase mb-3 animate-pulse-soft">Detail Dusun</span>
          <h1 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight">Dusun <span class="text-emerald-400">{{ $data->dusun }}</span></h1>
          <p class="text-slate-400 text-lg max-w-xl">Data demografi lengkap penduduk Dusun {{ $data->dusun }}.</p>
        </div>
        <div class="glass-effect !bg-slate-800/50 !border-slate-700 text-white px-5 py-3 rounded-xl flex items-center gap-3 hover-elastic cursor-default" data-aos="fade-left" data-aos-delay="200">
          <div class="bg-emerald-500/20 p-2 rounded-lg">
            <i class="far fa-calendar-check text-emerald-400"></i>
          </div>
          <div>
            <p class="text-xs text-slate-400 uppercase tracking-wide">Update Terakhir</p>
            <p class="font-bold">{{ date('F Y') }}</p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto px-6 pt-12 relative z-20 pb-20">

    <!-- Key Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      <!-- Total Penduduk -->
      <div class="gradient-card-1 rounded-2xl p-6 shadow-xl text-white relative overflow-hidden group hover-elastic" data-aos="fade-up" data-aos-delay="0">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition duration-500 animate-float">
          <i class="fas fa-users text-8xl transform translate-x-4 -translate-y-4"></i>
        </div>
        <div class="relative z-10">
          <div class="flex items-center gap-2 mb-4">
            <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm shadow-inner">
              <i class="fas fa-users text-white"></i>
            </div>
          </div>
          <p class="text-emerald-100 text-sm font-medium">Total Penduduk</p>
          <h3 class="text-4xl font-bold mt-1 tracking-tight">{{ number_format($data->total_penduduk ?? 0) }}</h3>
        </div>
      </div>

      <!-- Kepala Keluarga -->
      <div class="gradient-card-2 rounded-2xl p-6 shadow-xl text-white relative overflow-hidden group hover-elastic" data-aos="fade-up" data-aos-delay="100">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition duration-500 animate-float" style="animation-delay: 1s;">
          <i class="fas fa-home text-8xl transform translate-x-4 -translate-y-4"></i>
        </div>
        <div class="relative z-10">
          <div class="flex items-center gap-2 mb-4">
            <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm shadow-inner">
              <i class="fas fa-home text-white"></i>
            </div>
          </div>
          <p class="text-blue-100 text-sm font-medium">Kepala Keluarga</p>
          <h3 class="text-4xl font-bold mt-1 tracking-tight">{{ number_format($data->kepala_keluarga ?? 0) }}</h3>
        </div>
      </div>

      <!-- Laki-laki -->
      <div class="gradient-card-3 rounded-2xl p-6 shadow-xl text-white relative overflow-hidden group hover-elastic" data-aos="fade-up" data-aos-delay="200">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition duration-500 animate-float" style="animation-delay: 2s;">
          <i class="fas fa-male text-8xl transform translate-x-4 -translate-y-4"></i>
        </div>
        <div class="relative z-10">
          <div class="flex items-center gap-2 mb-4">
            <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm shadow-inner">
              <i class="fas fa-male text-white"></i>
            </div>
            @php $total = $data->total_penduduk ?? 1; @endphp
            <span class="text-xs font-bold bg-white/20 px-2 py-1 rounded text-white">{{ round(($data->laki_laki ?? 0)/$total*100, 1) }}%</span>
          </div>
          <p class="text-sky-100 text-sm font-medium">Laki-laki</p>
          <h3 class="text-4xl font-bold mt-1 tracking-tight">{{ number_format($data->laki_laki ?? 0) }}</h3>
        </div>
      </div>

      <!-- Perempuan -->
      <div class="gradient-card-4 rounded-2xl p-6 shadow-xl text-white relative overflow-hidden group hover-elastic" data-aos="fade-up" data-aos-delay="300">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition duration-500 animate-float" style="animation-delay: 3s;">
          <i class="fas fa-female text-8xl transform translate-x-4 -translate-y-4"></i>
        </div>
        <div class="relative z-10">
          <div class="flex items-center gap-2 mb-4">
            <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm shadow-inner">
              <i class="fas fa-female text-white"></i>
            </div>
            <span class="text-xs font-bold bg-white/20 px-2 py-1 rounded text-white">{{ round(($data->perempuan ?? 0)/$total*100, 1) }}%</span>
          </div>
          <p class="text-pink-100 text-sm font-medium">Perempuan</p>
          <h3 class="text-4xl font-bold mt-1 tracking-tight">{{ number_format($data->perempuan ?? 0) }}</h3>
        </div>
      </div>
    </div>

    <!-- Charts Section Row 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
      <!-- Grafik Usia (Bar Chart) -->
      <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg transition duration-500 overflow-hidden" data-aos="fade-right">
        <div class="flex items-center justify-between mb-0 p-8 pb-4 cursor-pointer hover:bg-slate-50 transition" onclick="toggleChart(this, 'ageChartContainer')">
          <div>
            <h3 class="text-xl font-bold text-slate-800">Struktur Usia</h3>
            <p class="text-slate-500 text-sm">Distribusi penduduk berdasarkan kelompok umur</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="p-2 bg-slate-50 rounded-lg">
              <i class="fas fa-chart-bar text-slate-400"></i>
            </div>
            <button class="p-2 hover:bg-slate-100 rounded-lg transition chart-toggle-btn">
              <i class="fas fa-chevron-down text-slate-600"></i>
            </button>
          </div>
        </div>
        <div id="ageChartContainer" class="p-8 pt-4 border-t border-slate-100">
          <div class="relative h-80">
            <canvas id="ageChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Grafik Pendidikan (Doughnut Chart) -->
      <div class="bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg transition duration-500 overflow-hidden" data-aos="fade-left">
        <div class="flex items-center justify-between mb-0 p-8 pb-4 cursor-pointer hover:bg-slate-50 transition" onclick="toggleChart(this, 'eduChartContainer')">
          <div>
            <h3 class="text-xl font-bold text-slate-800">Pendidikan</h3>
            <p class="text-slate-500 text-sm">Jenjang pendidikan terakhir</p>
          </div>
          <div class="flex items-center">
            <button class="p-2 hover:bg-slate-100 rounded-lg transition chart-toggle-btn">
              <i class="fas fa-chevron-down text-slate-600"></i>
            </button>
          </div>
        </div>
        <div id="eduChartContainer" class="p-8 pt-4 border-t border-slate-100">
          <div class="relative h-64 flex justify-center">
            <canvas id="educationChart"></canvas>
          </div>
          @php
            $eduData = [
              'SD' => $data->pendidikan_sd ?? 0,
              'SMP' => $data->pendidikan_smp ?? 0,
              'SMA/K' => $data->pendidikan_sma ?? 0,
              'Diploma/Sarjana' => $data->pendidikan_diploma ?? 0,
              'Belum Sekolah' => $data->pendidikan_belum ?? 0
            ];
            $maxEdu = array_key_first(array_filter($eduData, function($val) use ($eduData) { 
              return $val === max($eduData); 
            }));
            $maxEduLabel = $maxEdu ?? 'SMA/Sederajat';
          @endphp
          <div class="mt-6 text-center bg-emerald-50 rounded-xl p-4 group">
            <p class="text-xs text-emerald-600 font-semibold uppercase tracking-wide mb-1 group-hover:scale-105 transition-transform">Highlight</p>
            <p class="text-sm text-slate-700">Mayoritas penduduk adalah tamatan <span class="font-bold text-slate-900">{{ $maxEduLabel }}</span></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts Section Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
      <!-- Grafik Pekerjaan (Horizontal Bar) -->
      <div class="bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg transition duration-500 overflow-hidden" data-aos="fade-up">
        <div class="flex items-center justify-between mb-0 p-8 pb-4 cursor-pointer hover:bg-slate-50 transition" onclick="toggleChart(this, 'jobChartContainer')">
          <div>
            <h3 class="text-xl font-bold text-slate-800">Mata Pencaharian</h3>
            <p class="text-slate-500 text-sm">Sektor pekerjaan utama penduduk</p>
          </div>
          <div class="flex items-center">
            <button class="p-2 hover:bg-slate-100 rounded-lg transition chart-toggle-btn">
              <i class="fas fa-chevron-down text-slate-600"></i>
            </button>
          </div>
        </div>
        <div id="jobChartContainer" class="p-8 pt-4 border-t border-slate-100">
          <div class="relative h-80">
            <canvas id="jobChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Grafik Agama (Pie) -->
      <div class="bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg transition duration-500 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center justify-between mb-0 p-8 pb-4 cursor-pointer hover:bg-slate-50 transition" onclick="toggleChart(this, 'relChartContainer')">
          <div>
            <h3 class="text-xl font-bold text-slate-800">Agama & Kepercayaan</h3>
            <p class="text-slate-500 text-sm">Komposisi pemeluk agama</p>
          </div>
          <div class="flex items-center">
            <button class="p-2 hover:bg-slate-100 rounded-lg transition chart-toggle-btn">
              <i class="fas fa-chevron-down text-slate-600"></i>
            </button>
          </div>
        </div>
        <div id="relChartContainer" class="p-8 pt-4 border-t border-slate-100">
          <div class="relative h-64 flex-1 flex justify-center items-center">
            <canvas id="religionChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Laporan Mutasi Penduduk -->
    <div class="bg-slate-900 rounded-3xl shadow-2xl overflow-hidden mb-12" data-aos="fade-up" data-aos-duration="1200">
      <div class="p-8 md:p-12 text-center md:text-left relative">
        <!-- Background Glow -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

        <div class="flex flex-col md:flex-row justify-between items-end mb-10 relative z-10">
          <div>
            <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">Laporan Mutasi Penduduk</h3>
            <p class="text-slate-400">Pergerakan penduduk bulan {{ $data->bulan ?? date('m') }} tahun {{ $data->tahun ?? date('Y') }}.</p>
          </div>
          <span class="mt-4 md:mt-0 bg-emerald-500 text-white px-4 py-1.5 rounded-full text-sm font-semibold shadow-lg shadow-emerald-500/30 animate-pulse">Periode: {{ date('F Y') }}</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 relative z-10">
          <!-- Lahir -->
          <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-emerald-900/40 hover:border-emerald-500/50 transition duration-300 transform hover:-translate-y-2 group">
            <div class="w-12 h-12 bg-emerald-500/20 text-emerald-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
              <i class="fas fa-baby"></i>
            </div>
            <div class="text-3xl font-bold text-white mb-1">{{ number_format($data->lahir ?? 0) }}</div>
            <div class="text-sm text-slate-400 font-medium">Kelahiran</div>
          </div>

          <!-- Meninggal -->
          <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-rose-900/40 hover:border-rose-500/50 transition duration-300 transform hover:-translate-y-2 group">
            <div class="w-12 h-12 bg-rose-500/20 text-rose-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
              <i class="fas fa-cross"></i>
            </div>
            <div class="text-3xl font-bold text-white mb-1">{{ number_format($data->mati ?? 0) }}</div>
            <div class="text-sm text-slate-400 font-medium">Meninggal</div>
          </div>

          <!-- Masuk -->
          <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-blue-900/40 hover:border-blue-500/50 transition duration-300 transform hover:-translate-y-2 group">
            <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
              <i class="fas fa-arrow-right"></i>
            </div>
            <div class="text-3xl font-bold text-white mb-1">{{ number_format($data->datang ?? 0) }}</div>
            <div class="text-sm text-slate-400 font-medium">Pindah Masuk</div>
          </div>

          <!-- Keluar -->
          <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-orange-900/40 hover:border-orange-500/50 transition duration-300 transform hover:-translate-y-2 group">
            <div class="w-12 h-12 bg-orange-500/20 text-orange-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
              <i class="fas fa-arrow-left"></i>
            </div>
            <div class="text-3xl font-bold text-white mb-1">{{ number_format($data->pindah ?? 0) }}</div>
            <div class="text-sm text-slate-400 font-medium">Pindah Keluar</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
