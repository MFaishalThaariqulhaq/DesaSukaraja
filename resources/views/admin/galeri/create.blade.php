@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-slate-800">Tambah Galeri</h2>
    <a href="{{ route('admin.galeri.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
    </a>
  </div>

  <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
      <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">Judul Galeri *</label>
      <input type="text" name="judul" id="judul"
        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
        placeholder="Masukkan judul galeri" value="{{ old('judul') }}" required>
      @error('judul')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori *</label>
        <select name="kategori" id="kategori"
          class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
          required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
          <option value="Alam & Wisata" {{ old('kategori') == 'Alam & Wisata' ? 'selected' : '' }}>Alam & Wisata</option>
          <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
        </select>
        @error('kategori')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
      </div>

      <div>
        <label for="gambar" class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar *</label>
        <input type="file" name="gambar" id="gambar" accept="image/*"
          class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
          onchange="previewImage(event)" required>
        @error('gambar')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
      </div>
    </div>

    <div id="previewContainer" class="hidden">
      <label class="block text-sm font-medium text-slate-700 mb-2">Pratinjau Gambar:</label>
      <img id="previewImage" class="max-h-64 rounded-lg shadow-md border border-slate-200 object-cover">
    </div>

    <div>
      <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" rows="4"
        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
        placeholder="Tulis deskripsi singkat tentang foto ini...">{{ old('deskripsi') }}</textarea>
      @error('deskripsi')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <div class="mt-8 border-t pt-6 flex justify-end gap-3">
      <a href="{{ route('admin.galeri.index') }}"
        class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-700 font-medium hover:bg-slate-50 transition duration-200">
        Batal
      </a>
      <button type="submit"
        class="bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:bg-emerald-700 transform hover:scale-105 transition-all duration-300">
        Simpan Galeri
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();
  });

  function previewImage(event) {
    const preview = document.getElementById('previewImage');
    const container = document.getElementById('previewContainer');
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        container.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    } else {
      container.classList.add('hidden');
    }
  }
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