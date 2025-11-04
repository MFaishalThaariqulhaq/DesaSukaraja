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

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white text-sm rounded-lg shadow">
      <thead class="bg-slate-50 text-slate-700 uppercase">
        <tr>
          <th class="py-3 px-4 text-left font-semibold text-slate-600">Judul</th>
          <th class="py-3 px-4 text-left font-semibold text-slate-600">Gambar</th>
          <th class="py-3 px-4 text-center font-semibold text-slate-600 w-32">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 text-slate-700">
        @forelse($galeris as $galeri)
        <tr class="hover:bg-emerald-50 transition-colors duration-150">
          <td class="py-3 px-4 font-medium text-slate-800">{{ $galeri->judul }}</td>
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
                class="text-blue-600 hover:text-blue-800 transition-transform hover:scale-110"
                title="Edit Galeri">
                <i data-lucide="edit" class="w-5 h-5"></i>
              </a>

              <!-- Tombol Hapus -->
              <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="text-red-600 hover:text-red-800 transition-transform hover:scale-110" title="Hapus Galeri">
                  <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center py-8 text-slate-500">Belum ada galeri yang tersedia.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
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