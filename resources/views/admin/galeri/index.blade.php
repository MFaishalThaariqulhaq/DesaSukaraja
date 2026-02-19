@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="images" class="w-7 h-7 text-emerald-600"></i>
      Daftar Galeri
    </h2>
    <a href="{{ route('admin.galeri.create') }}"
      class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg shadow-md font-medium transition-all duration-300 hover:scale-105 flex items-center gap-2">
      <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Galeri
    </a>
  </div>

  @if(session('success'))
  <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md animate-fadeIn" role="alert">
    <p>{{ session('success') }}</p>
  </div>
  @endif

  <form method="GET" action="{{ route('admin.galeri.index') }}" class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-2">
    <input
      type="text"
      name="q"
      value="{{ request('q') }}"
      placeholder="Cari judul galeri..."
      class="border border-slate-300 rounded-lg p-2.5 md:col-span-2">
    <select name="kategori" class="border border-slate-300 rounded-lg p-2.5">
      <option value="">Semua Kategori</option>
      @if(!empty($categories) && $categories->count())
      @foreach($categories as $cat)
      <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
      @endforeach
      @endif
    </select>
    <div class="flex gap-2">
      <input type="hidden" name="per_page" value="{{ (int) ($perPage ?? 10) }}">
      <button type="submit" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition-colors">Filter</button>
      <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold transition-colors">Reset</a>
    </div>
  </form>

  <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div class="text-sm text-slate-500">
      Menampilkan
      <span class="font-semibold text-slate-700">{{ $galeris->firstItem() ?? 0 }}</span>
      -
      <span class="font-semibold text-slate-700">{{ $galeris->lastItem() ?? 0 }}</span>
      dari
      <span class="font-semibold text-slate-700">{{ $galeris->total() }}</span>
      galeri
    </div>
    <form method="GET" action="{{ route('admin.galeri.index') }}" class="flex items-center gap-2">
      <input type="hidden" name="q" value="{{ request('q') }}">
      <input type="hidden" name="kategori" value="{{ request('kategori') }}">
      <label for="per_page" class="text-sm text-slate-600">Per halaman</label>
      <select id="per_page" name="per_page" class="px-3 py-2 border border-slate-300 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" onchange="this.form.submit()">
        @foreach([5, 10, 15] as $option)
          <option value="{{ $option }}" {{ (int) ($perPage ?? 10) === $option ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
      </select>
    </form>
  </div>

  <div class="overflow-x-auto border border-slate-200 rounded-xl">
    <table class="min-w-full bg-white text-sm">
      <thead class="bg-slate-50 text-slate-700 uppercase">
        <tr>
          <th class="py-3 px-4 text-left font-semibold text-slate-600">Judul</th>
          <th class="py-3 px-4 text-left font-semibold text-slate-600">Kategori</th>
          <th class="py-3 px-4 text-left font-semibold text-slate-600">Gambar</th>
          <th class="py-3 px-4 text-center font-semibold text-slate-600 w-32">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 text-slate-700">
        @forelse($galeris as $galeri)
        <tr class="hover:bg-emerald-50 transition-colors duration-150">
          <td class="py-3 px-4 font-medium text-slate-800">{{ $galeri->judul }}</td>
          <td class="py-3 px-4">
            @php
              $categoryBadges = [
                'Kegiatan' => 'bg-blue-100 text-blue-800',
                'Alam & Wisata' => 'bg-green-100 text-green-800',
                'Pembangunan' => 'bg-orange-100 text-orange-800',
              ];
              $badgeClass = $categoryBadges[$galeri->kategori] ?? 'bg-slate-100 text-slate-800';
            @endphp
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
              {{ $galeri->kategori ?? 'Tidak Dikategorikan' }}
            </span>
          </td>
          <td class="py-3 px-4">
            @if($galeri->gambar)
            <img src="{{ asset('storage/' . $galeri->gambar) }}"
              alt="{{ $galeri->judul }}"
              class="w-20 h-20 object-cover rounded-xl shadow-sm hover:scale-105 transition-transform duration-300 border border-slate-200">
            @else
            <div class="w-20 h-20 flex items-center justify-center bg-emerald-100 text-emerald-600 font-semibold rounded-xl border border-slate-200">
              N/A
            </div>
            @endif
          </td>
          <td class="py-3 px-4 text-center">
            <div class="flex justify-center items-center space-x-2">
              <!-- Tombol Edit -->
              <a href="{{ route('admin.galeri.edit', $galeri->id) }}"
                class="inline-flex items-center justify-center p-2 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition-colors"
                title="Edit Galeri">
                <i data-lucide="edit" class="w-5 h-5"></i>
              </a>

              <!-- Tombol Hapus -->
              <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="inline-flex items-center justify-center p-2 rounded-lg text-red-600 hover:text-red-800 hover:bg-red-50 transition-colors" title="Hapus Galeri">
                  <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center py-8 text-slate-500">Belum ada galeri yang tersedia.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($galeris->hasPages())
  <div class="mt-6">
    {{ $galeris->links('vendor.pagination.tailwind') }}
  </div>
  @endif
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();
  });
</script>

<style>
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fadeIn {
    animation: fadeIn 0.5s ease-out forwards;
  }
</style>
@endsection
