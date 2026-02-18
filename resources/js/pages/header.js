/**
 * Header Module - Handles navigation, mobile menu, and modal interactions
 * This file contains all header functionality previously inline in header.blade.php
 */

export function initHeader() {
  // Initialize Lucide icons
  if (window.lucide) {
    lucide.createIcons();
  }

  initHeaderScroll();
  initMobileMenu();
  initModalButtons();
  initSmoothScroll();
  initActiveNavigation();
}

/**
 * Header scroll effect - add shadow when scrolling down
 */
function initHeaderScroll() {
  const header = document.getElementById('main-header');
  if (!header) return;

  requestAnimationFrame(() => {
    header.classList.add('header-ready');
  });

  window.addEventListener('scroll', function () {
    if (window.scrollY > 20) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
}

/**
 * Mobile menu toggle functionality
 */
function initMobileMenu() {
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  if (!mobileMenuButton || !mobileMenu) return;

  // Toggle menu on button click
  mobileMenuButton.addEventListener('click', function (e) {
    e.stopPropagation();
    const isHidden = mobileMenu.classList.contains('hidden');

    if (isHidden) {
      openMobileMenu();
    } else {
      closeMobileMenu();
    }
  });

  // Close menu when clicking on links
  mobileMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function () {
      closeMobileMenu();
    });
  });

  // Close menu when clicking outside
  document.addEventListener('click', function (e) {
    if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
      if (!mobileMenu.classList.contains('hidden')) {
        closeMobileMenu();
      }
    }
  });
}

/**
 * Open mobile menu and update icon
 */
function openMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileMenuButton = document.getElementById('mobile-menu-button');

  mobileMenu.classList.remove('hidden');
  mobileMenu.classList.remove('mobile-menu-closing');
  requestAnimationFrame(() => {
    mobileMenu.classList.add('mobile-menu-open');
  });

  const icon = mobileMenuButton.querySelector('i');
  if (icon) {
    icon.setAttribute('data-lucide', 'x');
    if (window.lucide) lucide.createIcons();
  }
}

/**
 * Close mobile menu and update icon
 */
function closeMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileMenuButton = document.getElementById('mobile-menu-button');

  mobileMenu.classList.remove('mobile-menu-open');
  mobileMenu.classList.add('mobile-menu-closing');
  setTimeout(() => {
    if (!mobileMenu.classList.contains('mobile-menu-open')) {
      mobileMenu.classList.add('hidden');
      mobileMenu.classList.remove('mobile-menu-closing');
    }
  }, 220);

  const icon = mobileMenuButton.querySelector('i');
  if (icon) {
    icon.setAttribute('data-lucide', 'menu');
    if (window.lucide) lucide.createIcons();
  }
}

/**
 * Modal button click handlers - trigger pengaduan modal
 */
function initModalButtons() {
  const openModalBtn = document.getElementById('openPengaduanModalBtn');
  const openModalBtnMobile = document.getElementById('openPengaduanModalBtnMobile');
  const mobileMenu = document.getElementById('mobile-menu');

  const openModal = () => {
    const modal = document.getElementById('pengaduanModal');
    if (modal) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';

      if (window.lucide) lucide.createIcons();

      // Trigger modal animation
      const modalContent = modal.querySelector('#pengaduanContent');
      if (modalContent) {
        modalContent.classList.add('animate-modal-entry');
      }
    }
  };

  if (openModalBtn) {
    openModalBtn.addEventListener('click', function (e) {
      e.preventDefault();
      openModal();
    });
  }

  if (openModalBtnMobile) {
    openModalBtnMobile.addEventListener('click', function (e) {
      e.preventDefault();
      openModal();

      // Close mobile menu after opening modal
      if (mobileMenu) {
        closeMobileMenu();
      }
    });
  }

}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href').slice(1);
      const target = document.getElementById(targetId);

      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });

        // Close mobile menu if open
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
          closeMobileMenu();
        }
      }
    });
  });
}

/**
 * Active navigation link highlighting based on current path
 */
function initActiveNavigation() {
  const navLinks = document.querySelectorAll('nav a[href^="/"]');
  const mobileNavLinks = document.querySelectorAll('#mobile-menu a[href^="/"]');
  const currentPath = window.location.pathname;

  const updateActiveLink = (link) => {
    const href = link.getAttribute('href');
    const isActive =
      (href === '/' && currentPath === '/') ||
      (href !== '/' && currentPath.startsWith(href));

    if (isActive) {
      link.classList.remove('text-slate-600', 'hover:text-emerald-600');
      link.classList.add('text-emerald-600', 'font-semibold');
    } else {
      link.classList.remove('text-emerald-600', 'font-semibold');
      link.classList.add('text-slate-600', 'hover:text-emerald-600');
    }
  };

  navLinks.forEach(updateActiveLink);
  mobileNavLinks.forEach(link => {
    const href = link.getAttribute('href');
    const isActive =
      (href === '/' && currentPath === '/') ||
      (href !== '/' && currentPath.startsWith(href));

    if (isActive) {
      link.classList.remove('text-slate-600');
      link.classList.add('text-emerald-600', 'font-semibold', 'bg-emerald-50');
    } else {
      link.classList.remove('text-emerald-600', 'font-semibold', 'bg-emerald-50');
      link.classList.add('text-slate-600');
    }
  });
}
