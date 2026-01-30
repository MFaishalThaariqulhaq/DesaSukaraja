@extends('admin.dashboard')
@section('content')
<h2 class="text-xl font-bold mb-4">Edit SOTK</h2>
<form action="{{ route('admin.sotk.update', $sotk->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="mb-4">
    <label for="nama" class="block">Nama</label>
    <input type="text" name="nama" id="nama" class="border rounded w-full p-2" value="{{ $sotk->nama }}" required>
  </div>
  <div class="mb-4">
    <label for="jabatan" class="block">Jabatan</label>
    <input type="text" name="jabatan" id="jabatan" class="border rounded w-full p-2" value="{{ $sotk->jabatan }}" required>
  </div>
  <div class="mb-4">
    <label for="foto" class="block">Foto (gambar)</label>
    <input type="file" name="foto" id="foto" class="border rounded w-full p-2" accept="image/*">
    @if($sotk->foto)
    <div class="mt-2">
      <img src="{{ asset('storage/' . $sotk->foto) }}" alt="Foto" class="w-32 h-32 object-cover rounded shadow">
    </div>
    @endif
  </div>
  <div class="mb-4">
    <label for="tupoksi" class="block">Tupoksi (Tugas Pokok dan Fungsi)</label>
    <textarea name="tupoksi" id="tupoksi" rows="4" class="border rounded w-full p-2">{{ $sotk->tupoksi }}</textarea>
  </div>
  <div class="flex gap-3 mt-4">
    <button type="submit" class="inline-flex items-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition transform hover:-translate-y-0.5 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-300">
      <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
      Update
    </button>
    <a href="{{ route('admin.sotk.index') }}" class="inline-flex items-center bg-slate-100 text-slate-800 px-4 py-2 rounded-lg hover:bg-slate-200 transition transform hover:-translate-y-0.5 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-slate-200">
      <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
      Kembali
    </a>
  </div>
</form>
@endsection