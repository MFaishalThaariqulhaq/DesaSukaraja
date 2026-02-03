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

    <div>
      <label for="keterangan" class="block font-semibold text-slate-700 mb-1">Keterangan</label>
      <input type="text" name="keterangan" id="keterangan" 
        value="Masa Bakti 2024 - 2029"
        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
        placeholder="Contoh: Masa Bakti 2024 - 2029">
      <p class="text-xs text-slate-500 mt-1">Teks umum yang ditampilkan di bawah nama aparatur</p>
    </div>

    <hr class="my-6 border-slate-200">

    <h3 class="text-lg font-semibold text-slate-700 mb-4">Warna dan Ikon</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label for="badge_color" class="block font-semibold text-slate-700 mb-1">Warna Badge</label>
        <div class="flex items-center gap-2">
          <input type="color" name="badge_color" id="badge_color" 
            value="#10b981" 
            class="w-12 h-10 border border-slate-300 rounded cursor-pointer">
          <input type="text" placeholder="#10b981" 
            class="flex-1 border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm" 
            readonly id="badge_color_text">
        </div>
        <p class="text-xs text-slate-500 mt-1">Format: #RRGGBB (contoh: #10b981)</p>
      </div>

      <div>
        <label for="icon_color" class="block font-semibold text-slate-700 mb-1">Warna Ikon</label>
        <div class="flex items-center gap-2">
          <input type="color" name="icon_color" id="icon_color" 
            value="#6ee7b7"
            class="w-12 h-10 border border-slate-300 rounded cursor-pointer">
          <input type="text" placeholder="#6ee7b7"
            class="flex-1 border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm"
            readonly id="icon_color_text">
        </div>
        <p class="text-xs text-slate-500 mt-1">Format: #RRGGBB (contoh: #6ee7b7)</p>
      </div>
    </div>

    <div>
      <label for="icon_name" class="block font-semibold text-slate-700 mb-1">Nama Ikon (Lucide Icons)</label>
      <input type="text" name="icon_name" id="icon_name"
        value="book-open"
        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono"
        placeholder="book-open">
      <p class="text-xs text-slate-500 mt-1">
        Pilihan populer: book-open, file-text, map, users, shield, briefcase, award, target
        <a href="https://lucide.dev/" target="_blank" class="text-emerald-600 hover:text-emerald-700">Lihat semua ikon →</a>
      </p>
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

    // Sync color inputs
    const badgeColorInput = document.getElementById('badge_color');
    const badgeColorText = document.getElementById('badge_color_text');
    if (badgeColorInput && badgeColorText) {
      badgeColorInput.addEventListener('change', (e) => {
        badgeColorText.value = e.target.value;
      });
    }

    const iconColorInput = document.getElementById('icon_color');
    const iconColorText = document.getElementById('icon_color_text');
    if (iconColorInput && iconColorText) {
      iconColorInput.addEventListener('change', (e) => {
        iconColorText.value = e.target.value;
      });
    }
  });
</script>
@endsection