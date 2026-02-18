@extends('layouts.public.layout')

@section('title', 'Dashboard Pengaduan Publik')

@section('content')
<div class="pg-shell min-h-screen">
    <section class="pt-12 pb-10 border-b border-emerald-100/70">
        <div class="container mx-auto px-4 text-center" data-pg-reveal>
            <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-emerald-200 text-emerald-700 text-xs font-bold tracking-wider uppercase mb-4">
                <i data-lucide="layout-dashboard" class="ui-icon-sm"></i>
                Dashboard Publik
            </p>
            <h1 class="ui-heading text-4xl md:text-5xl font-bold text-slate-900 mb-2">Transparansi Pengaduan Masyarakat</h1>
            <p class="text-slate-600">Pantau statistik dan progres penanganan laporan Desa Sukaraja.</p>
        </div>
    </section>

    <div class="container mx-auto px-4 py-12 space-y-8">
        <div data-pg-reveal>
            <h2 class="ui-heading text-3xl font-bold text-slate-900 mb-2">Statistik Pengaduan</h2>
            <p class="text-slate-600">Ringkasan performa penanganan pengaduan terbaru.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5" data-pg-reveal>
            <div class="pg-card p-6 bg-emerald-50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-semibold mb-1">Total Pengaduan</p>
                        <p class="text-4xl font-extrabold text-emerald-700">{{ $stats['total'] }}</p>
                    </div>
                    <i data-lucide="clipboard-list" class="w-10 h-10 text-emerald-400"></i>
                </div>
            </div>
            <div class="pg-card p-6 bg-orange-50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-semibold mb-1">Sedang Ditangani</p>
                        <p class="text-4xl font-extrabold text-orange-600">{{ $stats['in_progress'] }}</p>
                    </div>
                    <i data-lucide="settings" class="w-10 h-10 text-orange-400"></i>
                </div>
            </div>
            <div class="pg-card p-6 bg-green-50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-semibold mb-1">Sudah Ditangani</p>
                        <p class="text-4xl font-extrabold text-green-700">{{ $stats['resolved'] }}</p>
                    </div>
                    <i data-lucide="check-circle-2" class="w-10 h-10 text-green-400"></i>
                </div>
            </div>
        </div>

        <div class="pg-panel p-6" data-pg-reveal>
            <h3 class="ui-heading text-2xl font-bold text-slate-900 mb-4">Breakdown Status</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                <div class="pg-card border-l-4 border-blue-500 p-4">
                    <p class="text-3xl font-extrabold text-blue-600">{{ $stats['submitted'] }}</p>
                    <p class="text-sm text-slate-700 font-medium mt-1">Baru Diterima</p>
                </div>
                <div class="pg-card border-l-4 border-yellow-500 p-4">
                    <p class="text-3xl font-extrabold text-yellow-600">{{ $stats['pending'] }}</p>
                    <p class="text-sm text-slate-700 font-medium mt-1">Dalam Antrian</p>
                </div>
                <div class="pg-card border-l-4 border-orange-500 p-4">
                    <p class="text-3xl font-extrabold text-orange-600">{{ $stats['in_progress'] }}</p>
                    <p class="text-sm text-slate-700 font-medium mt-1">Sedang Diproses</p>
                </div>
                <div class="pg-card border-l-4 border-green-500 p-4">
                    <p class="text-3xl font-extrabold text-green-600">{{ $stats['resolved'] }}</p>
                    <p class="text-sm text-slate-700 font-medium mt-1">Selesai</p>
                </div>
                <div class="pg-card border-l-4 border-red-500 p-4">
                    <p class="text-3xl font-extrabold text-red-600">{{ $stats['rejected'] }}</p>
                    <p class="text-sm text-slate-700 font-medium mt-1">Ditolak</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" data-pg-reveal>
            <div class="pg-panel p-6">
                <h3 class="ui-heading text-2xl font-bold text-slate-900 mb-4">Per Kategori</h3>
                <div class="space-y-4">
                    @forelse($kategoriStats as $kategoriName => $count)
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-semibold text-slate-700">{{ $kategoriName }}</span>
                                <span class="text-xs font-bold text-slate-900 bg-slate-100 px-2 py-1 rounded">{{ $count }}</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2.5">
                                <div class="bg-emerald-600 h-2.5 rounded-full" style="width: {{ ($count / max(1, $stats['total'])) * 100 }}%"></div>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">{{ round(($count / max(1, $stats['total'])) * 100, 1) }}%</p>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm">Belum ada kategori pengaduan.</p>
                    @endforelse
                </div>
            </div>

            <div class="pg-panel p-6 lg:col-span-2">
                <h3 class="ui-heading text-2xl font-bold text-slate-900 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('pengaduan.index') }}" class="pg-card pg-link flex items-center gap-3 p-4 bg-emerald-50 border-emerald-200" aria-label="Buat pengaduan baru">
                        <i data-lucide="square-pen" class="w-8 h-8 text-emerald-700"></i>
                        <div>
                            <p class="font-bold text-emerald-900">Buat Pengaduan Baru</p>
                            <p class="text-xs text-emerald-700">Sampaikan keluhan atau saran Anda</p>
                        </div>
                    </a>
                    <a href="{{ route('pengaduan.status') }}" class="pg-card pg-link flex items-center gap-3 p-4 bg-blue-50 border-blue-200" aria-label="Cek status pengaduan">
                        <i data-lucide="search" class="w-8 h-8 text-blue-700"></i>
                        <div>
                            <p class="font-bold text-blue-900">Cek Status Pengaduan</p>
                            <p class="text-xs text-blue-700">Masukkan nomor tracking Anda</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div id="daftar-pengaduan" class="pg-panel p-6" data-pg-reveal>
            <div class="mb-6 pg-sticky-filter bg-white">
                <h3 class="ui-heading text-2xl font-bold text-slate-900 mb-4">Daftar Pengaduan Terbaru</h3>
                <form method="GET" action="{{ route('pengaduan.list') }}#daftar-pengaduan" class="grid grid-cols-1 md:grid-cols-4 gap-3" aria-label="Filter daftar pengaduan">
                    <select name="kategori" class="pg-input w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-700" aria-label="Filter kategori">
                        <option value="">Semua Kategori</option>
                        @foreach($allKategori as $kat)
                            <option value="{{ $kat }}" {{ $kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="pg-input w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-700" aria-label="Filter status">
                        <option value="">Semua Status</option>
                        <option value="submitted" {{ $status == 'submitted' ? 'selected' : '' }}>Baru Diterima</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Dalam Antrian</option>
                        <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                        <option value="resolved" {{ $status == 'resolved' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <select name="per_page" class="pg-input w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-700" aria-label="Jumlah data per halaman">
                        <option value="5" {{ (int)($perPage ?? 10) === 5 ? 'selected' : '' }}>5 per halaman</option>
                        <option value="10" {{ (int)($perPage ?? 10) === 10 ? 'selected' : '' }}>10 per halaman</option>
                        <option value="15" {{ (int)($perPage ?? 10) === 15 ? 'selected' : '' }}>15 per halaman</option>
                        <option value="20" {{ (int)($perPage ?? 10) === 20 ? 'selected' : '' }}>20 per halaman</option>
                        <option value="50" {{ (int)($perPage ?? 10) === 50 ? 'selected' : '' }}>50 per halaman</option>
                    </select>
                    <button type="submit" class="pg-button px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold" aria-label="Terapkan filter">
                        Filter
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">No. Tracking</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Judul</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Update Terakhir</th>
                            <th class="px-4 py-3 text-center font-semibold text-slate-700">Foto Progres</th>
                            <th class="px-4 py-3 text-center font-semibold text-slate-700">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduans as $p)
                            <tr
                                class="pg-table-row border-b border-slate-200 cursor-pointer"
                                onclick="window.location='{{ route('pengaduan.status', ['tracking' => $p->tracking_number]) }}'"
                                tabindex="0"
                                role="link"
                                aria-label="Lihat detail pengaduan {{ $p->tracking_number }}"
                                onkeydown="if(event.key==='Enter'){window.location='{{ route('pengaduan.status', ['tracking' => $p->tracking_number]) }}';}"
                            >
                                <td class="px-4 py-3 text-slate-800 font-mono text-xs">{{ Str::limit($p->tracking_number, 18, '...') }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $p->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-slate-700">
                                    <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 text-xs font-semibold rounded-full">{{ $p->kategori ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-emerald-700 hover:text-emerald-800 font-semibold">{{ $p->judul ? Str::limit($p->judul, 44) : Str::limit($p->isi, 44) }}</span>
                                </td>
                                <td class="px-4 py-3 text-slate-600 whitespace-nowrap">
                                    @if($p->last_public_progress_at)
                                        {{ \Illuminate\Support\Carbon::parse($p->last_public_progress_at)->format('d M Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ (int) ($p->public_progress_count ?? 0) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="pg-status-badge pg-status-{{ $p->status }}">{{ ucfirst(str_replace('_', ' ', $p->status)) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-slate-500">Tidak ada pengaduan ditemukan dengan filter yang Anda pilih.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <p class="text-sm text-slate-500">
                    Menampilkan {{ $pengaduans->firstItem() ?? 0 }}-{{ $pengaduans->lastItem() ?? 0 }} dari {{ $pengaduans->total() }} pengaduan
                </p>
                @if($pengaduans->hasPages())
                    <nav class="flex items-center justify-center md:justify-end gap-1.5" aria-label="Navigasi halaman pengaduan">
                        @if($pengaduans->onFirstPage())
                            <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 text-sm">Prev</span>
                        @else
                            <a href="{{ $pengaduans->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 text-sm">Prev</a>
                        @endif

                        @for($page = 1; $page <= $pengaduans->lastPage(); $page++)
                            @if($page == 1 || $page == $pengaduans->lastPage() || abs($page - $pengaduans->currentPage()) <= 1)
                                @if($page == $pengaduans->currentPage())
                                    <span class="min-w-[2rem] px-2.5 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-semibold text-center">{{ $page }}</span>
                                @else
                                    <a href="{{ $pengaduans->url($page) }}" class="min-w-[2rem] px-2.5 py-1.5 rounded-lg border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 text-sm text-center">{{ $page }}</a>
                                @endif
                            @elseif($page == 2 && $pengaduans->currentPage() > 3)
                                <span class="px-1 text-slate-400">...</span>
                            @elseif($page == $pengaduans->lastPage() - 1 && $pengaduans->currentPage() < $pengaduans->lastPage() - 2)
                                <span class="px-1 text-slate-400">...</span>
                            @endif
                        @endfor

                        @if($pengaduans->hasMorePages())
                            <a href="{{ $pengaduans->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 text-sm">Next</a>
                        @else
                            <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-100 text-slate-400 text-sm">Next</span>
                        @endif
                    </nav>
                @endif
            </div>
        </div>

        <div class="pg-card bg-blue-50 border-blue-200 rounded-2xl p-6" data-pg-reveal>
            <p class="text-blue-900">
                <strong>Catatan:</strong> Dashboard ini menampilkan informasi publik untuk transparansi.
                Untuk melihat detail lengkap dan catatan penanganan pengaduan Anda, gunakan nomor tracking yang dikirim via email pada halaman
                <a href="{{ route('pengaduan.status') }}" class="pg-link font-bold text-blue-700 hover:underline">Cek Status</a>.
            </p>
        </div>
    </div>
</div>
@endsection
