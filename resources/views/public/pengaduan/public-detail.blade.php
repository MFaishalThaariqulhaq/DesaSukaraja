@extends('layouts.public.layout')

@section('title', 'Detail Pengaduan Publik')

@section('content')
<div class="pg-shell min-h-screen py-10">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto space-y-6">
            <div class="flex items-center justify-between gap-3 flex-wrap" data-pg-reveal>
                <a href="{{ route('pengaduan.list') }}#daftar-pengaduan" class="pg-link inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 font-semibold">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Transparansi
                </a>
                <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                    Detail Publik
                </span>
            </div>

            <div class="pg-panel overflow-hidden" data-pg-reveal>
                <div class="bg-slate-50 p-6 border-b border-slate-200">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div>
                            <p class="text-slate-700 text-xs font-semibold uppercase tracking-wider mb-1">Kode Laporan</p>
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">{{ 'ADU-****-' . substr($pengaduan->tracking_number, -4) }}</h1>
                        </div>
                        <span class="pg-status-badge pg-status-{{ $pengaduan->status }}">
                            {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
                        </span>
                    </div>
                </div>

                <div class="p-6 md:p-8 space-y-7">
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="pg-card p-4">
                            <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold mb-1">Kategori</p>
                            <p class="font-semibold text-slate-900">{{ $pengaduan->kategori ?? '-' }}</p>
                        </div>
                        <div class="pg-card p-4">
                            <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold mb-1">Tanggal Laporan</p>
                            <p class="font-semibold text-slate-900">{{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="pg-card p-4">
                            <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold mb-1">Update Terakhir</p>
                            <p class="font-semibold text-slate-900">{{ $pengaduan->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="inline-flex items-center gap-2 text-slate-700 text-sm font-semibold mb-2 uppercase tracking-wider">
                            <i data-lucide="file-text" class="ui-icon-sm"></i>
                            Ringkasan Laporan
                        </p>
                        <div class="pg-card p-4">
                            <p class="font-semibold text-slate-900 mb-2">{{ $pengaduan->judul ?: 'Tanpa Judul' }}</p>
                            <p class="text-slate-700">{{ \Illuminate\Support\Str::limit(strip_tags($pengaduan->isi), 280) }}</p>
                        </div>
                    </div>

                    @if($pengaduan->file_path)
                        @php
                            $ext = strtolower(pathinfo($pengaduan->file_path, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                            $isVideo = in_array($ext, ['mp4', 'webm', 'ogg']);
                            $isPdf = $ext === 'pdf';
                            $fileUrl = asset('storage/' . $pengaduan->file_path);
                        @endphp
                        <div>
                            <p class="inline-flex items-center gap-2 text-slate-700 text-sm font-semibold mb-2 uppercase tracking-wider">
                                <i data-lucide="paperclip" class="ui-icon-sm"></i>
                                Bukti Awal dari Pelapor
                            </p>
                            <div class="pg-card p-4 space-y-3">
                                @if($isImage)
                                    <a href="{{ $fileUrl }}" target="_blank" class="block">
                                        <img src="{{ $fileUrl }}" alt="Lampiran awal pengaduan" class="w-full max-h-[28rem] object-cover rounded-lg border border-slate-200">
                                    </a>
                                @elseif($isVideo)
                                    <video controls class="w-full rounded-lg border border-slate-200">
                                        <source src="{{ $fileUrl }}" type="video/{{ $ext }}">
                                        Browser Anda tidak mendukung pemutaran video.
                                    </video>
                                @elseif($isPdf)
                                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700">
                                        Lampiran berupa dokumen PDF.
                                    </div>
                                @else
                                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700">
                                        Lampiran tersedia dalam format file yang tidak dapat dipratinjau.
                                    </div>
                                @endif

                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ $fileUrl }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                        Buka File
                                    </a>
                                    <a href="{{ $fileUrl }}" download class="inline-flex items-center gap-2 rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700 hover:bg-emerald-100 transition">
                                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <p class="inline-flex items-center gap-2 text-slate-700 text-sm font-semibold mb-4 uppercase tracking-wider">
                            <i data-lucide="map-pin" class="ui-icon-sm text-emerald-600"></i>
                            Timeline Publik
                        </p>

                        <div class="space-y-3">
                            <div class="pg-card p-4">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="pg-status-badge pg-status-submitted">Diterima</span>
                                    <span class="text-xs text-slate-500">{{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <p class="text-sm text-slate-700">Laporan diterima oleh sistem.</p>
                            </div>

                            @forelse($pengaduan->progressUpdates as $progress)
                                <div class="pg-card p-4">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="pg-status-badge pg-status-{{ $progress->status }}">{{ ucfirst(str_replace('_', ' ', (string) $progress->status)) }}</span>
                                                <span class="text-xs text-slate-500">{{ $progress->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                            <p class="text-sm text-slate-700">{{ $progress->note ?: 'Tidak ada catatan tambahan.' }}</p>
                                        </div>

                                        @if($progress->photo_path)
                                            <a href="{{ asset('storage/' . $progress->photo_path) }}" target="_blank" class="block w-full md:w-44 flex-shrink-0">
                                                <img
                                                    src="{{ asset('storage/' . $progress->photo_path) }}"
                                                    alt="Foto progres pengaduan"
                                                    class="w-full h-28 object-cover rounded-lg border border-slate-200">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="pg-card p-4 text-sm text-slate-600">
                                    Belum ada pembaruan progres publik.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="pg-card bg-blue-50 border-blue-200 rounded-2xl p-5" data-pg-reveal>
                <p class="text-sm text-blue-900">
                    Halaman ini menampilkan informasi publik untuk transparansi. Untuk melihat detail personal laporan Anda, gunakan nomor tracking lengkap pada halaman
                    <a href="{{ route('pengaduan.status') }}" class="pg-link font-bold text-blue-700 hover:underline">Cek Status</a>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
