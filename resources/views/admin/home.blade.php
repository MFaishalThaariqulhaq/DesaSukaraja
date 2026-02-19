@extends('admin.dashboard')

@section('content')
<div class="space-y-6 admin-home">
  <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-3 reveal-item" style="--delay: 0ms;">
    <div>
      <h2 class="text-2xl font-bold text-slate-800">Dashboard Admin</h2>
      <p class="text-sm text-slate-500 mt-1">Ringkasan kondisi konten dan pengaduan desa.</p>
    </div>
    <div class="text-sm text-slate-500">
      Update: {{ now()->translatedFormat('d F Y, H:i') }}
    </div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm stat-card reveal-item" style="--delay: 80ms;">
      <p class="text-xs uppercase tracking-wide text-slate-500">Total Berita</p>
      <p class="mt-2 text-3xl font-bold text-slate-800">{{ $stats['berita_total'] }}</p>
      <a href="{{ route('admin.berita.index') }}" class="text-xs text-emerald-600 hover:text-emerald-700">Kelola berita</a>
    </div>
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm stat-card reveal-item" style="--delay: 140ms;">
      <p class="text-xs uppercase tracking-wide text-slate-500">Total Galeri</p>
      <p class="mt-2 text-3xl font-bold text-slate-800">{{ $stats['galeri_total'] }}</p>
      <a href="{{ route('admin.galeri.index') }}" class="text-xs text-emerald-600 hover:text-emerald-700">Kelola galeri</a>
    </div>
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm stat-card reveal-item" style="--delay: 200ms;">
      <p class="text-xs uppercase tracking-wide text-slate-500">Total Perangkat SOTK</p>
      <p class="mt-2 text-3xl font-bold text-slate-800">{{ $stats['sotk_total'] }}</p>
      <a href="{{ route('admin.sotk.index') }}" class="text-xs text-emerald-600 hover:text-emerald-700">Kelola SOTK</a>
    </div>
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm stat-card reveal-item" style="--delay: 260ms;">
      <p class="text-xs uppercase tracking-wide text-slate-500">Total Pengaduan</p>
      <p class="mt-2 text-3xl font-bold text-slate-800">{{ $stats['pengaduan_total'] }}</p>
      <a href="{{ route('admin.pengaduan.index') }}" class="text-xs text-emerald-600 hover:text-emerald-700">Kelola pengaduan</a>
    </div>
  </div>

  <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm xl:col-span-1 reveal-item" style="--delay: 320ms;">
      <h3 class="font-semibold text-slate-800">Pengaduan per Kategori</h3>
      <p class="text-xs text-slate-500 mb-3">Distribusi kategori aduan warga.</p>
      <div class="max-w-sm">
        <canvas id="categoryChart" height="170"></canvas>
      </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm xl:col-span-2 reveal-item" style="--delay: 380ms;">
      <h3 class="font-semibold text-slate-800 mb-3">Status Pengaduan</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="flex items-center justify-between text-sm p-3 rounded-lg bg-blue-50 border border-blue-100">
          <span class="text-blue-700">Baru</span>
          <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 font-semibold">{{ $stats['pengaduan_submitted'] }}</span>
        </div>
        <div class="flex items-center justify-between text-sm p-3 rounded-lg bg-orange-50 border border-orange-100">
          <span class="text-orange-700">Diproses</span>
          <span class="px-2 py-0.5 rounded-full bg-orange-100 text-orange-700 font-semibold">{{ $stats['pengaduan_in_progress'] }}</span>
        </div>
        <div class="flex items-center justify-between text-sm p-3 rounded-lg bg-emerald-50 border border-emerald-100">
          <span class="text-emerald-700">Selesai</span>
          <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 font-semibold">{{ $stats['pengaduan_resolved'] }}</span>
        </div>
        <div class="flex items-center justify-between text-sm p-3 rounded-lg bg-red-50 border border-red-100">
          <span class="text-red-700">Ditolak</span>
          <span class="px-2 py-0.5 rounded-full bg-red-100 text-red-700 font-semibold">{{ $stats['pengaduan_rejected'] }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm reveal-item" style="--delay: 440ms;">
      <h3 class="font-semibold text-slate-800 mb-3">Berita Terbaru</h3>
      <div class="space-y-3">
        @forelse($recentBeritas as $item)
        <a href="{{ route('admin.berita.edit', $item->id) }}" class="block border border-slate-100 rounded-lg p-3 hover:bg-slate-50 transition">
          <p class="text-sm font-medium text-slate-800 line-clamp-1">{{ $item->judul }}</p>
          <p class="text-xs text-slate-500 mt-1">{{ $item->created_at->format('d M Y H:i') }}</p>
        </a>
        @empty
        <p class="text-sm text-slate-500">Belum ada berita.</p>
        @endforelse
      </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm reveal-item" style="--delay: 500ms;">
      <h3 class="font-semibold text-slate-800 mb-3">Pengaduan Terbaru</h3>
      <div class="space-y-3">
        @forelse($recentPengaduans as $item)
        <a href="{{ route('admin.pengaduan.show', $item->id) }}" class="block border border-slate-100 rounded-lg p-3 hover:bg-slate-50 transition">
          <div class="flex items-start justify-between gap-2">
            <p class="text-sm font-medium text-slate-800 line-clamp-1">{{ $item->judul ?: 'Tanpa Judul' }}</p>
            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">{{ $item->status }}</span>
          </div>
          <p class="text-xs text-slate-500 mt-1">{{ $item->nama ?: 'Anonim' }} • {{ $item->created_at->format('d M Y H:i') }}</p>
        </a>
        @empty
        <p class="text-sm text-slate-500">Belum ada pengaduan.</p>
        @endforelse
      </div>
    </div>
  </div>

  <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm reveal-item" style="--delay: 560ms;">
    <h3 class="font-semibold text-slate-800 mb-3">Galeri Terbaru</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-3">
      @forelse($recentGaleris as $item)
      <a href="{{ route('admin.galeri.edit', $item->id) }}" class="border border-slate-100 rounded-lg p-3 hover:bg-slate-50 transition">
        <p class="text-sm font-medium text-slate-800 line-clamp-1">{{ $item->judul }}</p>
        <p class="text-xs text-slate-500 mt-1">{{ $item->created_at->format('d M Y') }}</p>
      </a>
      @empty
      <p class="text-sm text-slate-500 col-span-full">Belum ada data galeri.</p>
      @endforelse
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  .admin-home .reveal-item {
    opacity: 0;
    transform: translateY(10px) scale(0.995);
    animation: adminHomeReveal 560ms cubic-bezier(.2, .9, .2, 1) forwards;
    animation-delay: var(--delay, 0ms);
  }

  .admin-home .stat-card,
  .admin-home .reveal-item {
    transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
  }

  .admin-home .stat-card:hover,
  .admin-home .reveal-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    border-color: #cbd5e1;
  }

  @keyframes adminHomeReveal {
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .admin-home .reveal-item {
      animation: none !important;
      opacity: 1 !important;
      transform: none !important;
    }

    .admin-home .stat-card,
    .admin-home .reveal-item {
      transition: none !important;
    }
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (!window.Chart) return;

    const chartData = @json($chartData);

    const categoryCtx = document.getElementById('categoryChart');
    if (categoryCtx) {
      new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
          labels: chartData.category_labels,
          datasets: [{
            data: chartData.category_counts,
            backgroundColor: ['#059669', '#0ea5e9', '#f59e0b', '#ef4444', '#6366f1', '#14b8a6', '#64748b']
          }]
        },
        options: {
          responsive: true,
          animation: {
            duration: 800,
            easing: 'easeOutQuart'
          },
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }
      });
    }
  });
</script>
@endpush
