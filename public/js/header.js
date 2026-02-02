// Header Mobile Menu & Scroll Effects

document.addEventListener('DOMContentLoaded', function () {
  // Initialize Lucide icons
  if (window.lucide) lucide.createIcons();

  // Mobile Menu Toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const header = document.getElementById('main-header');

  if (mobileMenuButton) {
    mobileMenuButton.addEventListener('click', function () {
      mobileMenu.classList.toggle('active');
    });
  }

  // Close mobile menu when clicking a link
  if (mobileMenu) {
    const menuLinks = mobileMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
      link.addEventListener('click', function () {
        mobileMenu.classList.remove('active');
      });
    });
  }

  // Close mobile menu when clicking outside
  document.addEventListener('click', function (event) {
    const isClickInside = mobileMenu && mobileMenu.contains(event.target);
    const isClickOnButton = mobileMenuButton && mobileMenuButton.contains(event.target);

    if (!isClickInside && !isClickOnButton && mobileMenu) {
      mobileMenu.classList.remove('active');
    }
  });

  // Header Scroll Effect
  let lastScrollTop = 0;

  window.addEventListener('scroll', function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  });

  // Active nav link based on current page
  const currentLocation = location.pathname;
  const navLinks = document.querySelectorAll('nav a, #mobile-menu a');

  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (currentLocation.includes(href) && href !== '/') {
      link.classList.add('active');
    }
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href').slice(1);
      const target = document.getElementById(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
});
