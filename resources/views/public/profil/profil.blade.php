@extends('public.layout')
@section('content')
<section id="sejarah" class="py-20 bg-slate-50">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Perjalanan Kami</span>
      <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mt-2">Sejarah Desa Sukaraja</h2>
      <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full mt-4"></div>
    </div>
    <div class="relative max-w-4xl mx-auto">
      @if($sejarah && count($sejarah))
      <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-emerald-200 hidden md:block"></div>
      @foreach($sejarah as $i => $item)
      <div class="relative grid md:grid-cols-2 gap-8 mb-12 items-center">
        @if($i % 2 == 0)
        <div class="md:text-right p-6 bg-white rounded-xl shadow-md md:shadow-none md:bg-transparent" data-aos="fade-right">
          <h3 class="text-2xl font-bold text-slate-800">{{ $item->tahun }}</h3>
          <h4 class="text-xl font-serif text-emerald-600 mb-2">{{ $item->judul }}</h4>
          <p class="text-slate-600">{{ $item->deskripsi }}</p>
        </div>
        <div class="absolute left-1/2 transform -translate-x-1/2 w-8 h-8 {{ $i % 2 == 0 ? 'bg-emerald-500 border-white' : 'bg-white border-emerald-500' }} rounded-full border-4 shadow-lg hidden md:block z-10"></div>
        <div class="hidden md:block" data-aos="fade-left">
          @if($item->gambar)
          <img src="{{ asset('storage/'.$item->gambar) }}" class="rounded-xl shadow-lg w-full h-48 object-cover opacity-80 hover:opacity-100 transition">
          @endif
        </div>
        @else
        <div class="hidden md:block" data-aos="fade-right">
          @if($item->gambar)
          <img src="{{ asset('storage/'.$item->gambar) }}" class="rounded-xl shadow-lg w-full h-48 object-cover opacity-80 hover:opacity-100 transition">
          @endif
        </div>
        <div class="absolute left-1/2 transform -translate-x-1/2 w-8 h-8 {{ $i % 2 == 0 ? 'bg-emerald-500 border-white' : 'bg-white border-emerald-500' }} rounded-full border-4 shadow-lg hidden md:block z-10"></div>
        <div class="p-6 bg-white rounded-xl shadow-md md:shadow-none md:bg-transparent" data-aos="fade-left">
          <h3 class="text-2xl font-bold text-slate-800">{{ $item->tahun }}</h3>
          <h4 class="text-xl font-serif text-emerald-600 mb-2">{{ $item->judul }}</h4>
          <p class="text-slate-600">{{ $item->deskripsi }}</p>
        </div>
        @endif
      </div>
      @endforeach
      @else
      <div class="text-center text-slate-400">Belum ada data sejarah.</div>
      @endif
    </div>
  </div>
</section>

<!-- SECTION 2: Sambutan Kepala Desa -->
<section id="sambutan" class="py-20 bg-white relative overflow-hidden border-t border-slate-100">
  <div class="container mx-auto px-6">
    <div class="grid md:grid-cols-12 gap-12 items-center">
      <div class="md:col-span-4 relative" data-aos="fade-up" data-aos-duration="1000">
        <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-white p-2">
          <div class="border border-slate-100 rounded-xl overflow-hidden relative group">
            <img src="{{ $profil && $profil->foto_kades ? asset('storage/'.$profil->foto_kades) : asset('assets/kpdesa.jpg') }}" alt="Kepala Desa Sukaraja" class="w-full h-[400px] object-cover object-top transition duration-500 group-hover:scale-105 filter sepia-[0.1]">
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
              <h3 class="text-white text-xl font-bold font-sans">{{ $profil->nama_kades ?? '-' }}</h3>
              <p class="text-emerald-300 text-sm font-medium">Kepala Desa Sukaraja</p>
              <div class="mt-2 inline-block px-3 py-1 bg-emerald-600 text-white text-xs rounded-full">Periode {{ $profil->periode_kades ?? '-' }}</div>
            </div>
          </div>
        </div>
        <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-emerald-200 rounded-full blur-xl opacity-60 -z-10"></div>
      </div>
      <div class="md:col-span-8 md:pl-8" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
        <div class="flex items-center gap-4 mb-6">
          <div class="h-1 w-12 bg-emerald-500 rounded-full"></div>
          <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm font-sans">Sambutan Kepala Desa</span>
        </div>
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-2 leading-tight">
          {{ $profil->judul_sambutan_kades ?? '-' }}
        </h2>
        <div class="space-y-4 text-slate-600 text-lg leading-relaxed font-sans mb-6">
          {!! nl2br(e($profil->isi_sambutan_kades ?? 'Belum ada sambutan.')) !!}
        </div>
        <div class="mt-8 pt-6 border-t border-slate-200 flex items-center gap-4">
          <img src="{{ $profil && $profil->ttd_kades ? asset('storage/'.$profil->ttd_kades) : asset('assets/ttd asep saepudin.png') }}" alt="Tanda Tangan" class="h-12 opacity-60">
          <div>
            <p class="font-bold text-slate-800">{{ $profil->nama_kades ?? '-' }}</p>
            <p class="text-sm text-slate-500">Kepala Desa Sukaraja</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: Visi & Misi -->
