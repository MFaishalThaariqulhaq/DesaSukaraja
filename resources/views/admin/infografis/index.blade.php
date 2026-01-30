@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="users" class="w-7 h-7 text-emerald-600"></i>
      Data Penduduk per Dusun/Kampung
    </h2>
    <a href="{{ route('admin.infografis.create') }}"
      class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg shadow-md font-medium transition-all duration-300 hover:scale-105 flex items-center gap-2 w-fit">
      <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Data
    </a>
  </div>

  @if(session('success'))
  <div class="bg-emerald-100 text-emerald-700 border border-emerald-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-2 animate-pulse">
    <i data-lucide="check-circle" class="w-5 h-5"></i>
    {{ session('success') }}
  </div>
  @endif

  <div class="mb-6">
    <div class="relative">
      <i data-lucide="search" class="absolute left-3 top-3 w-5 h-5 text-slate-400"></i>
      <input type="text" id="searchInput" placeholder="Cari nama dusun..."
        class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full border border-slate-200 rounded-lg overflow-hidden text-xs md:text-sm" id="dataTable">
      <thead class="bg-slate-100 text-slate-700 uppercase sticky top-0">
        <tr>
          <th class="py-3 px-3 text-left">Dusun</th>
          <th class="py-3 px-3 text-center">Total</th>
          <th class="py-3 px-3 text-center">L/P</th>
          <th class="py-3 px-3 text-center">KK</th>
          <th class="py-3 px-3 text-center w-20">Aksi</th>
        </tr>
      </thead>
      <tbody class="text-slate-700" id="tableBody">
        @forelse($penduduks as $item)
        <tr class="border-t border-slate-200 hover:bg-slate-50 transition-colors searchable-row">
          <td class="py-3 px-3 font-medium">{{ $item->dusun }}</td>
          <td class="py-3 px-3 text-center font-semibold">{{ number_format($item->total_penduduk) }}</td>
          <td class="py-3 px-3 text-center text-xs">
            <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ $item->laki_laki }}</span> /
            <span class="inline-block bg-pink-100 text-pink-700 px-2 py-1 rounded">{{ $item->perempuan }}</span>
          </td>
          <td class="py-3 px-3 text-center">{{ $item->kepala_keluarga }}</td>
          <td class="py-3 px-3 text-center">
            <div class="flex justify-center gap-2">
              <a href="{{ route('admin.infografis.edit', $item->id) }}"
                class="text-blue-600 hover:text-blue-800 transition-transform hover:scale-110 hover:bg-blue-50 p-1.5 rounded"
                title="Edit Data">
                <i data-lucide="edit" class="w-4 h-4"></i>
              </a>
              <form action="{{ route('admin.infografis.destroy', $item->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 transition-transform hover:scale-110 hover:bg-red-50 p-1.5 rounded"
                  title="Hapus Data">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-8 text-slate-500">Belum ada data penduduk yang tersedia.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($penduduks->hasPages())
  <div class="mt-6 flex justify-center">
    {{ $penduduks->links('pagination::tailwind') }}
  </div>
  @endif
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();

    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('.searchable-row');

    searchInput?.addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();

      rows.forEach(row => {
        const dusunName = row.querySelector('td:first-child').textContent.toLowerCase();
        if (dusunName.includes(searchTerm)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
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