// SOTK Module - Struktur page with modal and drag scroll

export function initSotk() {
  const modal = document.getElementById('modal');
  const closeModal = document.getElementById('closeModal');
  const staffData = window.staffData || {};

  // Modal functionality for staff detail
  document.querySelectorAll('.node').forEach(node => {
    node.addEventListener('click', () => {
      const id = node.dataset.id;
      if (!staffData[id]) return;

      document.getElementById('modalName').innerText = staffData[id].name;
      document.getElementById('modalRole').innerText = staffData[id].role;
      document.getElementById('modalTupoksi').innerText = staffData[id].tupoksi;

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    });
  });

  if (closeModal) {
    closeModal.addEventListener('click', () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    });
  }

  if (modal) {
    modal.addEventListener('click', e => {
      if (e.target === modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    });
  }

  // Drag scroll functionality
  const treeContainer = document.getElementById('tree-container');
  if (treeContainer) {
    let isDown = false;
    let startX;
    let scrollLeft;

    treeContainer.addEventListener('mousedown', e => {
      isDown = true;
      treeContainer.classList.add('active');
      startX = e.pageX - treeContainer.offsetLeft;
      scrollLeft = treeContainer.scrollLeft;
    });

    treeContainer.addEventListener('mouseleave', () => {
      isDown = false;
      treeContainer.classList.remove('active');
    });

    treeContainer.addEventListener('mouseup', () => {
      isDown = false;
      treeContainer.classList.remove('active');
    });

    treeContainer.addEventListener('mousemove', e => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - treeContainer.offsetLeft;
      const walk = (x - startX) * 2;
      treeContainer.scrollLeft = scrollLeft - walk;
    });
  }

  // Modal functionality for bagan image
  initBaganModal();
}

function initBaganModal() {
  // Support both old ID (baganImage) and new ID (baganContainer)
  const baganContainer = document.getElementById('baganContainer');
  const baganImage = document.getElementById('baganImage');
  const baganElement = baganContainer || baganImage;
  
  const baganModal = document.getElementById('baganModal');
  const baganModalImg = document.getElementById('baganModalImg');
  const closeModalBtn = document.getElementById('closeModal');

  if (!baganElement || !baganModal) return;

  // Get actual image from container or direct element
  const getImageSrc = () => {
    if (baganContainer) {
      const img = baganContainer.querySelector('img');
      return img ? img.src : baganImage?.src;
    }
    return baganImage?.src;
  };

  // Open modal on element click
  baganElement.addEventListener('click', () => {
    const src = getImageSrc();
    if (src) {
      baganModalImg.src = src;
      baganModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
  });

  // Close modal
  const closeModal = () => {
    baganModal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  };

  if (closeModalBtn) {
    closeModalBtn.addEventListener('click', closeModal);
  }

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !baganModal.classList.contains('hidden')) {
      closeModal();
    }
  });

  baganModal.addEventListener('click', (e) => {
    if (e.target === baganModal) {
      closeModal();
    }
  });

  // Download button
  const downloadBtn = document.getElementById('downloadBagan');
  if (downloadBtn) {
    downloadBtn.addEventListener('click', () => {
      const src = getImageSrc();
      if (src) {
        const link = document.createElement('a');
        link.href = src;
        link.download = 'bagan-organisasi-desa-sukaraja.png';
        link.click();
      }
    });
  }
}

