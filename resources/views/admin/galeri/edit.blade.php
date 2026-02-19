@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-slate-800">Edit Galeri</h2>
    <a href="{{ route('admin.galeri.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
    </a>
  </div>

  <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">Judul Galeri *</label>
        <input type="text" name="judul" id="judul"
          class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
          value="{{ old('judul', $galeri->judul) }}" required>
        @error('judul')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
      </div>

      <div>
        <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori *</label>
        <select name="kategori" id="kategori"
          class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
          required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Kegiatan" {{ old('kategori', $galeri->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
          <option value="Alam & Wisata" {{ old('kategori', $galeri->kategori) == 'Alam & Wisata' ? 'selected' : '' }}>Alam & Wisata</option>
          <option value="Pembangunan" {{ old('kategori', $galeri->kategori) == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
        </select>
        @error('kategori')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
      </div>
    </div>

    <div>
      <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" rows="4"
        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
        placeholder="Tuliskan deskripsi singkat...">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
      @error('deskripsi')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar</label>
      @php
        $placeholderGaleri = 'https://placehold.co/800x450?text=Gambar+Galeri';
        $currentGaleriImage = $galeri->gambar ? asset('storage/' . $galeri->gambar) : $placeholderGaleri;
      @endphp
      <div class="group relative rounded-xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 transition aspect-video"
        data-image-card
        data-input-id="gambar"
        data-remove-input-id="remove_gambar"
        data-remove-confirm="Hapus gambar galeri saat ini?">
        <img
          data-image-preview
          src="{{ $currentGaleriImage }}"
          data-placeholder="{{ $placeholderGaleri }}"
          alt="Gambar Galeri"
          class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-3">
          <button type="button" data-image-edit class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 shadow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
          </button>
          @if($galeri->gambar)
          <button type="button" data-image-remove class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 hover:bg-red-50 hover:text-red-700 shadow">
            <i data-lucide="trash-2" class="w-4 h-4"></i>
          </button>
          @endif
        </div>
      </div>
      <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*">
      @error('gambar')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
      <input type="checkbox" name="remove_gambar" id="remove_gambar" value="1" class="hidden">
      <p class="text-xs text-slate-500 mt-2">Arahkan kursor ke gambar untuk Edit/Hapus.</p>
    </div>

    <div class="mt-8 border-t pt-6 flex justify-end gap-3">
      <a href="{{ route('admin.galeri.index') }}"
        class="bg-slate-500 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:bg-slate-600 transform hover:scale-105 transition-all duration-300">
        Batal
      </a>
      <button type="submit"
        class="bg-blue-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:bg-blue-700 transform hover:scale-105 transition-all duration-300">
        Update Galeri
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    if (window.lucide) lucide.createIcons();
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
