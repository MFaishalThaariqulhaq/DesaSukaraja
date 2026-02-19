@extends('layouts.public.layout')

@section('title', 'Dashboard Pengaduan Publik')

@section('content')
<div class="pg-shell min-h-screen">
    <section class="pt-8 pb-6 border-b border-emerald-100/70">
        <div class="container mx-auto px-4 text-center" data-pg-reveal>
            <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-emerald-200 text-emerald-700 text-xs font-bold tracking-wider uppercase mb-3">
                <i data-lucide="layout-dashboard" class="ui-icon-sm"></i>
                Dashboard Publik
            </p>
            <h1 class="ui-heading text-4xl md:text-5xl font-bold text-slate-900 mb-2">Transparansi Pengaduan Masyarakat</h1>
            <p class="text-slate-600">Pantau statistik dan progres penanganan laporan Desa Sukaraja.</p>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8 space-y-6">
        <div data-pg-reveal>
            <h2 class="ui-heading text-2xl md:text-3xl font-bold text-slate-900 mb-1">Statistik Pengaduan</h2>
            <p class="text-slate-600">Ringkasan performa penanganan pengaduan terbaru.</p>
        </div>

        <div class="pg-panel p-5 md:p-6" data-pg-reveal>
            @php
                $total = max(1, (int) ($stats['total'] ?? 0));
                $statusMeta = [
                    'submitted' => ['label' => 'Baru Diterima', 'count' => (int) ($stats['submitted'] ?? 0), 'bar' => 'bg-blue-500', 'dot' => 'bg-blue-500'],
                    'pending' => ['label' => 'Dalam Antrian', 'count' => (int) ($stats['pending'] ?? 0), 'bar' => 'bg-yellow-500', 'dot' => 'bg-yellow-500'],
                    'in_progress' => ['label' => 'Diproses', 'count' => (int) ($stats['in_progress'] ?? 0), 'bar' => 'bg-orange-500', 'dot' => 'bg-orange-500'],
                    'resolved' => ['label' => 'Selesai', 'count' => (int) ($stats['resolved'] ?? 0), 'bar' => 'bg-green-500', 'dot' => 'bg-green-500'],
                    'rejected' => ['label' => 'Ditolak', 'count' => (int) ($stats['rejected'] ?? 0), 'bar' => 'bg-red-500', 'dot' => 'bg-red-500'],
                ];
            @endphp

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-4">
                <div>
                    <h3 class="ui-heading text-xl font-bold text-slate-900">Grafik Status Pengaduan</h3>
                    <p class="text-sm text-slate-600 mt-1">Komposisi status dari total {{ $stats['total'] }} laporan.</p>
                </div>
                <div class="grid grid-cols-3 gap-2 text-center md:w-[22rem]">
                    <div class="rounded-lg bg-emerald-50 px-3 py-2">
                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Total</p>
                        <p class="text-xl font-extrabold text-emerald-700">{{ $stats['total'] }}</p>
                    </div>
                    <div class="rounded-lg bg-orange-50 px-3 py-2">
                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Proses</p>
                        <p class="text-xl font-extrabold text-orange-600">{{ $stats['in_progress'] }}</p>
                    </div>
                    <div class="rounded-lg bg-green-50 px-3 py-2">
                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Selesai</p>
                        <p class="text-xl font-extrabold text-green-700">{{ $stats['resolved'] }}</p>
                    </div>
                </div>
            </div>

            <div class="w-full h-4 md:h-5 rounded-full bg-slate-100 overflow-hidden border border-slate-200 flex mb-4">
                @foreach($statusMeta as $item)
                    @php
                        $percent = $stats['total'] > 0 ? ($item['count'] / $total) * 100 : 0;
                    @endphp
                    <div class="{{ $item['bar'] }} h-full" style="width: {{ $percent }}%" title="{{ $item['label'] }}: {{ $item['count'] }}"></div>
                @endforeach
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-2.5">
                @foreach($statusMeta as $item)
                    @php
                        $percent = $stats['total'] > 0 ? ($item['count'] / $total) * 100 : 0;
                    @endphp
                    <div class="rounded-xl border border-slate-200 bg-white px-3 py-2.5">
                        <p class="text-[11px] uppercase tracking-wide text-slate-500 inline-flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full {{ $item['dot'] }}"></span>{{ $item['label'] }}
                        </p>
                        <p class="text-lg font-bold text-slate-900 mt-1">{{ $item['count'] }}</p>
                        <p class="text-xs text-slate-500">{{ number_format($percent, 1) }}%</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="pg-panel p-5 md:p-6" data-pg-reveal>
            @php
                $kategoriItems = collect($kategoriStats)->sortDesc();
                $totalKategori = max(1, (int) ($stats['total'] ?? 0));
            @endphp
            <div class="flex items-center justify-between gap-3 mb-4">
                <h3 class="ui-heading text-xl font-bold text-slate-900">Per Kategori</h3>
                <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                    {{ $kategoriItems->count() }} kategori
                </span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @forelse($kategoriItems as $kategoriName => $count)
                    @php
                        $percent = $stats['total'] > 0 ? ($count / $totalKategori) * 100 : 0;
                    @endphp
                    <div class="rounded-xl border border-slate-200 bg-white p-3">
                        <div class="flex items-center justify-between gap-3 mb-2">
                            <p class="text-sm font-semibold text-slate-800 truncate">{{ $kategoriName }}</p>
                            <p class="text-xs font-bold text-slate-900 bg-slate-100 px-2 py-1 rounded">{{ $count }}</p>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 overflow-hidden">
                            <div class="h-full rounded-full bg-emerald-600" style="width: {{ $percent }}%"></div>
                        </div>
                        <p class="text-xs text-slate-500 mt-1.5">{{ number_format($percent, 1) }}%</p>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">Belum ada kategori pengaduan.</p>
                @endforelse
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
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Kode Laporan</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Judul</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-700">Update Terakhir</th>
                            <th class="px-4 py-3 text-center font-semibold text-slate-700">Foto Progres</th>
                            <th class="px-4 py-3 text-center font-semibold text-slate-700">Status</th>
                            <th class="px-4 py-3 text-center font-semibold text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduans as $p)
                            <tr
                                class="pg-table-row border-b border-slate-200 cursor-pointer hover:bg-slate-50 transition-colors"
                                onclick="window.location='{{ route('pengaduan.public.show', $p->id) }}'"
                                tabindex="0"
                                role="link"
                                aria-label="Lihat detail publik pengaduan {{ $p->id }}"
                                onkeydown="if(event.key==='Enter'){window.location='{{ route('pengaduan.public.show', $p->id) }}';}"
                            >
                                <td class="px-4 py-3 text-slate-800 font-mono text-xs">{{ 'ADU-****-' . substr($p->tracking_number, -4) }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $p->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-slate-700">
                                    <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 text-xs font-semibold rounded-full">{{ $p->kategori ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-slate-800 font-semibold">{{ $p->judul ? Str::limit($p->judul, 44) : Str::limit($p->isi, 44) }}</span>
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
                                <td class="px-4 py-3 text-center">
                                    <a
                                        href="{{ route('pengaduan.public.show', $p->id) }}"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition"
                                        onclick="event.stopPropagation()">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-8 text-center text-slate-500">Tidak ada pengaduan ditemukan dengan filter yang Anda pilih.</td>
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
