@extends('public.layout')

@section('title', 'Cek Status Pengaduan')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-800 mb-2">Cek Status Pengaduan</h1>
            <p class="text-gray-600">Gunakan nomor tracking untuk melihat status pengaduan Anda</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 md:p-8 mb-8">
            <form method="GET" action="{{ route('pengaduan.status') }}" class="flex flex-col md:flex-row gap-2">
                <input 
                    type="text" 
                    name="tracking" 
                    placeholder="Contoh: ADU-20260131120530-1234"
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                    value="{{ old('tracking', $tracking) }}"
                    required
                >
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition-colors"
                >
                    Cari
                </button>
            </form>
            <p class="text-sm text-gray-500 mt-3">
                💡 Nomor tracking dikirim via email setelah Anda mengirim pengaduan
            </p>
        </div>

        <!-- Status Result -->
        @if($notFound && $tracking)
            <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center">
                <div class="text-5xl mb-3">❌</div>
                <h3 class="text-xl font-bold text-red-800 mb-2">Pengaduan Tidak Ditemukan</h3>
                <p class="text-red-700">Nomor tracking "<strong>{{ $tracking }}</strong>" tidak ditemukan dalam sistem.</p>
                <p class="text-red-600 text-sm mt-3">Silakan periksa kembali nomor tracking Anda atau hubungi kantor desa.</p>
            </div>
        @elseif($pengaduan)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header dengan Status Badge -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-emerald-100 text-sm mb-1">NOMOR TRACKING</p>
                            <h2 class="text-2xl font-bold">{{ $pengaduan->tracking_number }}</h2>
                        </div>
                        <span class="px-4 py-2 rounded-full text-sm font-semibold 
                            @if($pengaduan->status == 'submitted') bg-blue-500
                            @elseif($pengaduan->status == 'pending') bg-yellow-500
                            @elseif($pengaduan->status == 'in_progress') bg-orange-500
                            @elseif($pengaduan->status == 'resolved') bg-green-500
                            @elseif($pengaduan->status == 'rejected') bg-red-500
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Detail Pengaduan -->
                <div class="p-6 md:p-8">
                    <!-- Info Dasar -->
                    <div class="grid md:grid-cols-2 gap-6 mb-8 pb-8 border-b border-gray-200">
                        <div>
                            <p class="text-gray-600 text-sm font-semibold mb-1">NAMA</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $pengaduan->nama ?? 'Anonim' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm font-semibold mb-1">KATEGORI</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $pengaduan->kategori ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm font-semibold mb-1">TANGGAL PENGADUAN</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm font-semibold mb-1">DURASI PENANGANAN</p>
                            <p class="text-lg font-semibold text-slate-800">
                                @if($pengaduan->status == 'resolved')
                                    {{ $pengaduan->created_at->diffInDays($pengaduan->updated_at) }} hari
                                @else
                                    {{ $pengaduan->created_at->diffInDays(now()) }} hari (ongoing)
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Judul & Isi -->
                    @if($pengaduan->judul)
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <p class="text-gray-600 text-sm font-semibold mb-2">JUDUL SINGKAT</p>
                            <p class="text-slate-800">{{ $pengaduan->judul }}</p>
                        </div>
                    @endif

                    <!-- Status Timeline -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <p class="text-gray-600 text-sm font-semibold mb-4">TIMELINE STATUS</p>
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center text-sm font-bold">✓</div>
                                    <div class="w-0.5 h-8 bg-gray-300 mt-2"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">Pengaduan Diterima</p>
                                    <p class="text-sm text-gray-600">{{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full 
                                        @if($pengaduan->status == 'pending' || in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']))
                                            bg-emerald-600 text-white flex items-center justify-center text-sm font-bold
                                        @else
                                            bg-gray-300 text-gray-600 flex items-center justify-center text-sm font-bold
                                        @endif">
                                        @if($pengaduan->status == 'pending' || in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']))
                                            ✓
                                        @else
                                            ⏳
                                        @endif
                                    </div>
                                    <div class="w-0.5 h-8 bg-gray-300 mt-2"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">Dalam Antrian Proses</p>
                                    <p class="text-sm text-gray-600">
                                        @if(in_array($pengaduan->status, ['pending', 'in_progress', 'resolved', 'rejected']))
                                            {{ $pengaduan->updated_at->format('d M Y H:i') }}
                                        @else
                                            Menunggu...
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full 
                                        @if(in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']))
                                            bg-emerald-600 text-white flex items-center justify-center text-sm font-bold
                                        @else
                                            bg-gray-300 text-gray-600 flex items-center justify-center text-sm font-bold
                                        @endif">
                                        @if(in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']))
                                            ✓
                                        @else
                                            ⏳
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">Sedang Ditangani</p>
                                    <p class="text-sm text-gray-600">
                                        @if(in_array($pengaduan->status, ['in_progress', 'resolved', 'rejected']))
                                            {{ $pengaduan->updated_at->format('d M Y H:i') }}
                                        @else
                                            Menunggu...
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Notes (Public) -->
                    @if($pengaduan->admin_notes)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-blue-900 font-semibold mb-2">📝 Catatan Penanganan</p>
                            <p class="text-blue-800">{{ $pengaduan->admin_notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kembali -->
            <div class="text-center mt-8">
                <a href="{{ route('pengaduan.index') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                    ← Buat Pengaduan Baru
                </a>
                <span class="text-gray-400 mx-2">|</span>
                <a href="{{ route('pengaduan.list') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                    Lihat Semua Pengaduan →
                </a>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-12 text-center">
                <div class="text-5xl mb-4">🔍</div>
                <p class="text-gray-600 text-lg">Masukkan nomor tracking untuk melihat status pengaduan Anda</p>
            </div>
        @endif
    </div>
</div>
@endsection
