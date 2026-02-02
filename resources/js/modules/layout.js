// Layout Module - Header scroll effect and mobile menu toggle

export function initLayout() {
  // Initialize Lucide icons
  if (window.lucide) {
    lucide.createIcons();
  }

  // Header shadow on scroll
  const header = document.getElementById('main-header');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 10) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  }

  // Toggle mobile menu
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', function () {
      mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking a link
    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function () {
        mobileMenu.classList.add('hidden');
      });
    });
  }

  // Counter animation for statistics
  initCounterAnimation();
}

function initCounterAnimation() {
  const counters = document.querySelectorAll('.counter');
  if (counters.length === 0) return;

  const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
        const target = parseInt(entry.target.getAttribute('data-target'), 10);
        animateCounter(entry.target, target);
        entry.target.classList.add('counted');
      }
    });
  }, observerOptions);

  counters.forEach(counter => observer.observe(counter));
}

function animateCounter(element, target) {
  const duration = 2000; // 2 seconds
  const start = 0;
  const increment = target / (duration / 16); // 60fps
  let current = start;

  const updateCounter = () => {
    current += increment;
    if (current < target) {
      element.textContent = Math.floor(current).toLocaleString('id-ID');
      requestAnimationFrame(updateCounter);
    } else {
      element.textContent = target.toLocaleString('id-ID');
    }
  };

  updateCounter();
}
