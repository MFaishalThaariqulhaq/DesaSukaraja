{{-- Form Pengaduan Masyarakat --}}
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Pengaduan Masyarakat Desa Sukaraja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
  <meta name="recaptcha-key" content="{{ config('services.recaptcha.site_key') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen">
  <form id="pengaduanForm" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeInUp w-full max-w-md mx-4">
    @csrf
    <h2 class="text-2xl font-bold mb-2 text-center">Form Pengaduan</h2>
    <p class="text-center text-gray-600 text-sm mb-6">Sampaikan keluhan atau masukan Anda</p>
    
    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg text-sm">
      ✓ {{ session('success') }}
      <br>
      <small class="mt-2 block">Cek email Anda untuk detail lebih lanjut</small>
    </div>
    @endif

    @if($errors->has('captcha'))
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg text-sm">
      ✗ {{ $errors->first('captcha') }}
    </div>
    @endif
    
    <div class="mb-4">
      <label for="nama" class="block mb-1 font-medium text-sm">Nama</label>
      <input type="text" name="nama" id="nama" class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:border-emerald-500" value="{{ old('nama') }}">
      @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="email" class="block mb-1 font-medium text-sm">Email <span class="text-red-500">*</span></label>
      <input type="email" name="email" id="email" class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:border-emerald-500" required value="{{ old('email') }}">
      @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    
    <div class="mb-4">
      <label for="telepon" class="block mb-1 font-medium text-sm">Nomor Telepon (opsional)</label>
      <input type="text" name="telepon" id="telepon" class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:border-emerald-500" value="{{ old('telepon') }}">
    </div>
    
    <div class="mb-4">
      <label for="kategori" class="block mb-1 font-medium text-sm">Kategori (opsional)</label>
      <select name="kategori" id="kategori" class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:border-emerald-500">
        <option value="">-- Pilih Kategori --</option>
        <option value="Infrastruktur" {{ old('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
        <option value="Kebersihan" {{ old('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
        <option value="Pelayanan" {{ old('kategori') == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option>
        <option value="Keamanan" {{ old('kategori') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
        <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
      </select>
    </div>
    
    <div class="mb-4">
      <label for="judul" class="block mb-1 font-medium text-sm">Judul Singkat (opsional)</label>
      <input type="text" name="judul" id="judul" class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:border-emerald-500" value="{{ old('judul') }}">
    </div>
    
    <div class="mb-4">
      <label for="isi" class="block mb-1 font-medium text-sm">Isi Pengaduan <span class="text-red-500">*</span></label>
      <textarea name="isi" id="isi" class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:border-emerald-500" rows="5" required>{{ old('isi') }}</textarea>
      @error('isi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    
    <div class="mb-4">
      <label for="lampiran" class="block mb-1 font-medium text-sm">Lampiran (foto/pdf/video, maks 5MB)</label>
      <input type="file" name="lampiran" id="lampiran" accept="image/*,video/*,.pdf" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-emerald-500">
      @error('lampiran') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Hidden field untuk reCAPTCHA token -->
    <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">
    
    <div class="mb-4 text-center text-xs text-gray-500">
      <p>🔐 Dilindungi oleh reCAPTCHA</p>
    </div>
    
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded w-full font-semibold transition-colors">Kirim Pengaduan</button>
  </form>

  <!-- Hidden field untuk reCAPTCHA token -->
  <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">
</body>

</html>