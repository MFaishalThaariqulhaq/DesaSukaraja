@extends('admin.dashboard')
@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="message-square" class="w-7 h-7 text-emerald-600"></i>
      Daftar Pengaduan
    </h2>
  </div>

  <form method="GET" class="mb-4 flex flex-col md:flex-row gap-2 items-stretch md:items-center">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, atau tracking..." class="border border-slate-300 rounded p-2 flex-1">
    <select name="status" class="border border-slate-300 rounded p-2">
      <option value="">Semua Status</option>
      <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Baru Diterima</option>
      <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Dalam Antrian</option>
      <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
      <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Selesai</option>
      <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
    </select>
    <select name="kategori" class="border border-slate-300 rounded p-2">
      <option value="">Semua Kategori</option>
      @if(!empty($categories) && $categories->count())
      @foreach($categories as $cat)
      <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
      @endforeach
      @else
      <option value="">--</option>
      @endif
    </select>
    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded font-semibold transition-colors">Filter</button>
  </form>
  @if(session('success'))
  <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
  @endif
</div>

<div class="overflow-x-auto">
  <table class="min-w-full bg-white text-sm">
    <thead class="bg-slate-50 text-slate-700 uppercase text-sm">
      <tr>
        <th class="py-3 px-4 text-left font-semibold text-slate-600">Tracking #</th>
        <th class="py-3 px-4 text-left font-semibold text-slate-600">Nama</th>
        <th class="py-3 px-4 text-left font-semibold text-slate-600">Kategori</th>
        <th class="py-3 px-4 text-left font-semibold text-slate-600">Isi</th>
        <th class="py-3 px-4 text-center font-semibold text-slate-600">Status</th>
        <th class="py-3 px-4 text-left font-semibold text-slate-600">Tanggal</th>
        <th class="py-3 px-4 text-center font-semibold text-slate-600 w-32">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-200 text-slate-700 text-sm">
      @forelse($pengaduans as $pengaduan)
      <tr class="hover:bg-emerald-50 transition-colors duration-150">
        <td class="py-3 px-4 font-mono text-xs bg-slate-50 rounded">{{ substr($pengaduan->tracking_number, 0, 12) }}...</td>
        <td class="py-3 px-4 font-medium text-slate-800">{{ $pengaduan->nama ?? 'Anonim' }}</td>
        <td class="py-3 px-4 text-slate-600">
          <span class="inline-block px-2 py-1 bg-gray-100 rounded text-xs">{{ $pengaduan->kategori ?? '-' }}</span>
        </td>
        <td class="py-3 px-4 text-slate-700">{{ \Illuminate\Support\Str::limit($pengaduan->isi, 50) }}</td>
        <td class="py-3 px-4 text-center">
          <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold text-white
            @if($pengaduan->status == 'submitted') bg-blue-500
            @elseif($pengaduan->status == 'pending') bg-yellow-500
            @elseif($pengaduan->status == 'in_progress') bg-orange-500
            @elseif($pengaduan->status == 'resolved') bg-green-500
            @elseif($pengaduan->status == 'rejected') bg-red-500
            @endif">
            {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
          </span>
        </td>
        <td class="py-3 px-4 text-gray-600 text-xs">{{ $pengaduan->created_at->format('d M Y') }}</td>
        <td class="py-3 px-4 text-center">
          <div class="flex justify-center items-center space-x-2">
            <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}"
              class="text-emerald-600 hover:text-emerald-800 transition-transform hover:scale-110" title="Lihat">
              <i data-lucide="eye" class="w-4 h-4"></i>
            </a>
            <a href="{{ route('admin.pengaduan.edit', $pengaduan->id) }}"
              class="text-sky-600 hover:text-sky-800 transition-transform hover:scale-110" title="Ubah">
              <i data-lucide="edit" class="w-4 h-4"></i>
            </a>
            <form action="{{ route('admin.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 transition-transform hover:scale-110" title="Hapus">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center py-8 text-slate-500">Belum ada pengaduan yang tersedia.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $pengaduans->links() }}</div>
</div>
@endsection