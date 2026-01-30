@extends('public.layout')
@section('title', 'Website Resmi Desa Sukaraja, Rawamerta, Karawang')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="apple-touch-icon" href="assets/hero.jpg">
<style>
  .hero-bg {
    background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.25)), url('https://images.pexels.com/photos/2132075/pexels-photo-2132075.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&fit=crop'), url('assets/hero.svg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  .hero-bg::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, rgba(16, 185, 129, 0.06), rgba(14, 165, 233, 0.04), rgba(99, 102, 241, 0.03));
    background-size: 200% 200%;
    animation: gradientShift 12s linear infinite;
    pointer-events: none;
  }

  @keyframes gradientShift {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }

  #tsparticles {
    position: absolute;
    inset: 0;
    z-index: -10;
  }

  lottie-player {
    display: block;
  }

  .fade-in-section {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
  }

  .fade-in-section.is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .animate-fade-in-down {
    animation: fadeInDown 0.9s ease-out both;
  }

  .animate-fade-in-up {
    animation: fadeInUp 0.9s ease-out both;
  }

  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-12px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(12px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .nav-link {
    position: relative;
    transition: color 0.3s;
  }

  .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #10b981;
    transition: width 0.3s ease-in-out;
  }

  .nav-link:hover::after {
    width: 100%;
  }

  .gallery-img:hover .overlay {
    opacity: 1;
  }

  @media (prefers-reduced-motion: reduce) {

    .hero-bg::before,
    .animate-fade-in-down,
    .animate-fade-in-up,
    [data-aos] {
      animation: none !important;
      transition: none !important;
    }
  }
</style>
@endpush

@section('content')

<section id="beranda" class="hero-bg relative h-[60vh] md:h-[90vh] flex items-center justify-center text-white overflow-hidden">
  <div id="tsparticles" class="absolute inset-0 -z-10 pointer-events-none" aria-hidden="true"></div>
  <div class="text-center px-4 max-w-3xl">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4 drop-shadow-lg animate-fade-in-down">Selamat Datang di Desa Sukaraja</h1>
    <p class="text-lg md:text-2xl mb-8 font-light drop-shadow-md animate-fade-in-up">Kecamatan Rawamerta, Kabupaten Karawang</p>
    <a href="#profil" class="bg-white text-emerald-600 font-bold py-3 px-8 rounded-full shadow-xl hover:bg-slate-100 transition-transform duration-300 hover:scale-110 transform">Jelajahi Desa Kami</a>
  </div>
</section>

<section id="profil" class="py-20 bg-white" data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-out-cubic">
  <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
    <div class="rounded-lg overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-500 tilt-card">
      @if($profil && $profil->gambar)
      <img src="{{ asset('storage/' . $profil->gambar) }}" alt="Gambar Profil Desa" class="w-full aspect-[16/10] object-contain bg-white rounded-lg shadow">
      @else
      <img src="https://placehold.co/800x500/34d399/ffffff?text=Kantor+Desa+Sukaraja" alt="Kantor Desa Sukaraja" class="w-full aspect-[16/10] object-contain bg-white rounded-lg shadow">
      @endif
    </div>
    <div data-aos="fade-left" data-aos-duration="1000" class="md:pl-6">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 leading-tight">
        Profil Desa <span class="text-emerald-600">Sukaraja</span>
      </h2>
      <p class="text-slate-600 text-lg mb-6 leading-relaxed">
        Selamat datang di Desa Sukaraja, sebuah desa yang asri dan penuh dengan kearifan lokal. Terletak di <strong class="text-slate-800">Kecamatan Rawamerta, Kabupaten Karawang</strong>, desa kami berkomitmen untuk terus berkembang menjadi desa yang maju, mandiri, dan sejahtera.
      </p>
      <p class="text-slate-600 mb-8 leading-relaxed border-l-4 border-emerald-200 pl-4 italic">
        "Dengan semangat gotong royong, kami membangun infrastruktur, meningkatkan kualitas pendidikan, dan mengoptimalkan potensi sumber daya alam yang ada."
      </p>
      <div class="flex flex-wrap gap-4">
        <a href="/profil" class="group inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition duration-300 shadow-lg shadow-emerald-200">
          Sejarah Desa
          <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
          </svg>
        </a>
        <a href="/profil#struktur" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition duration-300">
          Lihat Struktur Organisasi
        </a>
      </div>
    </div>
  </div>
</section>

