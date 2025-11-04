{{-- Form Pengaduan Masyarakat --}}
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Pengaduan Masyarakat Desa Sukaraja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen">
  <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeInUp w-full max-w-md mx-4">
    @csrf
    <h2 class="text-2xl font-bold mb-6 text-center">Form Pengaduan</h2>
    <div class="mb-4">
      <label for="nama" class="block mb-1">Nama</label>
      <input type="text" name="nama" id="nama" class="border rounded w-full p-2" required>
    </div>
    <div class="mb-4">
      <label for="telepon" class="block mb-1">Nomor Telepon (opsional)</label>
      <input type="text" name="telepon" id="telepon" class="border rounded w-full p-2">
    </div>
    <div class="mb-4">
      <label for="kategori" class="block mb-1">Kategori (opsional)</label>
      <select name="kategori" id="kategori" class="border rounded w-full p-2">
        <option value="">-- Pilih Kategori --</option>
        <option value="Infrastruktur">Infrastruktur</option>
        <option value="Kebersihan">Kebersihan</option>
        <option value="Pelayanan">Pelayanan</option>
        <option value="Keamanan">Keamanan</option>
        <option value="Lainnya">Lainnya</option>
      </select>
    </div>
    <div class="mb-4">
      <label for="judul" class="block mb-1">Judul Singkat (opsional)</label>
      <input type="text" name="judul" id="judul" class="border rounded w-full p-2">
    </div>
    <div class="mb-4">
      <label for="email" class="block mb-1">Email</label>
      <input type="email" name="email" id="email" class="border rounded w-full p-2" required>
    </div>
    <div class="mb-4">
      <label for="isi" class="block mb-1">Isi Pengaduan</label>
      <textarea name="isi" id="isi" class="border rounded w-full p-2" rows="5" required></textarea>
    </div>
    <div class="mb-4">
      <label for="lampiran" class="block mb-1">Lampiran (foto/pdf/video, opsional)</label>
      <input type="file" name="lampiran" id="lampiran" accept="image/*,video/*,.pdf" class="w-full">
    </div>
    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
    @endif
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded w-full">Kirim</button>
  </form>
  <style>
    @media (prefers-reduced-motion: reduce) {
      form.animate-fadeInUp {
        animation: none !important;
      }
    }
  </style>
</body>

</html>