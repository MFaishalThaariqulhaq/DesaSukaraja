// Galeri page JavaScript
document.addEventListener('DOMContentLoaded', () => {
  // Initialize AOS
  if (window.AOS) {
    AOS.init({
      once: true,
      offset: 50,
      duration: 800,
      easing: 'ease-out-cubic'
    });
  }

  // Initialize Lucide icons
  if (window.lucide) {
    lucide.createIcons();
  }

  // Gallery data (injected from Laravel)
  const galeryDataElement = document.getElementById('galery-data');
  let galeryData = [];

  if (galeryDataElement) {
    try {
      galeryData = JSON.parse(galeryDataElement.textContent);
      console.log('Galery Data Loaded:', galeryData);
    } catch (e) {
      console.error('Error parsing gallery data:', e);
    }
  }

  let currentImageIndex = 0;
  let filteredGalery = galeryData;
  const itemsPerPage = 9; // 3 columns x 3 rows
  let currentPage = 1;

  // Pagination functionality
  function renderPagination() {
    const totalPages = Math.ceil(galeryData.length / itemsPerPage);
    const paginationContainer = document.getElementById('pagination-container');

    if (paginationContainer) {
      paginationContainer.innerHTML = '';

      // Previous button
      const prevBtn = document.createElement('button');
      prevBtn.textContent = '← Sebelumnya';
      prevBtn.disabled = currentPage === 1;
      prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
          currentPage--;
          paginatePage();
          renderPagination();
        }
      });
      paginationContainer.appendChild(prevBtn);

      // Page numbers
      for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.textContent = i;
        pageBtn.classList.toggle('active', i === currentPage);
        pageBtn.addEventListener('click', () => {
          currentPage = i;
          paginatePage();
          renderPagination();
          window.scrollTo({ top: document.getElementById('gallery-container').offsetTop - 100, behavior: 'smooth' });
        });
        paginationContainer.appendChild(pageBtn);
      }

      // Next button
      const nextBtn = document.createElement('button');
      nextBtn.textContent = 'Selanjutnya →';
      nextBtn.disabled = currentPage === totalPages;
      nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
          currentPage++;
          paginatePage();
          renderPagination();
        }
      });
      paginationContainer.appendChild(nextBtn);
    }
  }

  function paginatePage() {
    const items = document.querySelectorAll('.gallery-item');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    items.forEach((item, index) => {
      item.style.display = index >= startIndex && index < endIndex ? 'block' : 'none';
    });
  }

  // Initial pagination
  renderPagination();
  paginatePage();

  // Filter functionality
  function applyFilter(filterValue) {
    // Update active state on buttons
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    document.querySelector(`[data-filter="${filterValue}"]`)?.classList.add('active');

    const items = document.querySelectorAll('.gallery-item');
    currentPage = 1; // Reset to page 1 when filtering

    items.forEach(item => {
      const itemCategory = item.dataset.category;
      if (filterValue === 'all' || itemCategory === filterValue) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    });

    // Re-paginate after filter
    paginatePage();
    renderPagination();
  }

  // Filter button clicks
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      applyFilter(this.dataset.filter);
    });
  });

  // Category tag clicks (clickable categories)
  document.addEventListener('click', function(e) {
    if (e.target.dataset.filterCategory) {
      applyFilter(e.target.dataset.filterCategory);
    }
  });

  // Modal functions
  window.openModal = function (galleryId) {
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
  };

  window.closeModal = function () {
    document.getElementById('imageModal').classList.remove('show');
    document.body.style.overflow = 'auto';
  };

  function updateModal(gallery) {
    document.getElementById('modalTitle').textContent = gallery.judul;
    document.getElementById('modalImage').src = gallery.gambar;
    document.getElementById('modalImage').alt = gallery.judul;
    document.getElementById('modalCategory').textContent = gallery.kategori;
    document.getElementById('modalDescription').textContent = gallery.deskripsi || 'Tidak ada deskripsi';
    document.getElementById('modalDate').textContent = gallery.created_at;
  }

  window.nextImage = function () {
    currentImageIndex = (currentImageIndex + 1) % galeryData.length;
    updateModal(galeryData[currentImageIndex]);
  };

  window.prevImage = function () {
    currentImageIndex = (currentImageIndex - 1 + galeryData.length) % galeryData.length;
    updateModal(galeryData[currentImageIndex]);
  };

  window.downloadImage = function () {
    const imageSrc = document.getElementById('modalImage').src;
    const imageTitle = document.getElementById('modalTitle').textContent;

    const link = document.createElement('a');
    link.href = imageSrc;
    link.download = imageTitle || 'galeri-desa-sukaraja';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  };

  // Keyboard navigation
  document.addEventListener('keydown', function (e) {
    const modal = document.getElementById('imageModal');
    if (modal && modal.classList.contains('show')) {
      if (e.key === 'ArrowLeft') window.prevImage();
      if (e.key === 'ArrowRight') window.nextImage();
      if (e.key === 'Escape') window.closeModal();
    }
  });

  // Close modal when clicking outside
  const modal = document.getElementById('imageModal');
  if (modal) {
    modal.addEventListener('click', function (e) {
      if (e.target === this) {
        window.closeModal();
      }
    });
  }
});
