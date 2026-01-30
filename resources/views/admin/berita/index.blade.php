@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <!-- Header with Stats -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
      <h2 class="text-2xl md:text-3xl font-bold text-slate-800 flex items-center gap-2 mb-2">
        <i data-lucide="newspaper" class="w-7 h-7 text-emerald-600"></i>
        Kelola Berita
      </h2>
      <p class="text-slate-600 text-sm">Kelola semua artikel dan berita Desa Sukaraja</p>
    </div>
    <a href="{{ route('admin.berita.create') }}"
      class="bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white px-6 py-3 rounded-lg shadow-md font-medium transition-all duration-300 hover:shadow-lg flex items-center gap-2 whitespace-nowrap">
      <i data-lucide="plus-circle" class="w-5 h-5"></i>
      <span>Tambah Berita Baru</span>
    </a>
  </div>

  @if(session('success'))
  <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 mb-6 rounded-lg flex items-center gap-3 animate-slideIn" role="alert">
    <i data-lucide="check-circle" class="w-5 h-5 text-green-600 flex-shrink-0"></i>
    <span>{{ session('success') }}</span>
  </div>
  @endif

  @if(session('error'))
  <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 mb-6 rounded-lg flex items-center gap-3 animate-slideIn" role="alert">
    <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 flex-shrink-0"></i>
    <span>{{ session('error') }}</span>
  </div>
  @endif

  <!-- Search and Filter -->
  <div class="mb-6 flex gap-3 flex-col md:flex-row">
    <div class="flex-1 relative">
      <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-3 top-3"></i>
      <input type="text" placeholder="Cari berdasarkan judul atau slug..."
        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
    </div>
  </div>

  <!-- Table -->
  <div class="overflow-x-auto border border-slate-200 rounded-xl">
    <table class="w-full">
      <thead class="bg-slate-50 border-b border-slate-200">
        <tr>
          <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Gambar</th>
          <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Judul</th>
          <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Slug</th>
          <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Tanggal</th>
          <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 text-slate-700">
        @forelse($beritas as $berita)
        <tr class="hover:bg-slate-50 transition-colors duration-150">
          <td class="px-6 py-4">
            <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/100x80/60a5fa/ffffff?text=No+Image' }}"
              alt="{{ $berita->judul }}"
              class="w-16 h-12 object-cover rounded-md">
          </td>
          <td class="px-6 py-4">
            <div class="font-medium text-slate-900 line-clamp-2">{{ $berita->judul }}</div>
            <p class="text-xs text-slate-500 mt-1 line-clamp-1">{{ strip_tags($berita->isi) }}</p>
          </td>
          <td class="px-6 py-4 text-slate-600 text-sm">{{ $berita->slug }}</td>
          <td class="px-6 py-4">
            <span class="text-sm text-slate-600 flex items-center gap-1">
              <i data-lucide="calendar" class="w-4 h-4"></i>
              {{ $berita->created_at->format('d M Y') }}
            </span>
          </td>
          <td class="px-6 py-4 text-center">
            <div class="flex justify-center items-center gap-2">
              <!-- View -->
              <a href="{{ route('berita.detail', $berita->slug) }}"
                class="text-slate-600 hover:text-emerald-600 transition-colors p-2 hover:bg-emerald-50 rounded-lg"
                title="Lihat" target="_blank">
                <i data-lucide="eye" class="w-5 h-5"></i>
              </a>
              <!-- Edit -->
              <a href="{{ route('admin.berita.edit', $berita->id) }}"
                class="text-blue-600 hover:text-blue-800 transition-colors p-2 hover:bg-blue-50 rounded-lg"
                title="Edit Berita">
                <i data-lucide="edit-3" class="w-5 h-5"></i>
              </a>
              <!-- Delete -->
              <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="text-red-600 hover:text-red-800 transition-colors p-2 hover:bg-red-50 rounded-lg"
                  title="Hapus Berita">
                  <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-12">
            <div class="flex flex-col items-center justify-center">
              <i data-lucide="inbox" class="w-12 h-12 text-slate-300 mb-3"></i>
              <p class="text-slate-500 font-medium">Belum ada berita</p>
              <p class="text-slate-400 text-sm mt-1">Mulai buat berita pertama Anda sekarang</p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($beritas->hasPages())
  <div class="mt-6">
    {{ $beritas->links('vendor.pagination.tailwind') }}
  </div>
  @endif
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();

    // Search functionality
    const searchInput = document.querySelector('input[type="text"]');
    if (searchInput) {
      searchInput.addEventListener('keyup', (e) => {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('tbody tr').forEach(row => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(query) ? '' : 'none';
        });
      });
    }
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

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(-20px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .animate-fadeIn {
    animation: fadeIn 0.5s ease-out forwards;
  }

  .animate-slideIn {
    animation: slideIn 0.4s ease-out forwards;
  }
</style>
@endsection