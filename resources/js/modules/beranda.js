// Beranda Module - Initialize beranda-specific animations and libraries
// AOS, Typed.js, tsParticles, VanillaTilt

export function initBeranda() {
  // Check if we're on beranda page
  const berandaSection = document.getElementById('beranda');
  if (!berandaSection) return;

  // Typed.js - Animated text
  if (window.Typed && document.getElementById('typed-text')) {
    new Typed('#typed-text', {
      strings: [
        'Pemerintahan Transparan',
        'Layanan Publik Cepat',
        'Masyarakat Sejahtera',
        'Ekonomi Mandiri'
      ],
      typeSpeed: 50,
      backSpeed: 30,
      backDelay: 2000,
      loop: true,
      cursorChar: '|',
    });
  }

  // VanillaTilt - 3D card tilt effect
  if (window.VanillaTilt) {
    const tiltElements = document.querySelectorAll('.tilt-card');
    if (tiltElements.length > 0) {
      VanillaTilt.init(tiltElements, {
        max: 5,
        speed: 400,
        glare: true,
        'max-glare': 0.2,
      });
    }
  }

  // tsParticles - Background particle animation (deferred and lighter on mobile)
  const particlesTarget = document.getElementById('tsparticles');
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isSmallScreen = window.matchMedia('(max-width: 768px)').matches;

  if (!prefersReducedMotion && window.tsParticles && particlesTarget) {
    const loadParticles = () => {
      tsParticles.load('tsparticles', {
        fpsLimit: isSmallScreen ? 30 : 45,
        particles: {
          number: { value: isSmallScreen ? 14 : 24, density: { enable: true, area: 900 } },
          color: { value: ['#ffffff', '#10b981'] },
          opacity: { value: 0.25, random: true },
          size: { value: { min: 1, max: 3 } },
          move: { enable: true, speed: isSmallScreen ? 0.4 : 0.7, direction: 'none', outModes: 'out' },
          links: { enable: false },
        },
        detectRetina: true,
      });
    };

    if ('requestIdleCallback' in window) {
      requestIdleCallback(loadParticles, { timeout: 1200 });
    } else {
      setTimeout(loadParticles, 600);
    }
  }
}
