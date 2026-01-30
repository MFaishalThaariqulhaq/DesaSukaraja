@extends('public.layout')

@section('title', 'Dashboard Pengaduan Publik')

@section('content')
<div class="bg-gradient-to-b from-slate-900 to-slate-800 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Dashboard Pengaduan Masyarakat</h1>
        <p class="text-slate-300">Transparansi penanganan pengaduan Desa Sukaraja</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-4xl font-bold text-emerald-600 mb-2">{{ $stats['total'] }}</div>
            <p class="text-gray-600 font-semibold">Total Pengaduan</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-4xl font-bold text-orange-500 mb-2">{{ $stats['in_progress'] }}</div>
            <p class="text-gray-600 font-semibold">Sedang Ditangani</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-4xl font-bold text-green-600 mb-2">{{ $stats['resolved'] }}</div>
            <p class="text-gray-600 font-semibold">Sudah Ditangani</p>
        </div>
    </div>

    <!-- Status Breakdown -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-2 mb-12">
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['submitted'] }}</div>
            <p class="text-xs text-gray-600">Baru Diterima</p>
        </div>
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
            <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
            <p class="text-xs text-gray-600">Dalam Antrian</p>
        </div>
        <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded">
            <div class="text-2xl font-bold text-orange-600">{{ $stats['in_progress'] }}</div>
            <p class="text-xs text-gray-600">Sedang Diproses</p>
        </div>
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <div class="text-2xl font-bold text-green-600">{{ $stats['resolved'] }}</div>
            <p class="text-xs text-gray-600">Selesai</p>
        </div>
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <div class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</div>
            <p class="text-xs text-gray-600">Ditolak</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <!-- Pie Chart Kategori -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Pengaduan per Kategori</h3>
            <div class="space-y-3">
                @foreach($kategoriStats as $kategori => $count)
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-semibold text-gray-700">{{ $kategori }}</span>
                            <span class="text-sm font-bold text-gray-900">{{ $count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ ($count / $stats['total']) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('pengaduan.index') }}" class="flex items-center gap-2 p-3 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 rounded-lg transition-colors">
                    <span class="text-2xl">📝</span>
                    <div>
                        <p class="font-semibold text-emerald-900">Buat Pengaduan</p>
                        <p class="text-xs text-emerald-700">Sampaikan keluhan</p>
                    </div>
                </a>
                <a href="{{ route('pengaduan.status') }}" class="flex items-center gap-2 p-3 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg transition-colors">
                    <span class="text-2xl">🔍</span>
                    <div>
                        <p class="font-semibold text-blue-900">Cek Status</p>
                        <p class="text-xs text-blue-700">Tracking pengaduan</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Filter & Daftar -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Daftar Pengaduan</h3>
        
        <!-- Filter -->
        <form method="GET" action="{{ route('pengaduan.list') }}" class="flex flex-col md:flex-row gap-3 mb-6">
            <select name="kategori" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                <option value="">Semua Kategori</option>
                @foreach($allKategori as $kat)
                    <option value="{{ $kat }}" {{ $kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                <option value="">Semua Status</option>
                <option value="submitted" {{ $status == 'submitted' ? 'selected' : '' }}>Baru Diterima</option>
                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Dalam Antrian</option>
                <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="resolved" {{ $status == 'resolved' ? 'selected' : '' }}>Selesai</option>
                <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition-colors">
                Filter
            </button>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                        <th class="px-4 py-3 text-left font-semibold">Judul</th>
                        <th class="px-4 py-3 text-center font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $p)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-gray-600">
                                {{ $p->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-700">
                                <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded">
                                    {{ $p->kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('pengaduan.status', ['tracking' => $p->tracking_number]) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                                    {{ $p->judul ?? Str::limit($p->isi, 30) }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold text-white
                                    @if($p->status == 'submitted') bg-blue-500
                                    @elseif($p->status == 'pending') bg-yellow-500
                                    @elseif($p->status == 'in_progress') bg-orange-500
                                    @elseif($p->status == 'resolved') bg-green-500
                                    @elseif($p->status == 'rejected') bg-red-500
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                Tidak ada pengaduan ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pengaduans->hasPages())
            <div class="mt-6">
                {{ $pengaduans->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <!-- Info -->
    <div class="mt-12 bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
        <p class="text-blue-900">
            <strong>💡 Catatan:</strong> Dashboard ini menampilkan informasi publik pengaduan. 
            Untuk melihat detail lengkap pengaduan Anda, gunakan nomor tracking yang dikirim via email.
        </p>
    </div>
</div>
@endsection
