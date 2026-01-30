@extends('public.layout')

@section('content')
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body { font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .glass-effect {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .gradient-card-1 { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    .gradient-card-2 { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
    .gradient-card-3 { background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); }
    .gradient-card-4 { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
    
    .bg-pattern {
        background-color: #f8fafc;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e2e8f0' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>

<!-- Header Section -->
<header class="relative bg-slate-900 text-white pb-24 pt-12 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-30">
        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2232&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-overlay" alt="Desa Background">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-900 z-0"></div>

    <div class="container mx-auto px-6 relative z-10" data-aos="fade-down">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div>
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 text-xs font-bold tracking-wider uppercase mb-3">Statistik Desa 2024</span>
                <h1 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight">Infografis <span class="text-emerald-400">Kependudukan</span></h1>
                <p class="text-slate-400 text-lg max-w-xl">Transparansi data demografi Desa Sukaraja untuk perencanaan pembangunan yang lebih baik.</p>
            </div>
            <div class="glass-effect !bg-slate-800/50 !border-slate-700 text-white px-5 py-3 rounded-xl flex items-center gap-3">
                <div class="bg-emerald-500/20 p-2 rounded-lg">
                    <i class="far fa-calendar-check text-emerald-400"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wide">Update Terakhir</p>
                    <p class="font-bold">{{ now()->format('F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- SVG Wave Separator -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
        <svg class="relative block w-[calc(100%+1.3px)] h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#f8fafc"></path>
        </svg>
    </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-6 -mt-10 relative z-20 pb-20 bg-pattern min-h-screen">
    
    @php
    $total_penduduk = collect($data)->sum(fn($d) => $d ? $d->total_penduduk : 0);
    $total_laki = collect($data)->sum(fn($d) => $d ? $d->laki_laki : 0);
    $total_perempuan = collect($data)->sum(fn($d) => $d ? $d->perempuan : 0);
    $total_kk = collect($data)->sum(fn($d) => $d ? $d->kepala_keluarga : 0);
    $persen_laki = $total_penduduk > 0 ? round($total_laki / $total_penduduk * 100, 2) : 0;
    $persen_perempuan = $total_penduduk > 0 ? round($total_perempuan / $total_penduduk * 100, 2) : 0;
    @endphp

    <!-- Data Per Dusun -->
    <div class="mb-12" data-aos="fade-up">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-slate-900">Data Kependudukan per Dusun</h3>
                <p class="text-slate-500">Sebaran penduduk di setiap wilayah administratif</p>
            </div>
            <div class="hidden md:block">
                <span class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium shadow-sm">
                    <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i> {{ $data->count() }} Dusun
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($data as $item)
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-lg transition duration-300">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-emerald-500 group-hover:w-2 transition-all"></div>
                <div class="flex justify-between items-start mb-4 pl-3">
                    <div>
                        <h4 class="font-bold text-lg text-slate-800">Dusun {{ $item->dusun }}</h4>
                    </div>
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-400 group-hover:text-emerald-500 transition">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                
                <div class="space-y-3 pl-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-500">Total Penduduk</span>
                        <span class="font-bold text-slate-800 text-lg">{{ number_format($item->total_penduduk) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-500">Kepala Keluarga</span>
                        <span class="font-bold text-slate-800">{{ $item->kepala_keluarga }} <span class="text-xs font-normal text-slate-400">KK</span></span>
                    </div>
                    
                    <div class="pt-3 mt-2 border-t border-slate-100 grid grid-cols-2 gap-3">
                        <div class="bg-blue-50 rounded-lg p-2 text-center">
                            <div class="text-xs text-blue-500 font-medium mb-1">Laki-laki</div>
                            <div class="font-bold text-blue-700">{{ number_format($item->laki_laki) }}</div>
                        </div>
                        <div class="bg-pink-50 rounded-lg p-2 text-center">
                            <div class="text-xs text-pink-500 font-medium mb-1">Perempuan</div>
                            <div class="font-bold text-pink-700">{{ number_format($item->perempuan) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Key Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Total Penduduk -->
        <div class="gradient-card-1 rounded-2xl p-6 shadow-xl text-white transform hover:-translate-y-2 transition duration-300 relative overflow-hidden group" data-aos="fade-up">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i class="fas fa-users text-8xl transform translate-x-4 -translate-y-4"></i>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <p class="text-emerald-100 text-sm font-medium">Total Penduduk</p>
                <h3 class="text-4xl font-bold mt-1">{{ number_format($total_penduduk) }}</h3>
            </div>
        </div>

        <!-- Kepala Keluarga -->
        <div class="gradient-card-2 rounded-2xl p-6 shadow-xl text-white transform hover:-translate-y-2 transition duration-300 relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i class="fas fa-home text-8xl transform translate-x-4 -translate-y-4"></i>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-home"></i>
                    </div>
                </div>
                <p class="text-blue-100 text-sm font-medium">Kepala Keluarga</p>
                <h3 class="text-4xl font-bold mt-1">{{ number_format($total_kk) }}</h3>
            </div>
        </div>

        <!-- Laki-laki -->
        <div class="gradient-card-3 rounded-2xl p-6 shadow-xl text-white transform hover:-translate-y-2 transition duration-300 relative overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i class="fas fa-male text-8xl transform translate-x-4 -translate-y-4"></i>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-mars"></i>
                    </div>
                    <span class="text-xs font-bold bg-white/20 px-2 py-1 rounded text-white">{{ $persen_laki }}%</span>
                </div>
                <p class="text-sky-100 text-sm font-medium">Laki-laki</p>
                <h3 class="text-4xl font-bold mt-1">{{ number_format($total_laki) }}</h3>
            </div>
        </div>

        <!-- Perempuan -->
        <div class="gradient-card-4 rounded-2xl p-6 shadow-xl text-white transform hover:-translate-y-2 transition duration-300 relative overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i class="fas fa-female text-8xl transform translate-x-4 -translate-y-4"></i>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-venus"></i>
                    </div>
                    <span class="text-xs font-bold bg-white/20 px-2 py-1 rounded text-white">{{ $persen_perempuan }}%</span>
                </div>
                <p class="text-pink-100 text-sm font-medium">Perempuan</p>
                <h3 class="text-4xl font-bold mt-1">{{ number_format($total_perempuan) }}</h3>
            </div>
        </div>
    </div>

    <!-- Mutasi Penduduk Section -->
    <div class="bg-slate-900 rounded-3xl shadow-2xl overflow-hidden mb-12" data-aos="fade-up">
        <div class="p-8 md:p-12 text-center md:text-left relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 relative z-10">
                <div>
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">Laporan Mutasi Penduduk</h3>
                    <p class="text-slate-400">Pergerakan penduduk periode bulan berjalan.</p>
                </div>
                <span class="mt-4 md:mt-0 bg-emerald-500 text-white px-4 py-1.5 rounded-full text-sm font-semibold shadow-lg shadow-emerald-500/30">Periode: {{ now()->format('F Y') }}</span>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 relative z-10">
                <!-- Lahir -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-slate-800 transition">
                    <div class="w-12 h-12 bg-emerald-500/20 text-emerald-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                        <i class="fas fa-baby"></i>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">{{ collect($data)->sum(fn($d) => $d->lahir ?? 0) }}</div>
                    <div class="text-sm text-slate-400 font-medium">Kelahiran</div>
                </div>
                
                <!-- Meninggal -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-slate-800 transition">
                    <div class="w-12 h-12 bg-rose-500/20 text-rose-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                        <i class="fas fa-ribbon"></i>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">{{ collect($data)->sum(fn($d) => $d->mati ?? 0) }}</div>
                    <div class="text-sm text-slate-400 font-medium">Meninggal</div>
                </div>
                
                <!-- Masuk -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-slate-800 transition">
                    <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">{{ collect($data)->sum(fn($d) => $d->datang ?? 0) }}</div>
                    <div class="text-sm text-slate-400 font-medium">Pindah Masuk</div>
                </div>
                
                <!-- Keluar -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center hover:bg-slate-800 transition">
                    <div class="w-12 h-12 bg-orange-500/20 text-orange-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                        <i class="fas fa-suitcase"></i>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">{{ collect($data)->sum(fn($d) => $d->pindah ?? 0) }}</div>
                    <div class="text-sm text-slate-400 font-medium">Pindah Keluar</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-slate-500 text-sm">
        <p>&copy; {{ now()->year }} Pemerintah Desa Sukaraja. Data bersumber dari Sistem Informasi Desa (SID).</p>
    </footer>

</div>

<!-- AOS Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-out-cubic'
    });
</script>
@endsection