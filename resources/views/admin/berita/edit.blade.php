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
        <label for="gambar" class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar (Opsional)</label>
        <input type="file" name="gambar" id="gambar"
          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition">
        @if($berita->gambar)
        <div class="mt-2">
          <span class="text-xs text-slate-500">Gambar saat ini:</span><br>
          <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="h-32 rounded shadow mt-1">
        </div>
        @endif
      </div>
    </div>

    <div class="mt-8 border-t pt-6 flex justify-end">
      <button type="submit"
        class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition-transform duration-300 hover:scale-105">
        Update Berita
      </button>
    </div>
  </form>
</div>
@endsection