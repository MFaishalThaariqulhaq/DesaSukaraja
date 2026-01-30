@extends('admin.dashboard')

@section('content')
<!-- Success Notification -->
@if(session('success'))
<div id="success-alert" class="fixed top-4 right-4 bg-emerald-50 border border-emerald-300 rounded-lg shadow-2xl p-4 flex items-center gap-4 z-50 min-w-[350px]" style="animation: slideIn 0.5s ease; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);">
  <div class="shrink-0">
    <svg class="h-6 w-6 text-emerald-600" style="animation: bounce 1s infinite;" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
    </svg>
  </div>
  <div class="flex-1">
    <p class="text-sm font-semibold text-emerald-900">{{ session('success') }}</p>
    <p class="text-xs text-emerald-700 mt-0.5">Perubahan telah berhasil disimpan</p>
  </div>
  <button onclick="closeAlert()" class="text-emerald-400 hover:text-emerald-600 shrink-0">
    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
    </svg>
  </button>
</div>
<style>
  @keyframes slideIn {
    from {
      transform: translateX(400px);
      opacity: 0;
    }

    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes bounce {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-5px);
    }
  }
</style>
<script>
  function closeAlert() {
    const alert = document.getElementById('success-alert');
    if (alert) {
      alert.style.animation = 'slideIn 0.5s ease reverse';
      setTimeout(() => alert.remove(), 500);
    }
  }
  setTimeout(function() {
    const alert = document.getElementById('success-alert');
    if (alert) {
      closeAlert();
    }
  }, 4000);