<section id="berita" class="py-20 bg-white">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm">Informasi Terkini</span>
      <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mt-2">Berita & Kegiatan</h2>
      <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full mt-4"></div>
      <p class="text-lg mt-4 text-slate-600 max-w-2xl mx-auto">Ikuti perkembangan, agenda kegiatan, dan berita terbaru dari Desa Sukaraja.</p>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($beritas as $berita)
      <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 border border-slate-100" data-aos="fade-up" data-aos-duration="700">
        <div class="relative overflow-hidden h-56">
          <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/600x400/60a5fa/ffffff?text=Berita' }}" class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110" alt="{{ $berita->judul }}">
          <div class="absolute top-4 left-4 bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Berita</div>
        </div>
        <div class="p-6">
          <div class="flex items-center text-slate-500 text-sm mb-3 space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>{{ $berita->created_at->format('d F Y') }}</span>
          </div>
          <h3 class="text-xl font-bold mb-3 text-slate-800 group-hover:text-emerald-600 transition leading-snug">{{ $berita->judul }}</h3>
          <p class="text-slate-600 mb-4 text-sm leading-relaxed line-clamp-3">{{ \Illuminate\Support\Str::limit($berita->isi, 100) }}</p>
          <a href="{{ route('berita.detail', $berita->slug) }}" class="font-semibold text-emerald-500 text-sm hover:text-emerald-700 transition">Baca Selengkapnya &rarr;</a>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-12">
      <a href="{{ route('berita.index') }}" class="inline-block bg-slate-800 text-white font-semibold px-8 py-4 rounded-lg shadow-lg hover:bg-slate-700 transition duration-300 transform hover:-translate-y-1">Lihat Arsip Berita</a>
    </div>
  </div>
</section>

<section id="infografis" class="py-20" data-aos="fade-up" data-aos-duration="900">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="text-emerald-400 font-bold uppercase tracking-widest text-sm mb-2 block">Transparansi Data</span>
      <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mt-2">Statistik & Infografis Desa</h2>
      <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full mt-4"></div>
      <p class="text-slate-600 max-w-2xl mx-auto">Data kependudukan dan demografi Desa Sukaraja yang transparan dan akuntabel. Update: Semester I 2025.</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
      <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 md:gap-6" data-aos="fade-up" data-aos-delay="0">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl md:text-2xl">👥</div>
        <div>
          <p class="text-slate-500 text-sm font-medium">Total Penduduk</p>
          <h3 class="text-2xl md:text-4xl font-bold text-slate-800 counter" data-target="{{ $stat_penduduk['total_penduduk'] }}">0</h3>
          <p class="text-xs text-emerald-500 font-bold">Jiwa</p>
        </div>
      </div>
      <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 md:gap-6" data-aos="fade-up" data-aos-delay="100">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl md:text-2xl">🏠</div>
        <div>
          <p class="text-slate-500 text-sm font-medium">Kepala Keluarga</p>
          <h3 class="text-2xl md:text-4xl font-bold text-slate-800 counter" data-target="{{ $stat_penduduk['total_kk'] }}">0</h3>
          <p class="text-xs text-emerald-500 font-bold">KK</p>
        </div>
      </div>
      <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 md:gap-6" data-aos="fade-up" data-aos-delay="200">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center text-xl md:text-2xl">👨</div>
        <div>
          <p class="text-slate-500 text-sm font-medium">Laki-Laki</p>
          <h3 class="text-2xl md:text-4xl font-bold text-slate-800 counter" data-target="{{ $stat_penduduk['total_laki'] }}">0</h3>
          <p class="text-xs text-slate-400">50.7%</p>
        </div>
      </div>
      <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 md:gap-6" data-aos="fade-up" data-aos-delay="300">
        <div class="w-12 h-12 md:w-16 md:h-16 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center text-xl md:text-2xl">👩</div>
        <div>
          <p class="text-slate-500 text-sm font-medium">Perempuan</p>
          <h3 class="text-2xl md:text-4xl font-bold text-slate-800 counter" data-target="{{ $stat_penduduk['total_perempuan'] }}">0</h3>
          <p class="text-xs text-slate-400">49.3%</p>
        </div>
      </div>
    </div>
    <div class="text-center mt-16">
      <a href="{{ route('infografis.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-slate-800 rounded-lg hover:bg-slate-700 transition duration-300 shadow-lg transform hover:-translate-y-1">
        Lihat Semua infografis
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
      </a>
    </div>
  </div>
</section>

