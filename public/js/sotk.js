/**
 * SOTK (Struktur Organisasi Tata Kerja) Page
 * Handling interactivity for the organizational structure page
 */

// ==========================================
// MODULE: Tree Management
// ==========================================

const TreeManager = (() => {
  const toggleNode = (element) => {
    const parentLi = element.closest('li');
    if (parentLi.querySelector('ul')) {
      parentLi.classList.toggle('collapsed');

      const icon = element.querySelector('.toggle-icon i');
      if (icon) {
        if (parentLi.classList.contains('collapsed')) {
          icon.setAttribute('data-lucide', 'plus-circle');
          element.classList.remove('active-node');
        } else {
          icon.setAttribute('data-lucide', 'minus-circle');
          element.classList.add('active-node');
        }
        lucide.createIcons();
      }
    }
  };

  const expandAll = () => {
    document.querySelectorAll('.tree li.collapsed').forEach(li => {
      li.classList.remove('collapsed');
      const icon = li.querySelector('.org-node .toggle-icon i');
      if (icon) icon.setAttribute('data-lucide', 'minus-circle');
    });
    lucide.createIcons();
  };

  return { toggleNode, expandAll };
})();

// ==========================================
// MODULE: Modal Management
// ==========================================

const ModalManager = (() => {
  const modal = document.getElementById('baganModal');
  const modalImg = document.getElementById('baganModalImg');
  const baganContainer = document.getElementById('baganContainer');
  const closeBtn = document.getElementById('closeModal');

  if (!modal || !modalImg || !baganContainer || !closeBtn) {
    console.warn('Modal elements not found');
    return {};
  }

  const open = (imgSrc) => {
    modalImg.src = imgSrc;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  };

  const close = () => {
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  };

  const init = () => {
    baganContainer.addEventListener('click', () => {
      const img = baganContainer.querySelector('img');
      if (img) open(img.src);
    });

    closeBtn.addEventListener('click', close);

    modal.addEventListener('click', (e) => {
      if (e.target === modal) close();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        close();
      }
    });
  };

  return { init, open, close };
})();

// ==========================================
// MODULE: Download Handler
// ==========================================

const DownloadHandler = (() => {
  const downloadBtn = document.getElementById('downloadBagan');

  if (!downloadBtn) {
    console.warn('Download button not found');
    return {};
  }

  const downloadImage = () => {
    const img = document.querySelector('#baganContainer img');
    if (!img) return;

    const link = document.createElement('a');
    link.href = img.src;
    link.download = 'bagan-struktur-organisasi-desa.jpg';
    link.click();
  };

  const init = () => {
    downloadBtn.addEventListener('click', downloadImage);
  };

  return { init, downloadImage };
})();

// ==========================================
// MODULE: AOS Initialization
// ==========================================

const AOSManager = (() => {
  const init = () => {
    if (typeof AOS !== 'undefined') {
      AOS.init({
        once: true,
        offset: 50,
        duration: 800,
        easing: 'ease-out-cubic',
      });
    } else {
      console.warn('AOS library not loaded');
    }
  };

  return { init };
})();

// ==========================================
// MODULE: Lucide Icons Initialization
// ==========================================

const IconsManager = (() => {
  const init = () => {
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    } else {
      console.warn('Lucide icons library not loaded');
    }
  };

  return { init };
})();

// ==========================================
// GLOBAL FUNCTIONS (For inline onclick handlers)
// ==========================================

function toggleNode(element) {
  TreeManager.toggleNode(element);
}

function expandAll() {
  TreeManager.expandAll();
}

// ==========================================
// INITIALIZATION
// ==========================================

document.addEventListener('DOMContentLoaded', () => {
  ModalManager.init();
  DownloadHandler.init();
  AOSManager.init();
  IconsManager.init();
});

// ==========================================
// UTILITY: Keyboard Navigation
// ==========================================

const baganContainer = document.getElementById('baganContainer');
if (baganContainer) {
  baganContainer.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      baganContainer.click();
    }
  });
}
