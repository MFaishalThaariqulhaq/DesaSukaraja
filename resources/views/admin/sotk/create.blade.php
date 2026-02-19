@extends('admin.dashboard')

@section('content')
<div class="max-w-5xl mx-auto">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h2 class="text-2xl font-bold text-slate-800">Tambah Perangkat SOTK</h2>
      <p class="text-sm text-slate-500 mt-1">Isi data aparatur desa beserta foto, tupoksi, warna, dan ikon tampilannya.</p>
    </div>
    <a href="{{ route('admin.sotk.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow-sm hover:bg-slate-50 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
    </a>
  </div>

  @if ($errors->any())
  <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700 text-sm">
    <ul class="list-disc pl-5 space-y-1">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('admin.sotk.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-8">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label for="nama" class="block font-semibold text-slate-700 mb-1">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
      </div>

      <div>
        <label for="jabatan" class="block font-semibold text-slate-700 mb-1">Jabatan</label>
        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
      </div>
    </div>

    <div>
      <label class="block font-semibold text-slate-700 mb-1">Foto</label>
      @php $placeholderFoto = 'https://placehold.co/300x400?text=Foto+Perangkat'; @endphp
      <div class="group relative rounded-xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 transition w-56 h-72 flex items-center justify-center" data-image-card data-input-id="foto">
        <img
          id="previewFoto"
          data-image-preview
          src="{{ $placeholderFoto }}"
          data-placeholder="{{ $placeholderFoto }}"
          alt="Preview Foto"
          class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
          <button type="button" data-image-edit class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 shadow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
      <input type="file" name="foto" id="foto" class="hidden" accept="image/*">
      <p class="text-xs text-slate-500 mt-2">Arahkan kursor ke foto untuk memilih file. Format JPG/PNG/GIF, maksimal 2MB.</p>
    </div>

    <div>
      <label for="tupoksi" class="block font-semibold text-slate-700 mb-1">Tupoksi (Tugas Pokok dan Fungsi)</label>
      <textarea name="tupoksi" id="tupoksi" rows="5" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" placeholder="Masukkan tupoksi perangkat desa...">{{ old('tupoksi') }}</textarea>
    </div>

    <div>
      <label for="keterangan" class="block font-semibold text-slate-700 mb-1">Keterangan</label>
      <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', 'Masa Bakti 2024 - 2029') }}" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" placeholder="Contoh: Masa Bakti 2024 - 2029">
      <p class="text-xs text-slate-500 mt-1">Teks kecil di bawah nama aparatur.</p>
    </div>

    <div class="border-t border-slate-200 pt-6">
      <h3 class="text-lg font-semibold text-slate-700 mb-4">Warna dan Ikon</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="badge_color" class="block font-semibold text-slate-700 mb-1">Warna Badge</label>
          <div class="flex items-center gap-2">
            <input type="color" name="badge_color" id="badge_color" value="{{ old('badge_color', '#10b981') }}" class="w-12 h-10 border border-slate-300 rounded cursor-pointer">
            <input type="text" readonly id="badge_color_text" value="{{ old('badge_color', '#10b981') }}" class="flex-1 border border-slate-300 rounded-lg p-2.5 text-sm bg-slate-50">
          </div>
        </div>

        <div>
          <label for="icon_color" class="block font-semibold text-slate-700 mb-1">Warna Ikon</label>
          <div class="flex items-center gap-2">
            <input type="color" name="icon_color" id="icon_color" value="{{ old('icon_color', '#6ee7b7') }}" class="w-12 h-10 border border-slate-300 rounded cursor-pointer">
            <input type="text" readonly id="icon_color_text" value="{{ old('icon_color', '#6ee7b7') }}" class="flex-1 border border-slate-300 rounded-lg p-2.5 text-sm bg-slate-50">
          </div>
        </div>
      </div>

      <div class="mt-4">
        <label for="icon_name" class="block font-semibold text-slate-700 mb-1">Nama Ikon (Lucide)</label>
        <input type="text" name="icon_name" id="icon_name" value="{{ old('icon_name', 'book-open') }}" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono" placeholder="book-open">
        <p class="text-xs text-slate-500 mt-1">Contoh: book-open, users, shield, briefcase, award. <a href="https://lucide.dev/icons/" target="_blank" class="text-emerald-600 hover:text-emerald-700">Lihat daftar ikon</a></p>
      </div>
    </div>

    <div class="pt-4 flex justify-end gap-3">
      <a href="{{ route('admin.sotk.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-800 font-medium px-6 py-2.5 rounded-lg shadow-sm transition">
        Batal
      </a>
      <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-md transition">
        <i data-lucide="save" class="inline w-4 h-4 mr-1"></i> Simpan
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    if (window.lucide) lucide.createIcons();

    const badgeColorInput = document.getElementById('badge_color');
    const badgeColorText = document.getElementById('badge_color_text');
    if (badgeColorInput && badgeColorText) {
      badgeColorInput.addEventListener('input', (e) => {
        badgeColorText.value = e.target.value;
      });
    }

    const iconColorInput = document.getElementById('icon_color');
    const iconColorText = document.getElementById('icon_color_text');
    if (iconColorInput && iconColorText) {
      iconColorInput.addEventListener('input', (e) => {
        iconColorText.value = e.target.value;
      });
    }

  });
</script>
@endsection
