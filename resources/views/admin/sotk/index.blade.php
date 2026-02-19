@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="users" class="w-7 h-7 text-emerald-600"></i>
      Daftar SOTK
    </h2>
      </div>

  <div class="flex flex-wrap gap-4 mb-6">
    <a href="{{ route('admin.sotk.create') }}"
      class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg shadow-md font-medium transition-all duration-300 hover:scale-105 flex items-center gap-2">
      <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Perangkat Desa
    </a>
    <a href="{{ route('admin.sotk.bagan') }}"
      class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow-md font-medium transition-all duration-300 hover:scale-105 flex items-center gap-2">
      <i data-lucide="image" class="w-5 h-5"></i> Upload Bagan Organisasi
    </a>
  </div>

  @if(session('success'))
  <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md animate-fadeIn" role="alert">
    <p>{{ session('success') }}</p>
  </div>
  @endif

  <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div class="text-sm text-slate-500">
      Menampilkan
      <span class="font-semibold text-slate-700">{{ $sotks->firstItem() ?? 0 }}</span>
      -
      <span class="font-semibold text-slate-700">{{ $sotks->lastItem() ?? 0 }}</span>
      dari
      <span class="font-semibold text-slate-700">{{ $sotks->total() }}</span>
      data
    </div>
    <form method="GET" action="{{ route('admin.sotk.index') }}" class="flex items-center gap-2">
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
      <thead class="bg-slate-50">
        <tr>
          <th class="py-3 px-4 text-left font-semibold text-slate-600">Nama</th>
          <th class="py-3 px-4 text-left font-semibold text-slate-600">Jabatan</th>
          <th class="py-3 px-4 text-center font-semibold text-slate-600">Foto</th>
          <th class="py-3 px-4 text-center font-semibold text-slate-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200">
        @forelse($sotks as $sotk)
        <tr class="hover:bg-emerald-50 transition-colors duration-150">
          <td class="py-3 px-4 font-medium text-slate-800">{{ $sotk->nama }}</td>
          <td class="py-3 px-4 text-slate-700">{{ $sotk->jabatan }}</td>
          <td class="py-3 px-4 text-center">
            <img src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://placehold.co/64x64/94a3b8/ffffff?text=Foto' }}"
              alt="{{ $sotk->nama }}" class="w-12 h-12 object-cover rounded-full border shadow">
          </td>
          <td class="py-3 px-4 text-center">
            <div class="flex justify-center items-center space-x-2">
              <a href="{{ route('admin.sotk.edit', $sotk->id) }}"
                class="inline-flex items-center justify-center p-2 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition-colors"
                title="Edit Data">
                <i data-lucide="edit" class="w-5 h-5"></i>
              </a>
              <form action="{{ route('admin.sotk.destroy', $sotk->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="inline-flex items-center justify-center p-2 rounded-lg text-red-600 hover:text-red-800 hover:bg-red-50 transition-colors" title="Hapus Data">
                  <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="py-4 px-4 text-center text-slate-500">
            Belum ada data perangkat desa yang ditambahkan.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($sotks->hasPages())
  <div class="mt-6">
    {{ $sotks->links('vendor.pagination.tailwind') }}
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
