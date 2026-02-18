@extends('admin.dashboard')
@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="message-square" class="w-7 h-7 text-emerald-600"></i>
      Detail Pengaduan
    </h2>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.pengaduan.index') }}" class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
      </a>

      <a href="{{ route('admin.pengaduan.edit', $pengaduan->id) }}" class="inline-flex items-center px-3 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition transform hover:-translate-y-0.5 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-300">
        <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
        Ubah Status
      </a>

      <form id="deleteForm" action="{{ route('admin.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
        @csrf
        @method('DELETE')
        <button type="button" onclick="openDeleteModal()" class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition transform hover:-translate-y-0.5 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200">
          <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
          Hapus
        </button>
      </form>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
      <div class="mb-3"><strong>Nama:</strong> {{ $pengaduan->nama ?? '-' }}</div>
      <div class="mb-3"><strong>Email:</strong> {{ $pengaduan->email ?? '-' }}</div>
      <div class="mb-3"><strong>Telepon:</strong> {{ $pengaduan->telepon ?? '-' }}</div>
      <div class="mb-3"><strong>Kategori:</strong> {{ $pengaduan->kategori ?? '-' }}</div>
      <div class="mb-3">
        <strong>Tracking Number:</strong>
        <span class="ml-2 font-mono bg-slate-100 px-2 py-1 rounded text-sm">{{ $pengaduan->tracking_number ?? 'N/A' }}</span>
      </div>
    </div>
    <div>
      <div class="mb-3">
        <strong>Status:</strong>
        <span class="ml-2 font-semibold px-3 py-1 rounded-full text-white
          @if($pengaduan->status == 'submitted') bg-blue-500
          @elseif($pengaduan->status == 'pending') bg-yellow-500
          @elseif($pengaduan->status == 'in_progress') bg-orange-500
          @elseif($pengaduan->status == 'resolved') bg-green-500
          @elseif($pengaduan->status == 'rejected') bg-red-500
          @endif">
          {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
        </span>
      </div>
      <div class="mb-3"><strong>Tanggal:</strong> {{ $pengaduan->created_at->format('d M Y H:i') }}</div>
      @if($pengaduan->file_path)
      <div class="mb-3">
        <strong>Lampiran:</strong>
        <div class="mt-2">
          <a href="{{ asset('storage/' . $pengaduan->file_path) }}" target="_blank" class="text-emerald-600 hover:underline">📎 Lihat Lampiran</a>
        </div>
      </div>
      @endif
    </div>
  </div>

  <div class="mt-6 grid grid-cols-1 gap-6">
    <div>
      <strong>Isi Pengaduan:</strong>
      <div class="mt-2 p-4 bg-slate-50 rounded text-slate-700 border border-slate-200">{{ $pengaduan->isi }}</div>
    </div>
    
    <div>
      <strong>Catatan Penanganan (Public):</strong>
      <p class="text-xs text-gray-500 mb-2">Catatan ini akan ditampilkan kepada masyarakat di halaman status tracking</p>
      <div class="mt-2 p-4 bg-blue-50 rounded text-slate-700 border border-blue-200 italic">
        {{ $pengaduan->admin_notes ?? '(Belum ada catatan)' }}
      </div>
    </div>

    <div>
      <strong>Riwayat Update Progres:</strong>
      <div class="mt-2 space-y-3">
        @forelse($pengaduan->progressUpdates as $progress)
          <div class="p-4 border border-slate-200 rounded-lg bg-slate-50">
            <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
              <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-semibold px-2 py-1 rounded bg-slate-200 text-slate-700">{{ ucfirst(str_replace('_', ' ', $progress->status ?? 'update')) }}</span>
                <span class="text-xs text-slate-500">{{ $progress->created_at->format('d M Y H:i') }}</span>
                <span class="text-xs px-2 py-1 rounded {{ $progress->is_public ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-700' }}">
                  {{ $progress->is_public ? 'Publik' : 'Internal' }}
                </span>
              </div>
              <form method="POST" action="{{ route('admin.pengaduan.progress.destroy', ['pengaduan' => $pengaduan->id, 'progress' => $progress->id]) }}" onsubmit="return confirm('Hapus riwayat progres ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center rounded-md border border-red-200 bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700 hover:bg-red-100">
                  Hapus
                </button>
              </form>
            </div>
            <p class="text-sm text-slate-700">{{ $progress->note ?: '-' }}</p>
            @if($progress->photo_path)
              <a href="{{ asset('storage/' . $progress->photo_path) }}" target="_blank" class="inline-flex items-center mt-2 text-sm text-emerald-700 hover:underline">
                Lihat Foto Progres
              </a>
            @endif
          </div>
        @empty
          <div class="p-4 border border-dashed border-slate-300 rounded-lg text-sm text-slate-500">
            Belum ada update progres.
          </div>
        @endforelse
      </div>
    </div>
  </div>

</div>

<!-- Delete Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50">
  <div class="bg-white rounded-xl shadow-lg w-11/12 max-w-md p-6">
    <h3 class="text-lg font-bold mb-2">Konfirmasi Hapus</h3>
    <p class="text-sm text-slate-600 mb-4">Anda akan menghapus pengaduan ini secara permanen. Tindakan ini tidak dapat dibatalkan. Lanjutkan?</p>
    <div class="flex justify-end gap-3">
      <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-slate-100 rounded hover:bg-slate-200">Batal</button>
      <button type="button" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700" onclick="confirmDelete()">Hapus</button>
    </div>
  </div>
</div>

<script>
  function openDeleteModal() {
    const modal = document.getElementById('confirmModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex', 'items-center', 'justify-center');
    // ensure icons render inside modal
    if (window.lucide) {
      lucide.createIcons();
    }
  }

  function closeDeleteModal() {
    const modal = document.getElementById('confirmModal');
    modal.classList.remove('flex', 'items-center', 'justify-center');
    modal.classList.add('hidden');
  }

  function confirmDelete() {
    // submit the real form
    document.getElementById('deleteForm').submit();
  }
</script>
@endsection
