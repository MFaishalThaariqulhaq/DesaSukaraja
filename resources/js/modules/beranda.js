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

  // tsParticles - Background particle animation
  if (window.tsParticles && document.getElementById('tsparticles')) {
    tsParticles.load('tsparticles', {
      fpsLimit: 60,
      particles: {
        number: { value: 30, density: { enable: true, area: 800 } },
        color: { value: ['#ffffff', '#10b981'] },
        opacity: { value: 0.3, random: true },
        size: { value: { min: 1, max: 4 } },
        move: { enable: true, speed: 0.8, direction: 'none', outModes: 'out' },
        links: { enable: false },
      },
      detectRetina: true,
    });
  }
}