<section class="py-20 bg-slate-50" data-aos="fade-up" data-aos-duration="900">
  <div class="container mx-auto px-6 grid lg:grid-cols-5 gap-12 items-start">
    <div id="peta" class="lg:col-span-3">
      <div class="flex items-center gap-4 mb-6">
        <div class="h-10 w-1 bg-emerald-500 rounded-full"></div>
        <h2 class="text-3xl font-bold text-slate-800">Lokasi Desa Kami</h2>
      </div>
      <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white transform hover:scale-[1.01] transition duration-500">
        <iframe src="https://www.google.com/maps?q=-6.3265,107.4297&hl=id&z=15&output=embed" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    <div id="pengaduan" class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-2xl border border-slate-100 relative overflow-hidden">
      <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
      <div class="relative z-10">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Layanan Pengaduan</h2>
        <p class="text-slate-500 mb-6 text-sm">Punya keluhan, kritik, atau saran membangun? Sampaikan aspirasi Anda kepada kami.</p>
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="Masukkan nama Anda">
          </div>
          <div class="mb-4">
            <label for="telepon" class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon</label>
            <input type="tel" id="telepon" name="telepon" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="0812xxxxxxxx">
          </div>
          <div class="mb-4">
            <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
            <select id="kategori" name="kategori" class="w-full px-4 py-2 border border-slate-300 rounded-lg">
              <option value="">-- Pilih Kategori --</option>
              <option value="Infrastruktur">Infrastruktur</option>
              <option value="Kebersihan">Kebersihan</option>
              <option value="Pelayanan">Pelayanan</option>
              <option value="Keamanan">Keamanan</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="mb-6">
            <label for="pesan" class="block text-sm font-medium text-slate-700 mb-1">Isi Pengaduan/Aspirasi</label>
            <textarea id="pesan" name="isi" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="Tuliskan pesan Anda di sini..."></textarea>
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email (opsional)</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="email@contoh.com">
          </div>
          <div class="mb-6">
            <label for="lampiran" class="block text-sm font-medium text-slate-700 mb-1">Lampiran (opsional)</label>
            <input type="file" id="lampiran" name="lampiran" accept="image/*,.pdf,video/*" class="w-full">
          </div>
          <button type="submit" class="w-full bg-emerald-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-transform duration-300 hover:scale-105">Kirim Pengaduan</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
<script>
  // --- Counter Animation Script  ---
  document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / 100;
        if (count < target) {
          counter.innerText = Math.ceil(count + increment);
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = target;
        }
      };
      updateCount();
    });
  });

  // Initialize Lucide Icons
  if (window.lucide) lucide.createIcons();

  // Mobile Menu Toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      const icon = mobileMenuButton.querySelector('i');
      if (mobileMenu.classList.contains('hidden')) {
        icon.setAttribute('data-lucide', 'menu');
      } else {
        icon.setAttribute('data-lucide', 'x');
      }
      if (window.lucide) lucide.createIcons();
    });

    // Close mobile menu when a link is clicked
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        mobileMenuButton.querySelector('i').setAttribute('data-lucide', 'menu');
        if (window.lucide) lucide.createIcons();
      });
    });
  }

  // Scroll Animations
  const sections = document.querySelectorAll('.fade-in-section');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
      }
    });
  }, {
    threshold: 0.1
  });
  sections.forEach(section => {
    observer.observe(section);
  });

  // Change header style on scroll
  const header = document.getElementById('header');
  if (header) { // Tambahkan pengecekan if header exist biar aman
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('shadow-lg');
      } else {
        header.classList.remove('shadow-lg');
      }
    });
  }

  // Respect user's reduced motion preference and initialize animation libraries
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!prefersReduced) {
    // Initialize AOS for scroll reveals (if loaded)
    if (window.AOS) {
      AOS.init({
        once: true,
        duration: 800,
        easing: 'ease-out-cubic'
      });
    }
    // Initialize tsParticles background in hero (if loaded)
    if (window.tsParticles) {
      tsParticles.load('tsparticles', {
        fpsLimit: 60,
        particles: {
          number: {
            value: 35,
            density: {
              enable: true,
              area: 900
            }
          },
          color: {
            value: ['#ffffff', '#10b981']
          },
          opacity: {
            value: 0.2
          },
          size: {
            value: {
              min: 1,
              max: 3
            }
          },
          move: {
            enable: true,
            speed: 0.6,
            direction: 'none',
            outModes: 'bounce'
          },
          links: {
            enable: false
          },
        },
        detectRetina: true,
      });
    }
    // VanillaTilt micro-interactions (if loaded)
    if (window.VanillaTilt) {
      VanillaTilt.init(document.querySelectorAll('.tilt-card'), {
        max: 10,
        speed: 400,
        glare: true,
        'max-glare': 0.15
      });
    }
  } else {
    // If reduced motion is set, remove data-aos attributes so nothing animates
    document.querySelectorAll('[data-aos]').forEach(el => el.removeAttribute('data-aos'));
  }
</script>
@endpush