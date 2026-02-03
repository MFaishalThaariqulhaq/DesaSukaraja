// Berita List - Pagination & Filtering
document.addEventListener('DOMContentLoaded', () => {
  const itemsPerPage = 4; // 2x2 grid
  let currentPage = 1;

  // Pagination functionality
  function renderPagination() {
    const allItems = document.querySelectorAll('.berita-item');
    const currentFilter = new URLSearchParams(window.location.search).get('kategori') || 'all';
    
    // Count items yang tidak di-filter
    let visibleCount = 0;
    allItems.forEach(item => {
      const itemCategory = item.dataset.category;
      const isFiltered = currentFilter !== 'all' && itemCategory !== currentFilter;
      if (!isFiltered) {
        visibleCount++;
      }
    });
    
    const totalPages = Math.max(1, Math.ceil(visibleCount / itemsPerPage));
    const paginationContainer = document.getElementById('berita-pagination');

    if (paginationContainer) {
      paginationContainer.innerHTML = '';

      // Only show pagination if more than 1 page
      if (totalPages <= 1) {
        return;
      }

      // Create pagination wrapper
      const paginationDiv = document.createElement('div');
      paginationDiv.className = 'pagination';
      paginationDiv.style.display = 'flex';
      paginationDiv.style.justifyContent = 'center';
      paginationDiv.style.gap = '0.5rem';
      paginationDiv.style.marginTop = '2rem';
      paginationDiv.style.flexWrap = 'wrap';

      // Previous button
      const prevBtn = document.createElement('button');
      prevBtn.innerHTML = '<svg fill="currentColor" viewBox="0 0 20 20" style="width: 1rem; height: 1rem; margin-right: 0.25rem;"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg><span>Sebelumnya</span>';
      prevBtn.style.padding = '0.5rem 0.75rem';
      prevBtn.style.border = '1px solid #e2e8f0';
      prevBtn.style.background = 'white';
      prevBtn.style.color = '#475569';
      prevBtn.style.borderRadius = '0.375rem';
      prevBtn.style.cursor = currentPage === 1 ? 'not-allowed' : 'pointer';
      prevBtn.style.fontSize = '0.875rem';
      prevBtn.style.transition = 'all 0.2s';
      prevBtn.style.display = 'inline-flex';
      prevBtn.style.alignItems = 'center';
      prevBtn.style.textDecoration = 'none';
      prevBtn.style.opacity = currentPage === 1 ? '0.5' : '1';
      prevBtn.disabled = currentPage === 1;
      prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
          currentPage--;
          paginatePage();
          renderPagination();
          document.getElementById('berita-list').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
      paginationDiv.appendChild(prevBtn);

      // Page numbers
      for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.textContent = i;
        pageBtn.style.padding = '0.5rem 0.75rem';
        pageBtn.style.border = '1px solid #e2e8f0';
        pageBtn.style.background = i === currentPage ? '#059669' : 'white';
        pageBtn.style.color = i === currentPage ? 'white' : '#475569';
        pageBtn.style.borderColor = i === currentPage ? '#059669' : '#e2e8f0';
        pageBtn.style.borderRadius = '0.375rem';
        pageBtn.style.cursor = 'pointer';
        pageBtn.style.fontSize = '0.875rem';
        pageBtn.style.transition = 'all 0.2s';
        pageBtn.style.display = 'inline-flex';
        pageBtn.style.alignItems = 'center';
        pageBtn.style.justifyContent = 'center';
        pageBtn.addEventListener('click', () => {
          currentPage = i;
          paginatePage();
          renderPagination();
          document.getElementById('berita-list').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
        pageBtn.addEventListener('mouseenter', () => {
          if (i !== currentPage) {
            pageBtn.style.background = '#f1f5f9';
            pageBtn.style.borderColor = '#cbd5e1';
          }
        });
        pageBtn.addEventListener('mouseleave', () => {
          if (i !== currentPage) {
            pageBtn.style.background = 'white';
            pageBtn.style.borderColor = '#e2e8f0';
          }
        });
        paginationDiv.appendChild(pageBtn);
      }

      // Next button
      const nextBtn = document.createElement('button');
      nextBtn.innerHTML = '<span>Selanjutnya</span><svg fill="currentColor" viewBox="0 0 20 20" style="width: 1rem; height: 1rem; margin-left: 0.25rem;"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>';
      nextBtn.style.padding = '0.5rem 0.75rem';
      nextBtn.style.border = '1px solid #e2e8f0';
      nextBtn.style.background = 'white';
      nextBtn.style.color = '#475569';
      nextBtn.style.borderRadius = '0.375rem';
      nextBtn.style.cursor = currentPage === totalPages ? 'not-allowed' : 'pointer';
      nextBtn.style.fontSize = '0.875rem';
      nextBtn.style.transition = 'all 0.2s';
      nextBtn.style.display = 'inline-flex';
      nextBtn.style.alignItems = 'center';
      nextBtn.style.textDecoration = 'none';
      nextBtn.style.opacity = currentPage === totalPages ? '0.5' : '1';
      nextBtn.disabled = currentPage === totalPages;
      nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
          currentPage++;
          paginatePage();
          renderPagination();
          document.getElementById('berita-list').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
      paginationDiv.appendChild(nextBtn);

      paginationContainer.appendChild(paginationDiv);
    }
  }

  function paginatePage() {
    const items = document.querySelectorAll('.berita-item');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    let visibleIndex = 0;
    const currentFilter = new URLSearchParams(window.location.search).get('kategori') || 'all';

    items.forEach((item) => {
      const itemCategory = item.dataset.category;
      const isFiltered = currentFilter !== 'all' && itemCategory !== currentFilter;

      if (isFiltered) {
        item.style.display = 'none';
      } else {
        if (visibleIndex >= startIndex && visibleIndex < endIndex) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
        visibleIndex++;
      }
    });

    // Reinitialize AOS for newly visible items
    if (window.AOS) {
      AOS.refresh();
    }
  }

  // Initial setup
  paginatePage();
  renderPagination();

  // Auto-scroll to berita list ketika kategori diklik
  const categoryLinks = document.querySelectorAll('.kategori-link');
  categoryLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      // Reset pagination
      currentPage = 1;
      setTimeout(() => {
        const beritaList = document.getElementById('berita-list');
        if (beritaList) {
          beritaList.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        paginatePage();
        renderPagination();
      }, 300);
    });
  });

  // Search functionality
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('keyup', (e) => {
      const query = e.target.value.toLowerCase();
      document.querySelectorAll('.berita-item').forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(query) ? '' : 'none';
      });
      currentPage = 1;
      renderPagination();
    });
  }
});