</script>
@endif

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-slate-800">Manajemen Profil Desa</h1>
      <p class="text-slate-500 text-sm mt-1">Kelola identitas, visi misi, sejarah, dan struktur organisasi.</p>
    </div>
    <div>
      <a href="/profil" target="_blank" class="bg-white border border-slate-300 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-50 transition flex items-center gap-2">
        <i data-lucide="external-link" class="w-4 h-4"></i> Lihat Website
      </a>
    </div>
  </div>
  <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden min-h-[600px]">
    <div class="flex border-b border-slate-200 overflow-x-auto bg-slate-50/50">
      <button onclick="switchTab('beranda')" id="btn-beranda" class="tab-btn active-tab px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
        <i data-lucide="image" class="w-4 h-4"></i> Profil Beranda
      </button>
      <button onclick="switchTab('umum')" id="btn-umum" class="tab-btn px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
        <i data-lucide="home" class="w-4 h-4"></i> Identitas Umum
      </button>
      <button onclick="switchTab('visimisi')" id="btn-visimisi" class="tab-btn px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
        <i data-lucide="target" class="w-4 h-4"></i> Visi & Misi
      </button>
      <button onclick="switchTab('sejarah')" id="btn-sejarah" class="tab-btn px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
        <i data-lucide="history" class="w-4 h-4"></i> Sejarah (Timeline)
      </button>
      <button onclick="switchTab('struktur')" id="btn-struktur" class="tab-btn px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
        <i data-lucide="users" class="w-4 h-4"></i> Struktur Organisasi
      </button>
    </div>
    <div class="p-6 md:p-8">
      {{-- TAB PROFIL BERANDA --}}
      <div id="tab-beranda" class="tab-content block animate-fade-in">
        @if(isset($profil) && $profil)
        <form action="{{ route('admin.profil.update', $profil->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Simpan perubahan profil beranda?')">
          @csrf
          @method('PUT')
          <div class="space-y-6">
            <div>
              <label class="block text-slate-700 font-bold mb-3">Gambar Profil Desa</label>
              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <div class="relative group rounded-xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 hover:bg-slate-100 transition aspect-video flex items-center justify-center mb-2 cursor-pointer">
                    <img id="preview-gambar-profil" src="{{ $profil->gambar ? asset('storage/' . $profil->gambar) : 'https://placehold.co/800x500?text=Gambar+Profil' }}" alt="Gambar Profil" class="object-cover w-full h-full">
                  </div>
                  <input type="file" name="gambar" id="gambar" class="w-full px-4 py-2 border rounded-lg" accept="image/*">
                  <p class="text-xs text-slate-400 mt-2">Ukuran: 800x500px atau lebih</p>
                </div>
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Judul Profil Desa</label>
                  <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" class="w-full px-4 py-2 border rounded-lg" placeholder="Profil Desa Sukaraja">
                </div>
              </div>
            </div>

            <div>
              <label class="block text-slate-700 font-bold mb-2">Deskripsi Lengkap Profil Desa</label>
              <textarea name="deskripsi_profil" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="Tuliskan deskripsi lengkap tentang Desa Sukaraja...">{{ old('deskripsi_profil', $profil->deskripsi_profil) }}</textarea>
            </div>

            <div>
              <label class="block text-slate-700 font-bold mb-2">Motto/Semboyan Desa</label>
              <textarea name="motto_profil" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none italic" placeholder="Contoh: Dengan semangat gotong royong, kami membangun infrastruktur...">{{ old('motto_profil', $profil->motto_profil) }}</textarea>
            </div>
          </div>

          <div class="pt-6 border-t border-slate-100 flex justify-end">
            <button type="submit" class="bg-emerald-600 text-white px-8 py-2.5 rounded-lg hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition font-semibold flex items-center gap-2">
              <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
            </button>
          </div>
        </form>
        @else
        <div class="text-slate-500">Belum ada data profil desa.</div>
        @endif
      </div>

      {{-- TAB IDENTITAS UMUM --}}
      <div id="tab-umum" class="tab-content hidden animate-fade-in">
        @if(isset($profil) && $profil)
        <form action="{{ route('admin.profil.update', $profil->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Simpan perubahan profil?')">
          @csrf
          @method('PUT')
          <div class="grid md:grid-cols-12 gap-8">
            <div class="md:col-span-4 lg:col-span-3">
              <label class="block text-slate-700 font-bold mb-2">Foto Kepala Desa</label>
              <div class="group relative rounded-xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 hover:bg-slate-100 transition aspect-3/4 flex items-center justify-center mb-2">
                <img id="preview-foto-kades" src="{{ $profil->foto_kades ? asset('storage/' . $profil->foto_kades) : 'https://placehold.co/300x400?text=Foto+Kades' }}" alt="Kepala Desa" class="object-cover w-full h-full cursor-pointer">
              </div>
              <input type="file" name="foto_kades" id="foto_kades" class="w-full px-4 py-2 border rounded-lg" accept="image/*">


              <!-- Modal Cropper -->
              <div id="modal-cropper" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center" style="display: none;">
                <div class="bg-white rounded-lg p-6 shadow-xl max-w-lg w-full relative">
                  <h3 class="font-bold mb-4">Atur & Crop Foto Kepala Desa</h3>
                  <div><img id="image-cropper" src="" class="max-h-96 mx-auto"></div>
                  <div class="flex justify-end gap-2 mt-4">
                    <button type="button" id="btn-crop-cancel" class="px-4 py-2 rounded bg-slate-200 hover:bg-slate-300">Batal</button>
                    <button type="button" id="btn-crop-apply" class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Simpan Crop</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="md:col-span-8 lg:col-span-9 space-y-5">
              <div class="grid md:grid-cols-2 gap-5">
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Nama Kepala Desa</label>
                  <input type="text" name="nama_kades" id="nama_kades" value="{{ old('nama_kades', $profil->nama_kades) }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Periode Jabatan</label>
                  <input type="text" name="periode_kades" id="periode_kades" value="{{ old('periode_kades', $profil->periode_kades) }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
              </div>
              <div class="grid md:grid-cols-2 gap-5">
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Judul Sambutan Kepala Desa</label>
                  <input type="text" name="judul_sambutan_kades" id="judul_sambutan_kades" value="{{ old('judul_sambutan_kades', $profil->judul_sambutan_kades) }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Isi Sambutan Kepala Desa</label>
                  <textarea name="isi_sambutan_kades" id="isi_sambutan_kades" rows="6" class="w-full px-4 py-2 border rounded-lg" required>{{ old('isi_sambutan_kades', $profil->isi_sambutan_kades) }}</textarea>
                </div>
              </div>
              <div>
                <label class="block text-slate-700 font-bold mb-2">Tanda Tangan Kepala Desa</label>
                @if($profil->ttd_kades)
                <img src="{{ asset('storage/' . $profil->ttd_kades) }}" alt="Tanda Tangan" class="h-12 mb-2">
                @endif
                <input type="file" name="ttd_kades" id="ttd_kades" class="w-full px-4 py-2 border rounded-lg">
              </div>

            </div>
          </div>
          <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="bg-emerald-600 text-white px-8 py-2.5 rounded-lg hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition font-semibold flex items-center gap-2">
              <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
            </button>
          </div>
        </form>
        @else
        <div class="text-slate-500 mb-4">Belum ada data profil desa. Silakan lengkapi data di bawah ini:</div>
        <form action="{{ route('admin.profil.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="grid md:grid-cols-12 gap-8">
            <div class="md:col-span-4 lg:col-span-3">
              <label class="block text-slate-700 font-bold mb-2">Foto Kepala Desa</label>
              <input type="file" name="foto_kades" class="w-full px-4 py-2 border rounded-lg" accept="image/*">
            </div>
            <div class="md:col-span-8 lg:col-span-9 space-y-5">
              <div class="grid md:grid-cols-2 gap-5">
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Nama Kepala Desa</label>
                  <input type="text" name="nama_kades" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Periode Jabatan</label>
                  <input type="text" name="periode_kades" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
              </div>
              <div class="grid md:grid-cols-2 gap-5">
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Judul Sambutan Kepala Desa</label>
                  <input type="text" name="judul_sambutan_kades" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div>
                  <label class="block text-slate-700 font-bold mb-2">Isi Sambutan Kepala Desa</label>
                  <textarea name="isi_sambutan_kades" rows="6" class="w-full px-4 py-2 border rounded-lg" required></textarea>
                </div>
              </div>
              <div>
                <label class="block text-slate-700 font-bold mb-2">Tanda Tangan Kepala Desa</label>
                <input type="file" name="ttd_kades" class="w-full px-4 py-2 border rounded-lg">
              </div>
            </div>
          </div>
          <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="bg-emerald-600 text-white px-8 py-2.5 rounded-lg hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition font-semibold flex items-center gap-2">
              <i data-lucide="save" class="w-4 h-4"></i> Simpan Profil
            </button>
          </div>
        </form>
        @endif
      </div>

      {{-- TAB VISI & MISI --}}
      <div id="tab-visimisi" class="tab-content hidden animate-fade-in">
        @if(isset($profil) && $profil)
        <form action="{{ route('admin.profil.update', $profil->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="grid md:grid-cols-2 gap-8 h-full">
            <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 h-full flex flex-col">
              <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i data-lucide="eye" class="w-5 h-5 text-emerald-600"></i> Visi Desa
              </h3>
              <textarea name="visi" rows="8" class="w-full border-slate-300 rounded-lg p-4 border focus:ring-2 focus:ring-emerald-500 outline-none transition bg-white mb-4 text-lg italic text-slate-700 leading-relaxed shadow-inner" placeholder="Tuliskan Visi Desa...">{{ old('visi', $profil->visi) }}</textarea>
              <button type="submit" class="w-full bg-slate-800 text-white py-2.5 rounded-lg hover:bg-slate-700 transition font-medium mt-auto flex items-center justify-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Simpan Visi</button>
            </div>
            <div class="flex flex-col h-full">
              <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i data-lucide="list-checks" class="w-5 h-5 text-emerald-600"></i> Daftar Misi
              </h3>
              <div class="flex-1 overflow-y-auto max-h-[400px] space-y-3 mb-6 pr-2">
                @php $misiList = $profil->misi ? preg_split('/\r?\n/', $profil->misi) : []; @endphp
                @foreach($misiList as $i => $misi)
                <div class="flex items-start justify-between bg-white border border-slate-200 p-4 rounded-lg shadow-sm hover:border-emerald-300 transition group">
                  <div class="flex gap-4">
                    <span class="bg-emerald-100 text-emerald-700 w-8 h-8 shrink-0 flex items-center justify-center rounded-full text-sm font-bold">{{ $i+1 }}</span>
                    <input type="text" name="misi[]" value="{{ $misi }}" class="text-slate-700 text-sm leading-relaxed pt-1 border-b border-dashed border-emerald-200 bg-transparent focus:bg-white focus:border-emerald-500 transition w-full">
                  </div>
                  <button type="button" class="text-slate-400 hover:text-red-500 p-1 opacity-100 transition flex items-center justify-center" onclick="this.closest('.group').remove()"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                </div>
                @endforeach
              </div>
              <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Tambah Misi Baru</label>
                <div class="flex gap-2">
                  <input type="text" name="misi[]" class="flex-1 border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="Isi misi baru...">
                  <button type="submit" class="bg-emerald-500 text-white px-4 rounded-lg hover:bg-emerald-600 transition shadow flex items-center justify-center gap-2"><i data-lucide="plus" class="w-5 h-5"></i> Tambah</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        @else
        <span class="text-slate-400">Belum ada data visi & misi</span>
        @endif
      </div>
      {{-- TAB SEJARAH --}}
      <div id="tab-sejarah" class="tab-content hidden animate-fade-in">
        @if(isset($profil) && $profil)
        <div class="mb-6 flex justify-between items-center">
          <div>
            <h3 class="text-lg font-bold text-slate-800">Timeline Sejarah Desa</h3>
            <p class="text-slate-500 text-sm">Urutan peristiwa penting perjalanan desa.</p>
          </div>
          <button type="button" onclick="toggleHistoryForm()" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-emerald-700 transition flex items-center gap-2 shadow-lg shadow-emerald-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Peristiwa
          </button>
        </div>
        <div id="history-form" class="hidden bg-slate-50 p-6 rounded-xl mb-8 border border-slate-200 shadow-inner">
          <h4 class="font-bold text-slate-700 mb-4 border-b pb-2">Form Peristiwa Baru</h4>
          <form action="{{ route('admin.profil.tambahSejarah') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid md:grid-cols-12 gap-4">
              <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tahun</label>
                <input type="text" name="tahun" class="w-full border border-slate-300 p-2.5 rounded-lg focus:ring-2 focus:ring-emerald-500 bg-white" placeholder="1999" required>
              </div>
              <div class="md:col-span-10">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Judul Peristiwa</label>
                <input type="text" name="judul" class="w-full border border-slate-300 p-2.5 rounded-lg focus:ring-2 focus:ring-emerald-500 bg-white" placeholder="Cth: Pemekaran Desa..." required>
              </div>
              <div class="md:col-span-12">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border border-slate-300 p-2.5 rounded-lg focus:ring-2 focus:ring-emerald-500 bg-white" rows="2" placeholder="Jelaskan secara singkat..." required></textarea>
              </div>
              <div class="md:col-span-9">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Gambar (Opsional)</label>
                <input type="file" name="gambar" class="w-full bg-white p-2 border border-slate-300 rounded-lg text-sm text-slate-500">
              </div>
              <div class="md:col-span-3 flex items-end">
                <button type="submit" class="w-full bg-slate-800 text-white py-2.5 rounded-lg hover:bg-slate-700 font-medium">Simpan Data</button>
              </div>
            </div>
          </form>
        </div>
        <div class="grid md:grid-cols-2 gap-5">
          {{-- Loop data sejarah dari tabel sejarah_desas --}}
          @foreach($sejarah as $item)
          <div class="flex bg-white p-4 rounded-xl border border-slate-200 shadow-sm relative group hover:shadow-md transition">
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://placehold.co/100x100/34d399/ffffff?text=Sejarah' }}" class="w-24 h-24 object-cover rounded-lg shrink-0 mr-4 bg-slate-200">
            <div class="flex-1">
              <div class="flex justify-between items-start">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2.5 py-1 rounded-md">{{ $item->tahun }}</span>
                <div class="flex gap-2">
                  <form action="{{ route('admin.profil.hapusSejarah', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus peristiwa ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-slate-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                  </form>
                </div>
              </div>
              <h4 class="font-bold text-slate-800 mt-2">{{ $item->judul }}</h4>
              <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">{{ $item->deskripsi }}</p>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <span class="text-slate-400">Belum ada data sejarah</span>
        @endif
      </div>
      {{-- TAB STRUKTUR ORGANISASI --}}
      <div id="tab-struktur" class="tab-content hidden animate-fade-in">
        @if(isset($profil) && $profil)
        <div>
          <h3 class="text-lg font-bold text-slate-800 mb-6 text-center">Bagan Struktur Organisasi</h3>
          <div class="max-w-4xl mx-auto">
            <div class="relative group rounded-xl overflow-hidden shadow-xl border border-slate-200 mb-8 bg-slate-100">
              <img src="{{ $profil->struktur_organisasi ? asset('storage/' . $profil->struktur_organisasi) : asset('assets/struktur.jpg') }}" class="w-full object-cover transition duration-500 group-hover:opacity-90">
              <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 bg-black/20">
                <p class="bg-white text-slate-900 px-6 py-2 rounded-full font-bold shadow-lg">Gambar Struktur Organisasi</p>
              </div>
            </div>
          </div>
          <form action="{{ route('admin.profil.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex justify-center mb-6">
              <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <label for="struktur_organisasi" class="bg-emerald-600 text-white px-6 py-2.5 rounded-lg font-bold shadow-lg hover:bg-emerald-700 transition inline-flex items-center justify-center gap-2 cursor-pointer">
                  <i data-lucide="upload" class="w-4 h-4"></i> Upload Struktur Baru
                </label>
                <input type="file" name="struktur_organisasi" id="struktur_organisasi" class="hidden">
                <p class="text-xs text-slate-400 mt-3 text-center">Format PNG/JPG, min. 1920px width</p>
              </div>
            </div>
            <div class="flex justify-center">
              <button type="submit" class="bg-slate-800 text-white px-8 py-2.5 rounded-lg font-bold shadow-lg hover:bg-slate-700 transition flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Struktur
              </button>
            </div>
          </form>
        </div>
        @else
        <span class="text-slate-400">Belum ada data struktur organisasi</span>
        @endif
      </div>
    </div>
  </div>
