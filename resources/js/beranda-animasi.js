// Inisialisasi animasi dan library eksternal untuk beranda
// AOS, Typed.js, tsParticles, VanillaTilt

document.addEventListener('DOMContentLoaded', function () {
  // Typed.js
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

  // VanillaTilt
  if (window.VanillaTilt) {
    VanillaTilt.init(document.querySelectorAll('.tilt-card'), {
      max: 5,
      speed: 400,
      glare: true,
      'max-glare': 0.2,
    });
  }

  // AOS
  if (window.AOS) {
    AOS.init({
      once: true,
      offset: 50,
      duration: 1000,
      easing: 'ease-out-cubic',
    });
  }

  // tsParticles
  if (window.tsParticles) {
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
});
