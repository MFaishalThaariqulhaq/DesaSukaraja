@extends('public.layout')

@section('content')
<section class="py-20 bg-gradient-to-b from-slate-100 via-emerald-50 to-slate-100">
  <div class="container mx-auto px-6">

    <!-- Header -->
    <div class="text-center mb-12">
      <h1 class="text-3xl md:text-4xl font-bold text-slate-800 mb-2">
        Pemerintahan Desa Sukaraja
      </h1>
      <p class="text-lg text-slate-600">
        Struktur Organisasi dan Tata Kerja Desa Sukaraja Periode 2024–2029
      </p>
    </div>

    @php
    $bagan = $sotks->where('jabatan', 'Bagan')->first();
    @endphp

    <!-- BAGAN STRUKTUR -->
    @if($bagan)
    <div class="flex justify-center mb-14">
      <img
        src="{{ asset('storage/' . $bagan->foto) }}"
        alt="Bagan Struktur Organisasi"
        id="baganImage"
        class="rounded-xl shadow-xl max-w-4xl w-full h-auto cursor-pointer hover:opacity-90 hover:scale-[1.02] transition-transform duration-300">
    </div>
    @endif

    <!-- Daftar Struktur -->
    <h2 class="text-2xl font-semibold mb-8 text-center text-slate-800">Struktur Organisasi &amp; Tata Kerja</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 justify-items-center">
      @foreach($sotks->where('jabatan', '!=', 'Bagan') as $sotk)
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden w-full max-w-sm transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">

        <!-- Foto -->
        <div class="w-full aspect-[4/5] bg-slate-200">
          <img
            src="{{ $sotk->foto ? asset('storage/' . $sotk->foto) : 'https://placehold.co/500x625/94a3b8/ffffff?text=Foto' }}"
            alt="{{ $sotk->nama }}"
            class="w-full h-full object-contain bg-white">
        </div>

        <!-- Info -->
        <div class="p-5 bg-gradient-to-r from-emerald-600 to-teal-500 text-white text-center">
          <h3 class="text-lg md:text-xl font-bold tracking-wide leading-tight">{{ $sotk->nama }}</h3>
          <p class="text-sm mt-1 opacity-90">{{ $sotk->jabatan }}</p>
        </div>

      </div>
      @endforeach
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-6 flex justify-center">
      <a href="{{ url('/#sotk') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2 rounded-full shadow transition-all">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span>Kembali</span>
      </a>
    </div>

  </div>
</section>

<!-- MODAL UNTUK LIHAT BAGAN -->
<div id="baganModal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4">
  <div class="relative max-w-5xl w-full">
    <button id="closeModal"
      class="absolute -top-10 right-0 text-white text-4xl font-light hover:text-emerald-400 transition">
      &times;
    </button>
    <img
      src=""
      alt="Bagan Besar"
      id="baganModalImg"
      class="rounded-xl shadow-2xl w-full h-auto border-4 border-white">
  </div>
</div>

<!-- SCRIPT UNTUK MODAL -->
<script>
  const baganImage = document.getElementById('baganImage');
  const modal = document.getElementById('baganModal');
  const modalImg = document.getElementById('baganModalImg');
  const closeModal = document.getElementById('closeModal');

  if (baganImage) {
    baganImage.addEventListener('click', () => {
      modalImg.src = baganImage.src;
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });
  }

  closeModal.addEventListener('click', () => {
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
  });

  lucide.createIcons();
</script>
@endsection