</div>

<style>
  .tab-btn.active-tab {
    color: #059669;
    border-bottom-color: #34d399;
    background-color: #ecfdf5;
  }

  .tab-content {
    animation: fadeIn .3s;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }
</style>
<script>
  if (window.lucide) lucide.createIcons();

  function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(el => {
      el.classList.remove('active-tab', 'text-emerald-600', 'border-emerald-500');
      el.classList.add('text-slate-600', 'border-transparent');
      const icon = el.querySelector('svg');
      if (icon) icon.style.color = 'currentColor';
    });
    const selectedContent = document.getElementById('tab-' + tabId);
    selectedContent.classList.remove('hidden');
    const activeBtn = document.getElementById('btn-' + tabId);
    activeBtn.classList.add('active-tab');
    activeBtn.classList.remove('text-slate-600', 'border-transparent');
  }

  function toggleHistoryForm() {
    const form = document.getElementById('history-form');
    form.classList.toggle('hidden');
  }

  document.addEventListener('DOMContentLoaded', () => {
    switchTab('beranda');
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
      console.log('Success notification displayed');
    }
  });
</script>
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
  let cropper;
  const inputFoto = document.getElementById('foto_kades');
  const modal = document.getElementById('modal-cropper');
  const imageCropper = document.getElementById('image-cropper');
  const previewFoto = document.getElementById('preview-foto-kades');
  const btnCancel = document.getElementById('btn-crop-cancel');
  const btnApply = document.getElementById('btn-crop-apply');

  // --- Cropper.js Refactor ---
  // Tambahkan crossOrigin pada elemen gambar agar crop dari server tidak error CORS
  document.getElementById('image-cropper').setAttribute('crossOrigin', 'anonymous');
  document.getElementById('preview-foto-kades').setAttribute('crossOrigin', 'anonymous');

  // Crop saat upload file baru
  inputFoto.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(evt) {
        imageCropper.onload = function() {
          if (cropper) cropper.destroy();
          cropper = new Cropper(imageCropper, {
            aspectRatio: 3 / 4,
            viewMode: 1,
            autoCropArea: 1,
          });
        };
        imageCropper.src = evt.target.result;
        modal.style.display = 'flex';
      };
      reader.readAsDataURL(file);
    }
  });
  // Crop ulang dari foto yang sudah ada
  previewFoto.addEventListener('click', async function() {
    const src = previewFoto.src;
    if (src) {
      imageCropper.onload = function() {
        if (cropper) cropper.destroy();
        cropper = new Cropper(imageCropper, {
          aspectRatio: 3 / 4,
          viewMode: 1,
          autoCropArea: 1,
        });
      };
      imageCropper.src = src;
      modal.style.display = 'flex';
    }
  });
  btnCancel.addEventListener('click', function() {
    modal.style.display = 'none';
    if (cropper) cropper.destroy();
    inputFoto.value = '';
  });
  btnApply.addEventListener('click', async function() {
    if (cropper) {
      cropper.getCroppedCanvas({
        width: 300,
        height: 400
      }).toBlob(async function(blob) {
        const url = URL.createObjectURL(blob);
        previewFoto.src = url;
        // Ganti file input dengan hasil crop (trik: DataTransfer)
        const dt = new DataTransfer();
        let fileName = 'cropped.jpg';
        // Jika crop dari foto lama (bukan upload baru), fetch ulang ke blob agar file input benar-benar terisi
        if (!inputFoto.files.length && previewFoto.src) {
          try {
            const response = await fetch(previewFoto.src, {
              mode: 'cors'
            });
            const oldBlob = await response.blob();
            fileName = 'cropped.' + (oldBlob.type.split('/')[1] || 'jpg');
            dt.items.add(new File([blob], fileName, {
              type: blob.type
            }));
          } catch (e) {
            dt.items.add(new File([blob], fileName, {
              type: blob.type
            }));
          }
        } else {
          dt.items.add(new File([blob], fileName, {
            type: blob.type
          }));
        }
        inputFoto.files = dt.files;
        modal.style.display = 'none';
        cropper.destroy();
      }, 'image/jpeg', 0.95);
    }
  });
  // --- End Cropper.js Refactor ---
</script>
@endpush
@endsection