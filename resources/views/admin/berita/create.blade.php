@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-lg shadow-md">

  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Tambah Berita Baru</h2>
    <a href="{{ route('admin.berita.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
    </a>
  </div>

  <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="space-y-6">
      <div>
        <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">Judul Berita</label>
        <input type="text" name="judul" id="judul"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition"
          placeholder="Masukkan judul berita" required>
      </div>
      <div>
        <label for="isi" class="block text-sm font-medium text-slate-700 mb-1">Isi Berita</label>
        <textarea name="isi" id="isi"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition"
          rows="10" placeholder="Tuliskan isi lengkap berita di sini..." required></textarea>
      </div>
      <div>
        <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
        <select name="kategori" id="kategori"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition" required>
          <option value="">Pilih Kategori</option>
          <option value="Lingkungan">Lingkungan</option>
          <option value="Ekonomi">Ekonomi</option>
          <option value="Kesehatan">Kesehatan</option>
          <option value="Pendidikan">Pendidikan</option>
          <option value="Infrastruktur">Infrastruktur</option>
          <option value="Umum">Umum</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar (Opsional)</label>
        @php $placeholderBerita = 'https://placehold.co/800x450?text=Gambar+Berita'; @endphp
        <div class="group relative rounded-xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 transition aspect-video max-w-xl" data-image-card data-input-id="gambar">
          <img
            data-image-preview
            src="{{ $placeholderBerita }}"
            data-placeholder="{{ $placeholderBerita }}"
            alt="Gambar Berita"
            class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
            <button type="button" data-image-edit class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 shadow">
              <i data-lucide="pencil" class="w-4 h-4"></i>
            </button>
          </div>
        </div>
        <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*">
        <p class="text-xs text-slate-500 mt-2">Arahkan kursor ke gambar untuk memilih file.</p>
      </div>
    </div>

    <div class="mt-8 border-t pt-6 flex justify-end">
      <button type="submit"
        class="inline-flex items-center gap-2 bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:bg-emerald-700 transition">
        <i data-lucide="save" class="w-4 h-4"></i>
        Simpan Berita
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