<section id="visimisi" class="py-20 bg-emerald-900 text-white relative overflow-hidden">
  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-16" data-aos="fade-up">
      <h2 class="text-3xl md:text-5xl font-bold mb-4">Visi & Misi</h2>
      <div class="w-24 h-1 bg-emerald-400 mx-auto rounded-full"></div>
    </div>
    <div class="grid md:grid-cols-2 gap-12">
      <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-8 rounded-2xl hover:bg-white/10 transition duration-300" data-aos="fade-right" data-aos-delay="100">
        <h3 class="text-2xl font-bold mb-4 font-serif">Visi Kami</h3>
        <p class="text-emerald-100 text-xl leading-relaxed italic">
          {{ $profil->visi ?? '-' }}
        </p>
      </div>
      <div class="space-y-6" data-aos="fade-left" data-aos-delay="200">
        <h3 class="text-2xl font-bold font-serif border-b border-emerald-700 pb-4 inline-block mb-2">Misi Pembangunan</h3>
        @php
        $misiList = [];
        if($profil && $profil->misi) {
        if(is_array($profil->misi)) {
        $misiList = $profil->misi;
        } else {
        $decoded = json_decode($profil->misi, true);
        if(is_array($decoded)) {
        $misiList = $decoded;
        } else {
        // fallback: string dipisah baris
        $misiList = preg_split('/\r?\n/', $profil->misi);
        }
        }
        }
        $misiList = array_filter(array_map('trim', $misiList));
        @endphp
        @if(!empty($misiList))
        @foreach($misiList as $i => $misi)
        <div class="flex gap-4">
          <div class="shrink-0 w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center font-bold text-sm shadow-md">{{ $i+1 }}</div>
          <p class="text-emerald-50">{{ $misi }}</p>
        </div>
        @endforeach
        @else
        <div class="text-emerald-100">Belum ada data misi.</div>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: Struktur Organisasi -->
<section id="struktur" class="py-20 bg-slate-50">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Pemerintahan</span>
      <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mt-2">Struktur Organisasi</h2>
      <p class="text-slate-600 mt-4 max-w-2xl mx-auto">Sinergi antara aparat desa dan lembaga masyarakat dalam mewujudkan visi misi Desa Sukaraja.</p>
    </div>
    <div class="max-w-5xl mx-auto" data-aos="zoom-in" data-aos-duration="1000">
      <div class="bg-white p-4 rounded-2xl shadow-xl border border-slate-100 overflow-hidden group">
        <div class="relative overflow-hidden rounded-xl bg-slate-100 aspect-video flex items-center justify-center cursor-pointer" onclick="openStrukturModal()">
          <img src="{{ $profil && $profil->struktur_organisasi ? asset('storage/'.$profil->struktur_organisasi) : asset('assets/struktur.jpg') }}" alt="Bagan Struktur Organisasi" class="w-full h-full object-cover transition duration-700 group-hover:scale-105 group-hover:opacity-90">
          <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition duration-300">
            <button type="button" class="px-6 py-3 bg-white text-slate-900 font-bold rounded-lg shadow-lg hover:bg-emerald-50 transition transform hover:-translate-y-1">Lihat Gambar Penuh</button>
          </div>
          <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none group-hover:opacity-0 transition duration-300">
            <div class="bg-white/90 backdrop-blur px-6 py-4 rounded-xl shadow-lg text-center border-l-4 border-emerald-500">
              <h4 class="text-xl font-bold text-slate-800">Bagan Organisasi 2024</h4>
              <p class="text-slate-500 text-sm">Klik untuk memperbesar</p>
            </div>
          </div>
        </div>
        <div class="mt-6 flex justify-between items-center px-2">
          <div>
            <p class="font-bold text-slate-800">Dokumen Resmi</p>
            <p class="text-sm text-slate-500">Diperbarui: Januari 2024</p>
          </div>
          <button type="button" onclick="downloadStruktur()" class="flex items-center text-emerald-600 font-semibold hover:text-emerald-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Download Gambar
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MODAL STRUKTUR FULLSCREEN -->
<div id="struktur-modal" class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center hidden p-4" onclick="closeStrukturModal(event)">
  <div class="bg-white rounded-xl overflow-hidden max-w-5xl w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
    <div class="flex justify-between items-center p-6 border-b border-slate-200 sticky top-0 bg-white">
      <h3 class="text-lg font-bold text-slate-800">Bagan Struktur Organisasi - Tampilan Penuh</h3>
      <button type="button" onclick="closeStrukturModal()" class="text-slate-400 hover:text-slate-600 text-2xl font-bold">&times;</button>
    </div>
    <div class="p-6 bg-slate-50">
      <img id="struktur-modal-img" src="{{ $profil && $profil->struktur_organisasi ? asset('storage/'.$profil->struktur_organisasi) : asset('assets/struktur.jpg') }}" class="w-full object-contain">
    </div>
    <div class="flex justify-center gap-3 p-6 border-t border-slate-200 bg-white sticky bottom-0">
      <button type="button" onclick="downloadStruktur()" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        Download Gambar
      </button>
      <button type="button" onclick="closeStrukturModal()" class="px-6 py-2.5 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
        Tutup
      </button>
    </div>
  </div>
</div>

<script>
  function openStrukturModal() {
    document.getElementById('struktur-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeStrukturModal(event) {
    if (event && event.target.id !== 'struktur-modal') return;
    document.getElementById('struktur-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
  }

  function downloadStruktur() {
    const img = document.getElementById('struktur-modal-img');
    if (img && img.src) {
      const link = document.createElement('a');
      link.href = img.src;
      link.download = 'struktur-organisasi-desa-sukaraja.png';
      link.click();
    }
  }

  // Close modal when pressing Escape
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      closeStrukturModal();
    }
  });
</script>

@endsection