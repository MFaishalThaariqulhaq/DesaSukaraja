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
        <label for="gambar" class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar (Opsional)</label>
        <input type="file" name="gambar" id="gambar"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition">
      </div>
    </div>

    <div class="mt-8 border-t pt-6 flex justify-end">
      <button type="submit"
        class="bg-emerald-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-emerald-600 transition-transform duration-300 hover:scale-105">
        Simpan Berita
      </button>
    </div>
  </form>
</div>
@endsection