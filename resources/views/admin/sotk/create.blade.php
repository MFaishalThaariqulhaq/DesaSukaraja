@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-lg shadow-md max-w-2xl mx-auto">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Tambah Struktur Organisasi (SOTK)</h2>
    <a href="{{ route('admin.sotk.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
    </a>
  </div>

  <form action="{{ route('admin.sotk.store') }}" method="POST" enctype="multipart/form-data"
    class="space-y-5">
    @csrf

    <div>
      <label for="nama" class="block font-semibold text-slate-700 mb-1">Nama</label>
      <input type="text" name="nama" id="nama" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
    </div>

    <div>
      <label for="jabatan" class="block font-semibold text-slate-700 mb-1">Jabatan</label>
      <input type="text" name="jabatan" id="jabatan" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
    </div>

    <div>
      <label for="foto" class="block font-semibold text-slate-700 mb-1">Foto (gambar)</label>
      <input type="file" name="foto" id="foto" accept="image/*"
        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
    </div>

    <div>
      <label for="tupoksi" class="block font-semibold text-slate-700 mb-1">Tupoksi (Tugas Pokok dan Fungsi)</label>
      <textarea name="tupoksi" id="tupoksi" rows="4"
        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
        placeholder="Masukkan tupoksi perangkat desa..."></textarea>
    </div>

    <div class="pt-4 flex justify-end">
      <button type="submit"
        class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-md transition-all duration-300 hover:scale-105">
        <i data-lucide="save" class="inline w-5 h-5 mr-2"></i> Simpan
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();
  });
</script>
@endsection