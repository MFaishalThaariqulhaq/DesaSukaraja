@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-lg shadow-md">

  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Edit Berita</h2>
    <a href="{{ route('admin.berita.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 transition-colors flex items-center">
      <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
      Kembali ke Daftar Berita
    </a>
  </div>

  <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="space-y-6">
      <div>
        <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">Judul Berita</label>
        <input type="text" name="judul" id="judul"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition"
          value="{{ $berita->judul }}" required>
      </div>
      <div>
        <label for="isi" class="block text-sm font-medium text-slate-700 mb-1">Isi Berita</label>
        <textarea name="isi" id="isi"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition"
          rows="10" required>{{ $berita->isi }}</textarea>
      </div>
      <div>
        <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
        <select name="kategori" id="kategori"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition" required>
          <option value="">Pilih Kategori</option>
          <option value="Lingkungan" {{ $berita->kategori === 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
          <option value="Ekonomi" {{ $berita->kategori === 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
          <option value="Kesehatan" {{ $berita->kategori === 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
          <option value="Pendidikan" {{ $berita->kategori === 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
          <option value="Infrastruktur" {{ $berita->kategori === 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
          <option value="Umum" {{ $berita->kategori === 'Umum' ? 'selected' : '' }}>Umum</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar (Opsional)</label>
        @php
          $placeholderBerita = 'https://placehold.co/800x450?text=Gambar+Berita';
          $currentBeritaImage = $berita->gambar ? asset('storage/' . $berita->gambar) : $placeholderBerita;
        @endphp
        <div class="group relative rounded-xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 transition aspect-video max-w-xl"
          data-image-card
          data-input-id="gambar"
          data-remove-input-id="remove_gambar"
          data-remove-confirm="Hapus gambar berita saat ini?">
          <img
            data-image-preview
            src="{{ $currentBeritaImage }}"
            data-placeholder="{{ $placeholderBerita }}"
            alt="Gambar Berita"
            class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-3">
            <button type="button" data-image-edit class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 shadow">
              <i data-lucide="pencil" class="w-4 h-4"></i>
            </button>
            @if($berita->gambar)
            <button type="button" data-image-remove class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 hover:bg-red-50 hover:text-red-700 shadow">
              <i data-lucide="trash-2" class="w-4 h-4"></i>
            </button>
            @endif
          </div>
        </div>
        <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*">
        <input type="checkbox" name="remove_gambar" id="remove_gambar" value="1" class="hidden">
        <p class="text-xs text-slate-500 mt-2">Arahkan kursor ke gambar untuk Edit/Hapus.</p>
      </div>
    </div>

    <div class="mt-8 border-t pt-6 flex justify-end">
      <button type="submit"
        class="inline-flex items-center gap-2 bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:bg-emerald-700 transition">
        <i data-lucide="save" class="w-4 h-4"></i>
        Update Berita
      </button>
    </div>
  </form>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    if (window.lucide) {
      lucide.createIcons();
    }
  });
</script>
@endsection
