@extends('layouts.public.layout')

@section('content')

<!-- Hero Header Section -->
<section class="hero-bg relative h-[35vh] md:h-[45vh] flex items-center justify-center text-white overflow-hidden -mt-24">
  <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold font-serif leading-tight drop-shadow-2xl mb-4">
      Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-200">Foto</span>
    </h1>
    <p class="text-lg md:text-2xl text-slate-100 drop-shadow-md">Koleksi momen-momen berharga kegiatan desa</p>
  </div>
  <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce opacity-80 cursor-pointer hover:text-emerald-300 transition-colors">
    <a href="#galeri-list"><i data-lucide="mouse" class="w-6 h-6"></i></a>
  </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,600&display=swap" rel="stylesheet">

<section id="galeri-list" class="py-16 bg-slate-50">
<style>
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc;
  }

  .masonry-grid {
    column-count: 1;
    gap: 1.5rem;
  }

  @media (min-width: 640px) {
    .masonry-grid {
      column-count: 2;
    }
  }

  @media (min-width: 1024px) {
    .masonry-grid {
      column-count: 3;
    }
  }

  .break-inside-avoid {
    break-inside: avoid;
  }

  .gallery-item {
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .gallery-item:hover img {
    transform: scale(1.05);
  }

  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    animation: fadeIn 0.3s ease;
  }

  .modal.show {
    display: flex;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  .modal-content {
    background: white;
    margin: auto;
    padding: 0;
    width: 90%;
    max-width: 900px;
    border-radius: 1rem;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideUp 0.3s ease;
    display: flex;
    flex-direction: column;
  }

  @keyframes slideUp {
    from {
      transform: translateY(50px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .modal-header {
    position: sticky;
    top: 0;
    background: white;
    border-bottom: 1px solid #e2e8f0;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1001;
  }

  .modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 1.5rem;
  }

  .modal-image {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
  }

  .modal-footer {
    display: flex;
    gap: 0.75rem;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
  }

  .close-modal {
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    color: #64748b;
    transition: color 0.2s;
  }

  .close-modal:hover {
    color: #ef4444;
  }

  .nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 1rem;
    cursor: pointer;
    border-radius: 0.5rem;
    transition: background 0.2s;
    display: none;
    z-index: 1002;
  }

  .nav-btn:hover {
    background: rgba(0, 0, 0, 0.8);
  }

  .nav-btn.show {
    display: block;
  }

  .prev {
    left: 1rem;
  }

  .next {
    right: 1rem;
  }

  .filter-btn {
    transition: all 0.3s ease;
  }

  .filter-btn.active {
    background-color: #059669;
    color: white;
    box-shadow: 0 4px 6px rgba(5, 150, 105, 0.3);
  }

  .gallery-item {
    animation: fadeInItem 0.4s ease;
  }

  @keyframes fadeInItem {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<div class="bg-slate-50 antialiased text-slate-600">
  <!-- Header Section -->
  <header class="bg-slate-900 text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden opacity-30">
      <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Background">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
    <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up">
      <span class="text-emerald-400 font-bold uppercase tracking-widest text-sm mb-2 block">Album Desa</span>
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Desa Sukaraja</h1>
      <p class="text-slate-300 max-w-2xl mx-auto text-lg">Potret keindahan alam, kegiatan masyarakat, dan jejak pembangunan desa kami.</p>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto px-6 py-12">

    <!-- Filter Buttons -->
    <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up" data-aos-delay="100">
      <button class="filter-btn active px-6 py-2 rounded-full bg-emerald-600 text-white font-medium shadow-md hover:bg-emerald-700 transition" data-filter="all">Semua</button>
      <button class="filter-btn px-6 py-2 rounded-full bg-white text-slate-600 border border-slate-200 font-medium hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition" data-filter="kegiatan">Kegiatan</button>
      <button class="filter-btn px-6 py-2 rounded-full bg-white text-slate-600 border border-slate-200 font-medium hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition" data-filter="alam">Alam & Wisata</button>
      <button class="filter-btn px-6 py-2 rounded-full bg-white text-slate-600 border border-slate-200 font-medium hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition" data-filter="pembangunan">Pembangunan</button>
    </div>

    <!-- Gallery Grid (Masonry Style) -->
    <div class="masonry-grid" id="gallery-container">
      @forelse($galeris as $index => $galeri)
        @php
          $category = strtolower($galeri->kategori ?? 'kegiatan');
          // Map kategori to filter keys
          $categoryMap = [
            'kegiatan' => 'kegiatan',
            'alam & wisata' => 'alam',
            'pembangunan' => 'pembangunan',
          ];
          $categorySlug = $categoryMap[$category] ?? 'kegiatan';
        @endphp
        <div class="mb-6 break-inside-avoid gallery-item group relative rounded-xl overflow-hidden shadow-lg cursor-pointer hover:shadow-2xl transition-all duration-300" 
             data-aos="fade-up" 
             data-aos-delay="{{ ($index % 3) * 100 }}"
             data-category="{{ $categorySlug }}"
             data-id="{{ $galeri->id }}"
             onclick="openModal({{ $galeri->id }})">
          <div class="relative overflow-hidden bg-slate-200 h-64 sm:h-72">
            <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                 class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700" 
                 alt="{{ $galeri->judul }}">
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
            <span class="text-emerald-400 text-xs font-bold uppercase tracking-wider mb-1">{{ $galeri->kategori }}</span>
            <h3 class="text-white text-lg font-bold">{{ $galeri->judul }}</h3>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-12">
          <div class="text-slate-400 mb-4">
            <i class="fas fa-image text-4xl"></i>
          </div>
          <p class="text-slate-600 text-lg">Belum ada foto galeri</p>
        </div>
      @endforelse
    </div>

    <!-- Load More -->
    <div class="text-center mt-12">
      <button class="inline-flex items-center px-6 py-3 border border-slate-300 shadow-sm text-base font-medium rounded-md text-slate-700 bg-white hover:bg-slate-50 transition">
        Muat Lebih Banyak
        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Modal Lightbox -->
<div id="imageModal" class="modal">
  <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header">
      <h2 id="modalTitle" class="text-xl font-bold text-slate-900"></h2>
      <span class="close-modal" onclick="closeModal()">&times;</span>
    </div>

    <!-- Modal Body -->
    <div class="modal-body">
      <img id="modalImage" src="" alt="" class="modal-image">
      
      <div class="space-y-4">
        <div>
          <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-1">Kategori</p>
          <p id="modalCategory" class="text-sm text-slate-600"></p>
        </div>
        
        <div>
          <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-1">Deskripsi</p>
          <p id="modalDescription" class="text-sm text-slate-700 leading-relaxed"></p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
          <div>
            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-1">Tanggal Upload</p>
            <p id="modalDate" class="text-slate-600"></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Footer -->
    <div class="modal-footer">
      <button onclick="downloadImage()" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium flex items-center justify-center gap-2">
        <i class="fas fa-download"></i> Unduh
      </button>
      <button onclick="prevImage()" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button onclick="nextImage()" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // Initialize AOS
  AOS.init({
    once: true,
    offset: 50,
    duration: 800,
    easing: 'ease-out-cubic'
  });

  // Gallery data from Laravel
  const galeryData = {!! json_encode($galeris->map(function($g) {
    return [
      'id' => $g->id,
      'judul' => $g->judul,
      'gambar' => asset('storage/' . $g->gambar),
      'deskripsi' => $g->deskripsi,
      'kategori' => $g->kategori,
      'created_at' => $g->created_at->format('d M Y'),
    ];
  })->values()->all()) !!};

  let currentImageIndex = 0;
  let filteredGalery = galeryData;

  console.log('Galery Data Loaded:', galeryData);

  // Filter functionality
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      // Update active state
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      const filter = this.dataset.filter;
      const items = document.querySelectorAll('.gallery-item');

      items.forEach(item => {
        const itemCategory = item.dataset.category;
        if (filter === 'all' || itemCategory.includes(filter)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });

  // Modal functions
  function openModal(galleryId) {
    console.log('Opening modal for gallery ID:', galleryId);
    const gallery = galeryData.find(g => g.id == galleryId);
    console.log('Found gallery:', gallery);
    if (!gallery) {
      console.error('Gallery not found for ID:', galleryId);
      return;
    }

    currentImageIndex = galeryData.findIndex(g => g.id == galleryId);
    updateModal(gallery);

    document.getElementById('imageModal').classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    document.getElementById('imageModal').classList.remove('show');
    document.body.style.overflow = 'auto';
  }

  function updateModal(gallery) {
    document.getElementById('modalTitle').textContent = gallery.judul;
    document.getElementById('modalImage').src = gallery.gambar;
    document.getElementById('modalImage').alt = gallery.judul;
    document.getElementById('modalCategory').textContent = gallery.kategori;
    document.getElementById('modalDescription').textContent = gallery.deskripsi || 'Tidak ada deskripsi';
    document.getElementById('modalDate').textContent = gallery.created_at;
  }

  function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galeryData.length;
    updateModal(galeryData[currentImageIndex]);
  }

  function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + galeryData.length) % galeryData.length;
    updateModal(galeryData[currentImageIndex]);
  }

  function downloadImage() {
    const imageSrc = document.getElementById('modalImage').src;
    const imageTitle = document.getElementById('modalTitle').textContent;
    
    const link = document.createElement('a');
    link.href = imageSrc;
    link.download = imageTitle || 'galeri-desa-sukaraja';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    if (modal.classList.contains('show')) {
      if (e.key === 'ArrowLeft') prevImage();
      if (e.key === 'ArrowRight') nextImage();
      if (e.key === 'Escape') closeModal();
    }
  });

  // Close modal when clicking outside
  document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeModal();
    }
  });
</script>

@endsection
