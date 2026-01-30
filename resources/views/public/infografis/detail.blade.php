@extends('public.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .glass-effect {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .gradient-card-1 {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  }

  .gradient-card-2 {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  }

  .gradient-card-3 {
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
  }

  .gradient-card-4 {
    background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
  }

  .bg-pattern {
    background-color: #f8fafc;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e2e8f0' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }

  @keyframes float {
    0% {
      transform: translateY(0px);
    }

    50% {
      transform: translateY(-10px);
    }

    100% {
      transform: translateY(0px);
    }
  }

  .animate-float {
    animation: float 6s ease-in-out infinite;
  }

  @keyframes pulse-soft {
    0%,
    100% {
      opacity: 1;
      transform: scale(1);
    }

    50% {
      opacity: 0.8;
      transform: scale(1.05);
    }
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
</style>

<div class="bg-pattern text-slate-800 antialiased overflow-x-hidden selection:bg-emerald-500 selection:text-white">
  <!-- Header -->
  <header class="relative bg-slate-900 text-white pb-24 pt-12 overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute inset-0 z-0 opacity-30">
      <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2232&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-overlay" alt="Desa Background">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-900 z-0"></div>

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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // Function untuk toggle chart visibility
  function toggleChart(headerElement, containerId) {
    const container = document.getElementById(containerId);
    const btn = headerElement.querySelector('.chart-toggle-btn i');
    
    if (container.classList.contains('hidden')) {
      container.classList.remove('hidden');
      btn.classList.remove('fa-chevron-right');
      btn.classList.add('fa-chevron-down');
    } else {
      container.classList.add('hidden');
      btn.classList.remove('fa-chevron-down');
      btn.classList.add('fa-chevron-right');
    }
  }

  // Init AOS with Smoother Settings
  AOS.init({
    duration: 1000,
    once: true,
    offset: 50,
    easing: 'ease-out-cubic',
    delay: 50
  });

  // Chart Configs
  Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
  Chart.defaults.color = '#64748b';

  const commonAnimation = {
    duration: 2000,
    easing: 'easeOutQuart'
  };

  document.addEventListener('DOMContentLoaded', function() {
    // 1. Grafik Usia (Bar Chart)
    const ctxAge = document.getElementById('ageChart').getContext('2d');
    new Chart(ctxAge, {
      type: 'bar',
      data: {
        labels: ['Balita (0-5)', 'Anak (6-12)', 'Remaja (13-17)', 'Dewasa (18-59)', 'Lansia (60+)'],
        datasets: [{
          label: 'Laki-laki',
          data: [
            {{ ($data->kelompok_usia_0_5 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_6_11 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_12_17 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_18_25 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_61_keatas ?? 0) / 2 }}
          ],
          backgroundColor: '#3b82f6',
          borderRadius: 6,
          barPercentage: 0.7
        }, {
          label: 'Perempuan',
          data: [
            {{ ($data->kelompok_usia_0_5 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_6_11 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_12_17 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_18_25 ?? 0) / 2 }},
            {{ ($data->kelompok_usia_61_keatas ?? 0) / 2 }}
          ],
          backgroundColor: '#ec4899',
          borderRadius: 6,
          barPercentage: 0.7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: commonAnimation,
        plugins: {
          legend: {
            position: 'top',
            align: 'end',
            labels: {
              usePointStyle: true,
              pointStyle: 'circle'
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              borderDash: [5, 5],
              color: '#f1f5f9'
            },
            border: {
              display: false
            }
          },
          x: {
            grid: {
              display: false
            },
            border: {
              display: false
            }
          }
        }
      }
    });

    // 2. Grafik Pendidikan (Doughnut Chart)
    const ctxEdu = document.getElementById('educationChart').getContext('2d');
    new Chart(ctxEdu, {
      type: 'doughnut',
      data: {
        labels: ['SD', 'SMP', 'SMA/K', 'Diploma/Sarjana', 'Belum Sekolah'],
        datasets: [{
          data: [
            {{ $data->pendidikan_sd }},
            {{ $data->pendidikan_smp }},
            {{ $data->pendidikan_sma }},
            {{ $data->pendidikan_diploma }},
            {{ $data->pendidikan_belum }}
          ],
          backgroundColor: [
            '#10b981',
            '#3b82f6',
            '#f59e0b',
            '#8b5cf6',
            '#cbd5e1'
          ],
          borderWidth: 0,
          hoverOffset: 15
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '75%',
        animation: {
          animateScale: true,
          animateRotate: true,
          duration: 2000,
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              boxWidth: 12,
              usePointStyle: true,
              pointStyle: 'circle',
              padding: 20
            }
          }
        }
      }
    });

    // 3. Grafik Pekerjaan (Horizontal Bar)
    const ctxJob = document.getElementById('jobChart').getContext('2d');
    new Chart(ctxJob, {
      type: 'bar',
      data: {
        labels: ['Petani', 'Wiraswasta', 'Karyawan Swasta', 'PNS/TNI/Polri', 'Ibu Rumah Tangga', 'Belum Bekerja'],
        datasets: [{
          label: 'Jumlah Orang',
          data: [
            {{ $data->pekerjaan_petani }},
            {{ $data->pekerjaan_wiraswasta }},
            {{ $data->pekerjaan_karyawan }},
            {{ $data->pekerjaan_pns }},
            {{ $data->pekerjaan_ibu_rumah_tangga }},
            {{ $data->pekerjaan_belum }}
          ],
          backgroundColor: '#f59e0b',
          borderRadius: 6,
          barThickness: 24
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        animation: commonAnimation,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            grid: {
              borderDash: [5, 5],
              color: '#f1f5f9'
            },
            border: {
              display: false
            }
          },
          y: {
            grid: {
              display: false
            },
            border: {
              display: false
            }
          }
        }
      }
    });

    // 4. Grafik Agama (Pie Chart)
    const ctxRel = document.getElementById('religionChart').getContext('2d');
    new Chart(ctxRel, {
      type: 'pie',
      data: {
        labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'],
        datasets: [{
          data: [
            {{ $data->agama_islam }},
            {{ $data->agama_kristen }},
            {{ $data->agama_katolik }},
            {{ $data->agama_hindu }},
            {{ $data->agama_buddha }}
          ],
          backgroundColor: [
            '#10b981',
            '#3b82f6',
            '#f43f5e',
            '#f97316',
            '#eab308'
          ],
          borderWidth: 0,
          hoverOffset: 15
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          animateScale: true,
          animateRotate: true,
          duration: 2000,
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: {
            position: 'right',
            labels: {
              usePointStyle: true,
              pointStyle: 'circle'
            }
          }
        }
      }
    });
  });
</script>

@endsection
