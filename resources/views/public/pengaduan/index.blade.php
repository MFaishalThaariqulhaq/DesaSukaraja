@extends('layouts.public.layout')

@push('styles')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<meta name="recaptcha-key" content="{{ config('services.recaptcha.site_key') }}">
@endpush

@section('content')
<section id="pengaduan" class="pg-shell relative py-24 min-h-screen overflow-hidden">
  <!-- Background Decorations (Blobs) -->
  <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
    <div class="absolute -top-[20%] -right-[10%] w-[50rem] h-[50rem] bg-emerald-100/60 rounded-full blur-[120px] mix-blend-multiply"></div>
    <div class="absolute top-[40%] -left-[10%] w-[40rem] h-[40rem] bg-blue-100/60 rounded-full blur-[100px] mix-blend-multiply"></div>
  </div>

  <div class="container mx-auto px-4 md:px-6 relative z-10">
    <!-- Header Section -->
    <div class="text-center mb-16" data-pg-reveal>
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-slate-200 shadow-sm text-emerald-600 text-xs font-bold tracking-widest uppercase mb-4">
        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
        Pusat Aspirasi Desa
      </div>
      <h1 class="ui-heading text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-4 tracking-tight">
        Layanan <span class="text-emerald-700">Pengaduan Online</span>
      </h1>
      <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
        Suara Anda sangat berharga. Sampaikan kritik, saran, atau laporan kejadian untuk membangun desa yang lebih baik.
      </p>
    </div>

    <!-- Main Content Grid -->
    <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-start">

      <!-- Left Column: Form (8 Columns) -->
      <div class="lg:col-span-8" data-pg-reveal>
        <div class="pg-panel rounded-3xl overflow-hidden relative">

          <!-- Decorative Top Bar -->
          <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-400 to-emerald-500"></div>

          <div class="p-8 md:p-10">
            <div class="flex items-center gap-4 mb-8">
              <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl shadow-sm border border-emerald-100">
                <i data-lucide="pen-tool" class="w-6 h-6"></i>
              </div>
              <div>
                <h2 class="text-2xl font-bold text-slate-900">Formulir Laporan</h2>
                <p class="text-sm text-slate-500">Isi data di bawah ini dengan lengkap dan benar.</p>
              </div>
            </div>

            @if(session('success'))
              <div class="pg-alert bg-gradient-to-r from-green-50 to-emerald-50 border-green-200 text-green-700 p-4 mb-6 flex items-start gap-3" data-pg-reveal>
                <i data-lucide="check-circle-2" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                <div>
                  <p class="font-semibold">Pengaduan Berhasil Dikirim!</p>
                  <small class="block mt-1">{{ session('success') }}<br>Silakan cek email Anda untuk konfirmasi</small>
                </div>
              </div>
            @endif

            @if($errors->has('captcha'))
              <div class="pg-alert bg-red-50 border-red-200 text-red-700 p-4 mb-6 flex items-start gap-3" data-pg-reveal>
                <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                <div>
                  <p class="font-semibold">Verifikasi Gagal</p>
                  <small class="block mt-1">{{ $errors->first('captcha') }}</small>
                </div>
              </div>
            @endif

            <form id="pengaduanForm" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
              @csrf

              <!-- Grid 2 Kolom untuk Data Diri -->
              <div class="grid md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div class="group">
                  <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-emerald-600 transition-colors">
                    Nama Lengkap <span class="text-rose-500">*</span>
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                      <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <input 
                      type="text" 
                      name="nama" 
                      id="nama" 
                      class="pg-input block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition-all duration-200"
                      placeholder="Nama sesuai KTP"
                      required 
                      value="{{ old('nama') }}">
                  </div>
                  @error('nama') 
                    <span class="text-red-500 text-sm mt-1 block flex items-center gap-1">
                      <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $message }}
                    </span>
                  @enderror
                </div>

                <!-- Email -->
                <div class="group">
                  <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-emerald-600 transition-colors">
                    Email <span class="text-rose-500">*</span>
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                      <i data-lucide="mail" class="w-5 h-5"></i>
                    </div>
                    <input 
                      type="email" 
                      name="email" 
                      id="email" 
                      class="pg-input block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition-all duration-200"
                      placeholder="contoh@email.com"
                      required 
                      value="{{ old('email') }}">
                  </div>
                  @error('email') 
                    <span class="text-red-500 text-sm mt-1 block flex items-center gap-1">
                      <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $message }}
                    </span>
                  @enderror
                </div>
              </div>

              <!-- Grid 2 Kolom untuk Kontak & Kategori -->
              <div class="grid md:grid-cols-2 gap-6">
                <!-- Telepon (Opsional) -->
                <div class="group">
                  <label for="telepon" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-emerald-600 transition-colors">
                    Nomor Telepon <span class="text-slate-400 font-normal text-xs">(Opsional)</span>
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                      <i data-lucide="phone" class="w-5 h-5"></i>
                    </div>
                    <input 
                      type="text" 
                      name="telepon" 
                      id="telepon" 
                      class="pg-input block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition-all duration-200"
                      placeholder="0812xxxx"
                      value="{{ old('telepon') }}">
                  </div>
                </div>

                <!-- Kategori -->
                <div class="group">
                  <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-emerald-600 transition-colors">
                    Kategori Laporan
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                      <i data-lucide="tag" class="w-5 h-5"></i>
                    </div>
                    <select 
                      name="kategori" 
                      id="kategori" 
                      class="pg-input block w-full pl-11 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition-all duration-200 appearance-none cursor-pointer">
                      <option value="">-- Pilih Kategori --</option>
                      <option value="Infrastruktur" {{ old('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                      <option value="Kebersihan" {{ old('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                      <option value="Pelayanan" {{ old('kategori') == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                      <option value="Keamanan" {{ old('kategori') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                      <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                      <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                      <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                      <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Judul (Opsional) -->
              <div class="group">
                <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-emerald-600 transition-colors">
                  Judul Singkat <span class="text-slate-400 font-normal text-xs">(Opsional)</span>
                </label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                    <i data-lucide="type" class="w-5 h-5"></i>
                  </div>
                  <input 
                    type="text" 
                    name="judul" 
                    id="judul" 
                    class="pg-input block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition-all duration-200"
                    placeholder="Contoh: Jalan Berlubang di RT 01"
                    value="{{ old('judul') }}">
                </div>
              </div>

              <!-- Isi Pengaduan -->
              <div class="group">
                <label for="isi" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-emerald-600 transition-colors">
                  Isi Laporan <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                  <div class="absolute top-3.5 left-3.5 pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                    <i data-lucide="align-left" class="w-5 h-5"></i>
                  </div>
                  <textarea 
                    name="isi" 
                    id="isi" 
                    rows="5"
                    class="pg-input block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition-all duration-200 resize-none"
                    placeholder="Jelaskan kronologi, lokasi, dan detail masalah secara lengkap..."
                    required>{{ old('isi') }}</textarea>
                </div>
                @error('isi') 
                  <span class="text-red-500 text-sm mt-1 block flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $message }}
                  </span>
                @enderror
              </div>

              <!-- Custom File Input -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                  Lampiran Bukti <span class="text-slate-400 font-normal text-xs">(Foto/Video/PDF, Max 5MB)</span>
                </label>
                <div class="relative group w-full">
                  <input type="file" id="lampiran" name="lampiran" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="updateFileName(this)">

                  <div class="pg-index-dropzone border-2 border-dashed border-slate-300 rounded-xl p-6 flex flex-col items-center justify-center text-center transition-all duration-300 group-hover:border-emerald-400 group-hover:bg-emerald-50 bg-slate-50">
                    <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                      <i data-lucide="upload-cloud" class="w-6 h-6 text-emerald-500"></i>
                    </div>
                    <p id="file-label" class="text-sm font-medium text-slate-700">Klik untuk unggah atau seret file ke sini</p>
                    <p class="text-xs text-slate-400 mt-1">Dukung format: JPG, PNG, MP4, PDF</p>
                  </div>
                </div>
              </div>

              <!-- Footer Form -->
              <div class="pt-4 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-400 flex items-center gap-1.5 bg-slate-50 px-3 py-1.5 rounded-lg">
                  <i data-lucide="shield" class="w-3 h-3"></i>
                  Dilindungi reCAPTCHA
                </div>

                <!-- reCAPTCHA Token (Hidden) -->
                <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">

                <button 
                  type="submit" 
                  id="submitBtn"
                  class="pg-button w-full md:w-auto px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transform transition-all duration-200 hover:-translate-y-1 hover:shadow-xl flex items-center justify-center gap-2 group"
                  aria-label="Kirim pengaduan">
                  <span>Kirim Laporan</span>
                  <i data-lucide="send" class="w-4 h-4 transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                </button>
              </div>

              <!-- reCAPTCHA Notice -->
              <p class="text-xs text-slate-500 text-center">
                Situs ini dilindungi oleh reCAPTCHA dan berlaku <a href="https://policies.google.com/privacy" class="text-emerald-600 hover:underline">Kebijakan Privasi</a> serta <a href="https://policies.google.com/terms" class="text-emerald-600 hover:underline">Syarat Layanan</a> Google.
              </p>
            </form>
          </div>
        </div>
      </div>

      <!-- Right Column: Info Cards (4 Columns) -->
      <div class="lg:col-span-4 space-y-6" data-pg-reveal>

        <!-- Info Card 1 -->
        <div class="pg-card p-6 group" data-pg-reveal>
          <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
            <i data-lucide="clock" class="w-6 h-6"></i>
          </div>
          <h3 class="ui-heading text-xl font-bold text-slate-900 mb-2">Respon Cepat</h3>
          <p class="text-sm text-slate-600 leading-relaxed">
            Laporan Anda akan diverifikasi dan ditindaklanjuti oleh petugas dalam waktu maksimal <strong>3x24 jam</strong> kerja.
          </p>
        </div>

        <!-- Info Card 2 -->
        <div class="pg-card p-6 group" data-pg-reveal>
          <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
            <i data-lucide="lock" class="w-6 h-6"></i>
          </div>
          <h3 class="ui-heading text-xl font-bold text-slate-900 mb-2">Privasi Terjaga</h3>
          <p class="text-sm text-slate-600 leading-relaxed">
            Identitas pelapor dapat disamarkan jika bersifat sensitif. Kami menjunjung tinggi asas kerahasiaan.
          </p>
        </div>

        <!-- Info Card 3 -->
        <div class="pg-card p-6 group" data-pg-reveal>
          <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
            <i data-lucide="file-check" class="w-6 h-6"></i>
          </div>
          <h3 class="ui-heading text-xl font-bold text-slate-900 mb-2">Transparansi</h3>
          <p class="text-sm text-slate-600 leading-relaxed">
            Anda dapat memantau perkembangan status laporan Anda melalui fitur Cek Status Pengaduan.
          </p>
        </div>

        <!-- Check Status CTA -->
        <div class="pg-card mt-8 p-8 text-center relative overflow-hidden group" data-pg-reveal>
          <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-100/60 rounded-full blur-2xl -mr-16 -mt-16 group-hover:bg-emerald-200/70 transition-colors duration-300"></div>

          <i data-lucide="search" class="w-10 h-10 mx-auto mb-4 text-emerald-600"></i>
          <h3 class="ui-heading text-2xl font-bold text-slate-900 mb-2">Sudah Melapor?</h3>
          <p class="text-slate-600 text-sm mb-6">Pantau progres laporan Anda di sini.</p>

          <a href="{{ route('pengaduan.status') }}" class="pg-link inline-flex items-center justify-center w-full px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold border border-emerald-700 transition-all duration-300">
            Cek Status Laporan
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
