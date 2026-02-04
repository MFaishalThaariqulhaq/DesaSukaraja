@extends('layouts.public.layout')

@section('title', 'Dashboard Pengaduan Publik')

@section('content')
<div class="bg-gradient-to-b from-slate-900 to-slate-800 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Dashboard Pengaduan Masyarakat</h1>
        <p class="text-slate-300">Transparansi penanganan pengaduan Desa Sukaraja</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Header Intro -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">📊 Statistik Pengaduan</h2>
        <p class="text-gray-600">Pantau status dan statistik penanganan pengaduan masyarakat Desa Sukaraja</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-lg shadow-md p-6 border border-emerald-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Total Pengaduan</p>
                    <div class="text-4xl font-bold text-emerald-600">{{ $stats['total'] }}</div>
                </div>
                <span class="text-5xl opacity-20">📋</span>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg shadow-md p-6 border border-orange-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Sedang Ditangani</p>
                    <div class="text-4xl font-bold text-orange-500">{{ $stats['in_progress'] }}</div>
                </div>
                <span class="text-5xl opacity-20">⚙️</span>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg shadow-md p-6 border border-green-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Sudah Ditangani</p>
                    <div class="text-4xl font-bold text-green-600">{{ $stats['resolved'] }}</div>
                </div>
                <span class="text-5xl opacity-20">✅</span>
            </div>
        </div>
    </div>

    <!-- Status Breakdown Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">📈 Breakdown Status Pengaduan</h3>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <div class="text-3xl font-bold text-blue-600">{{ $stats['submitted'] }}</div>
                <p class="text-sm text-gray-700 font-medium mt-1">🔵 Baru Diterima</p>
            </div>
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <div class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
                <p class="text-sm text-gray-700 font-medium mt-1">⏳ Dalam Antrian</p>
            </div>
            <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded">
                <div class="text-3xl font-bold text-orange-600">{{ $stats['in_progress'] }}</div>
                <p class="text-sm text-gray-700 font-medium mt-1">🟠 Sedang Diproses</p>
            </div>
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <div class="text-3xl font-bold text-green-600">{{ $stats['resolved'] }}</div>
                <p class="text-sm text-gray-700 font-medium mt-1">✅ Selesai</p>
            </div>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <div class="text-3xl font-bold text-red-600">{{ $stats['rejected'] }}</div>
                <p class="text-sm text-gray-700 font-medium mt-1">❌ Ditolak</p>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Kategori Stats -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">📊 Pengaduan per Kategori</h3>
            <div class="space-y-4">
                @forelse($kategoriStats as $kategori => $count)
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-semibold text-gray-700">{{ $kategori }}</span>
                            <span class="text-sm font-bold text-gray-900 bg-gray-100 px-2 py-1 rounded">{{ $count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-emerald-600 h-2.5 rounded-full" style="width: {{ ($count / $stats['total']) * 100 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ round(($count / $stats['total']) * 100, 1) }}%</p>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Belum ada kategori pengaduan</p>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2">
            <h3 class="text-lg font-bold text-slate-800 mb-4">🚀 Aksi Cepat</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('pengaduan.index') }}" class="flex items-center gap-3 p-4 bg-emerald-50 hover:bg-emerald-100 border border-emerald-300 rounded-lg transition-all hover:shadow-md">
                    <span class="text-4xl">📝</span>
                    <div>
                        <p class="font-bold text-emerald-900">Buat Pengaduan Baru</p>
                        <p class="text-xs text-emerald-700">Sampaikan keluhan atau saran Anda</p>
                    </div>
                </a>
                <a href="{{ route('pengaduan.status') }}" class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 border border-blue-300 rounded-lg transition-all hover:shadow-md">
                    <span class="text-4xl">🔍</span>
                    <div>
                        <p class="font-bold text-blue-900">Cek Status Pengaduan</p>
                        <p class="text-xs text-blue-700">Masukkan nomor tracking Anda</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Filter & Table Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">📋 Daftar Pengaduan Terbaru</h3>
            
            <!-- Filter -->
            <form method="GET" action="{{ route('pengaduan.list') }}" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                        <option value="">🏷️ Semua Kategori</option>
                        @foreach($allKategori as $kat)
                            <option value="{{ $kat }}" {{ $kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                        <option value="">📌 Semua Status</option>
                        <option value="submitted" {{ $status == 'submitted' ? 'selected' : '' }}>🔵 Baru Diterima</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>⏳ Dalam Antrian</option>
                        <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>🟠 Sedang Diproses</option>
                        <option value="resolved" {{ $status == 'resolved' ? 'selected' : '' }}>✅ Selesai</option>
                        <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition-colors shadow-md">
                    Filter
                </button>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">No. Tracking</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Judul</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $p)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors cursor-pointer" onclick="window.location='{{ route('pengaduan.status', ['tracking' => $p->tracking_number]) }}'">
                            <td class="px-4 py-3 text-gray-800 font-mono text-xs">
                                {{ Str::limit($p->tracking_number, 14, '...') }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $p->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-700">
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">
                                    {{ $p->kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-emerald-600 hover:text-emerald-700 font-semibold">
                                    {{ $p->judul ? Str::limit($p->judul, 40) : Str::limit($p->isi, 40) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-block px-3 py-1.5 rounded-full text-xs font-bold text-white
                                    @if($p->status == 'submitted') bg-blue-500
                                    @elseif($p->status == 'pending') bg-yellow-500
                                    @elseif($p->status == 'in_progress') bg-orange-500
                                    @elseif($p->status == 'resolved') bg-green-500
                                    @elseif($p->status == 'rejected') bg-red-500
                                    @endif">
                                    @if($p->status == 'submitted') 🔵
                                    @elseif($p->status == 'pending') ⏳
                                    @elseif($p->status == 'in_progress') 🟠
                                    @elseif($p->status == 'resolved') ✅
                                    @elseif($p->status == 'rejected') ❌
                                    @endif
                                    {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <span class="text-4xl mb-2 block">🔍</span>
                                Tidak ada pengaduan ditemukan dengan filter yang Anda pilih
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pengaduans->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $pengaduans->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <!-- Info Note -->
    <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
        <p class="text-blue-900">
            <strong>💡 Catatan:</strong> Dashboard ini menampilkan informasi publik pengaduan untuk transparansi. 
            Untuk melihat detail lengkap dan catatan penanganan pengaduan Anda, gunakan nomor tracking yang dikirim via email pada halaman <a href="{{ route('pengaduan.status') }}" class="font-bold text-blue-700 hover:underline">Cek Status</a>.
        </p>
    </div>
</div>
@endsection
