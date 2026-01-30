@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="users" class="w-7 h-7 text-emerald-600"></i>
      Data Penduduk per Dusun/Kampung
    </h2>
    <a href="{{ route('admin.infografis.create') }}"
      class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg shadow-md font-medium transition-all duration-300 hover:scale-105 flex items-center gap-2">
      <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Data
    </a>
  </div>

  @if(session('success'))
  <div class="bg-emerald-100 text-emerald-700 border border-emerald-200 px-4 py-2 rounded-lg mb-6">
    {{ session('success') }}
  </div>
  @endif

  <div class="overflow-x-auto">
    <table class="min-w-full border border-slate-200 rounded-lg overflow-hidden text-xs md:text-sm">
      <thead class="bg-slate-100 text-slate-700 uppercase sticky top-0">
        <tr>
          <th class="py-3 px-3 text-left">Dusun</th>
          <th class="py-3 px-3 text-center">Total</th>
          <th class="py-3 px-3 text-center">L/P</th>
          <th class="py-3 px-3 text-center">KK</th>
          <!-- Pendidikan -->
          <th class="py-3 px-2 text-center bg-blue-50">SD</th>
          <th class="py-3 px-2 text-center bg-blue-50">SMP</th>
          <th class="py-3 px-2 text-center bg-blue-50">SMA</th>
          <!-- Pekerjaan -->
          <th class="py-3 px-2 text-center bg-purple-50">Petani</th>
          <th class="py-3 px-2 text-center bg-purple-50">Karyawan</th>
          <th class="py-3 px-2 text-center bg-purple-50">Wiraswasta</th>
          <!-- Agama -->
          <th class="py-3 px-2 text-center bg-green-50">Islam</th>
          <th class="py-3 px-2 text-center bg-green-50">Kristen</th>
          <th class="py-3 px-3 text-center w-20">Aksi</th>
        </tr>
      </thead>
      <tbody class="text-slate-700">
        @forelse($penduduks as $item)
        <tr class="border-t border-slate-200 hover:bg-slate-50 transition-colors">
          <td class="py-3 px-3 font-medium">{{ $item->dusun }}</td>
          <td class="py-3 px-3 text-center font-semibold">{{ number_format($item->total_penduduk) }}</td>
          <td class="py-3 px-3 text-center text-xs">{{ $item->laki_laki }}/{{ $item->perempuan }}</td>
          <td class="py-3 px-3 text-center">{{ $item->kepala_keluarga }}</td>
          <!-- Pendidikan -->
          <td class="py-3 px-2 text-center bg-blue-50 text-xs">{{ $item->pendidikan_sd ?? '-' }}</td>
          <td class="py-3 px-2 text-center bg-blue-50 text-xs">{{ $item->pendidikan_smp ?? '-' }}</td>
          <td class="py-3 px-2 text-center bg-blue-50 text-xs">{{ $item->pendidikan_sma ?? '-' }}</td>
          <!-- Pekerjaan -->
          <td class="py-3 px-2 text-center bg-purple-50 text-xs">{{ $item->pekerjaan_petani ?? '-' }}</td>
          <td class="py-3 px-2 text-center bg-purple-50 text-xs">{{ $item->pekerjaan_karyawan ?? '-' }}</td>
          <td class="py-3 px-2 text-center bg-purple-50 text-xs">{{ $item->pekerjaan_wiraswasta ?? '-' }}</td>
          <!-- Agama -->
          <td class="py-3 px-2 text-center bg-green-50 text-xs">{{ $item->agama_islam ?? '-' }}</td>
          <td class="py-3 px-2 text-center bg-green-50 text-xs">{{ $item->agama_kristen ?? '-' }}</td>
          <td class="py-3 px-3 text-center">
            <div class="flex justify-center gap-2">
              <a href="{{ route('admin.infografis.edit', $item->id) }}"
                class="text-blue-600 hover:text-blue-800 transition-transform hover:scale-110"
                title="Edit Data">
                <i data-lucide="edit" class="w-4 h-4"></i>
              </a>
              <form action="{{ route('admin.infografis.destroy', $item->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 transition-transform hover:scale-110"
                  title="Hapus Data">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="13" class="text-center py-8 text-slate-500">Belum ada data penduduk yang tersedia.</td>
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