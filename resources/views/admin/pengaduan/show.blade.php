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

      <form action="{{ route('admin.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
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
    </div>
    <div>
      <div class="mb-3"><strong>Status:</strong> <span class="ml-2 font-semibold">{{ ucfirst($pengaduan->status) }}</span></div>
      <div class="mb-3"><strong>Tanggal:</strong> {{ $pengaduan->created_at->format('d M Y H:i') }}</div>
      @if($pengaduan->file_path)
      <div class="mb-3">
        <strong>Lampiran:</strong>
        <div class="mt-2">
          <a href="{{ asset('storage/' . $pengaduan->file_path) }}" target="_blank" class="text-emerald-600">Lihat Lampiran</a>
        </div>
      </div>
      @endif
    </div>
  </div>

  <div class="mt-6">
    <strong>Isi Pengaduan:</strong>
    <div class="mt-2 p-4 bg-slate-50 rounded text-slate-700">{{ $pengaduan->isi }}</div>
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