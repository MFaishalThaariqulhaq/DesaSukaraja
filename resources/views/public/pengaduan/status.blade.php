@extends('layouts.public.layout')

@section('title', 'Cek Status Pengaduan')

@section('content')
<div class="pg-shell min-h-screen py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="text-center" data-pg-reveal>
                <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold tracking-wider uppercase mb-4">
                    <i data-lucide="shield-check" class="ui-icon-sm"></i>
                    Status Pengaduan
                </p>
                <h1 class="ui-heading text-4xl md:text-5xl font-bold text-slate-900 mb-2">Cek Progress Laporan Anda</h1>
                <p class="text-slate-600">Gunakan nomor tracking untuk melihat update penanganan secara realtime.</p>
            </div>

            <div class="pg-panel p-6 md:p-8" data-pg-reveal>
                <form method="GET" action="{{ route('pengaduan.status') }}" class="flex flex-col md:flex-row gap-3">
                    <input
                        type="text"
                        name="tracking"
                        placeholder="Contoh: ADU-20260131120530-1234"
                        class="pg-input flex-1 px-4 py-3 border border-slate-300 rounded-xl text-slate-800"
                        value="{{ old('tracking', $tracking) }}"
                        aria-label="Masukkan nomor tracking"
                        required
                    >
                    <button
                        type="submit"
                        class="pg-button px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition-colors"
                        aria-label="Cari status pengaduan"
                    >
                        Cari Status
                    </button>
                </form>
                <p class="mt-3 text-sm text-slate-500 inline-flex items-center gap-2">
                    <i data-lucide="info" class="ui-icon-sm text-emerald-600"></i>
                    Nomor tracking dikirim via email setelah Anda mengirim pengaduan.
                </p>
            </div>

            @if($notFound && $tracking)
                <div class="pg-panel border border-red-200 bg-red-50 p-6 text-center" data-pg-reveal>
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-red-100 text-red-600 mb-3">
                        <i data-lucide="x-circle" class="w-7 h-7"></i>
                    </div>
                    <h3 class="ui-heading text-2xl font-bold text-red-900 mb-2">Pengaduan Tidak Ditemukan</h3>
                    <p class="text-red-800">Nomor tracking <strong>{{ $tracking }}</strong> tidak ditemukan dalam sistem.</p>
                    <p class="text-red-700 text-sm mt-2">Periksa kembali nomor tracking Anda atau hubungi kantor desa.</p>
                </div>
            @elseif($pengaduan)
                @php
                    $statusText = ucfirst(str_replace('_', ' ', $pengaduan->status));
                    $isInProgress = $pengaduan->status === 'in_progress';
                    $endDate = ($pengaduan->status == 'resolved') ? $pengaduan->updated_at : now();
                    $days = $pengaduan->created_at->diffInDays($endDate);
                    $hours = $pengaduan->created_at->diffInHours($endDate) % 24;
                    $statusDurationText = ($pengaduan->status == 'resolved') ? '' : ' (ongoing)';
                @endphp
                <div class="pg-panel overflow-hidden" data-pg-reveal>
                    <div class="bg-gradient-to-r from-emerald-100 via-teal-50 to-blue-50 p-6 border-b border-slate-200">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                            <div>
                                <p class="text-slate-700 text-xs font-semibold uppercase tracking-wider mb-1">Nomor Tracking</p>
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">{{ $pengaduan->tracking_number }}</h2>
                            </div>
                            <span class="pg-status-badge pg-status-{{ $pengaduan->status }}" data-live="{{ $isInProgress ? '1' : '0' }}">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 md:p-8">
                        <div class="grid md:grid-cols-2 gap-4 mb-8 pb-8 border-b border-slate-200">
                            <div class="pg-card p-4">
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold mb-1">Nama</p>
                                <p class="font-semibold text-slate-900">{{ $pengaduan->nama ?? 'Anonim' }}</p>
                            </div>
                            <div class="pg-card p-4">
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold mb-1">Kategori</p>
                                <p class="font-semibold text-slate-900">{{ $pengaduan->kategori ?? '-' }}</p>
                            </div>
                            <div class="pg-card p-4">
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold mb-1">Tanggal Pengaduan</p>
                                <p class="font-semibold text-slate-900">{{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="pg-card p-4">
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold mb-1">Durasi Penanganan</p>
                                <p class="font-semibold text-slate-900">
                                    @if($days > 0)
                                        {{ $days }} hari, {{ $hours }} jam{{ $statusDurationText }}
                                    @else
                                        {{ $hours }} jam{{ $statusDurationText }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if($pengaduan->judul)
                            <div class="mb-8 pb-8 border-b border-slate-200" data-pg-reveal>
                                <p class="inline-flex items-center gap-2 text-slate-600 text-sm font-semibold mb-2">
                                    <i data-lucide="file-text" class="ui-icon-sm"></i>
                                    Judul Singkat
                                </p>
                                <p class="text-slate-800">{{ $pengaduan->judul }}</p>
                            </div>
                        @endif

                        <div class="mb-8 pb-8 border-b border-slate-200" data-pg-timeline>
                            <p class="inline-flex items-center gap-2 text-slate-700 text-sm font-semibold mb-5 uppercase tracking-wider">
                                <i data-lucide="map-pin" class="ui-icon-sm text-emerald-600"></i>
                                Timeline Status
                            </p>

                            @php
                                $steps = [
                                    [
                                        'label' => 'Pengaduan Diterima',
                                        'done' => true,
                                        'active' => false,
                                        'time' => $pengaduan->created_at->format('d M Y, H:i'),
                                        'badge' => 'Selesai',
                                        'badgeClass' => 'pg-status-submitted',
                                    ],
                                    [
                                        'label' => 'Dalam Antrian Proses',
                                        'done' => in_array($pengaduan->status, ['pending', 'in_progress', 'resolved', 'rejected']),
                                        'active' => $pengaduan->status === 'pending',
                                        'time' => in_array($pengaduan->status, ['pending', 'in_progress', 'resolved', 'rejected']) ? $pengaduan->updated_at->format('d M Y, H:i') : 'Sedang menunggu untuk diproses',
                                        'badge' => in_array($pengaduan->status, ['pending', 'in_progress', 'resolved', 'rejected']) ? 'Selesai' : 'Menunggu',
                                        'badgeClass' => in_array($pengaduan->status, ['pending', 'in_progress', 'resolved', 'rejected']) ? 'pg-status-pending' : 'bg-slate-100 text-slate-600',
                                    ],
                                    [
                                        'label' => 'Sedang Ditangani',
                                        'done' => in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']),
                                        'active' => $pengaduan->status === 'in_progress',
                                        'time' => in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']) ? $pengaduan->updated_at->format('d M Y, H:i') : 'Menunggu untuk diproses',
                                        'badge' => in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']) ? 'Selesai' : 'Menunggu',
                                        'badgeClass' => in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']) ? 'pg-status-in_progress' : 'bg-slate-100 text-slate-600',
                                    ],
                                    [
                                        'label' => $pengaduan->status == 'resolved' ? 'Selesai Ditangani' : ($pengaduan->status == 'rejected' ? 'Ditolak' : 'Penyelesaian'),
                                        'done' => in_array($pengaduan->status, ['resolved', 'rejected']),
                                        'active' => false,
                                        'time' => in_array($pengaduan->status, ['resolved', 'rejected']) ? $pengaduan->updated_at->format('d M Y, H:i') : 'Menunggu untuk diselesaikan',
                                        'badge' => $pengaduan->status == 'resolved' ? 'Selesai' : ($pengaduan->status == 'rejected' ? 'Ditolak' : 'Menunggu'),
                                        'badgeClass' => $pengaduan->status == 'resolved' ? 'pg-status-resolved' : ($pengaduan->status == 'rejected' ? 'pg-status-rejected' : 'bg-slate-100 text-slate-600'),
                                    ],
                                ];
                            @endphp

                            <div class="pg-timeline space-y-1">
                                @foreach($steps as $step)
                                    <div class="pg-timeline-item" data-pg-step>
                                        <span class="pg-timeline-dot {{ $step['done'] ? 'is-done' : '' }} {{ $step['active'] ? 'is-active' : '' }}"></span>
                                        <div class="pb-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <p class="font-semibold text-slate-900">{{ $step['label'] }}</p>
                                                <span class="pg-status-badge {{ $step['badgeClass'] }}">{{ $step['badge'] }}</span>
                                            </div>
                                            <p class="text-sm text-slate-600">{{ $step['time'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pg-card bg-blue-50 border-blue-200 p-5" data-pg-reveal>
                            <p class="inline-flex items-center gap-2 text-blue-900 font-semibold mb-2">
                                <i data-lucide="file-text" class="ui-icon-md"></i>
                                Catatan Penanganan
                            </p>
                            <p class="text-sm text-blue-700 mb-2">Catatan ini ditampilkan kepada masyarakat di halaman status tracking.</p>
                            @if($pengaduan->admin_notes)
                                <p class="text-blue-800">{{ $pengaduan->admin_notes }}</p>
                            @else
                                <p class="text-blue-700 italic">Belum ada catatan dari penangani.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-center" data-pg-reveal>
                    <a href="{{ route('pengaduan.index') }}" class="pg-link text-emerald-700 hover:text-emerald-800 font-semibold">Buat Pengaduan Baru</a>
                    <span class="text-slate-400 mx-2">|</span>
                    <a href="{{ route('pengaduan.list') }}" class="pg-link text-emerald-700 hover:text-emerald-800 font-semibold">Lihat Semua Pengaduan</a>
                </div>
            @else
                <div class="pg-panel p-10 text-center" data-pg-reveal>
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-slate-100 text-slate-700 mb-4">
                        <i data-lucide="search" class="w-7 h-7"></i>
                    </div>
                    <p class="text-slate-700 text-lg">Masukkan nomor tracking untuk melihat status pengaduan Anda.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
