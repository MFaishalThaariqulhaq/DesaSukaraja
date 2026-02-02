// Libraries Module - Initialize external libraries (AOS, Typed.js, tsParticles, etc)

export function initLibraries() {
  // AOS (Animate On Scroll)
  if (window.AOS) {
    AOS.init({
      duration: 1000,
      once: true,
      offset: 50,
      easing: 'ease-out-cubic',
      delay: 50
    });
  }

  // Refresh AOS when new content is loaded (for SPA or dynamic content)
  document.addEventListener('DOMContentLoaded', function () {
    if (window.AOS) {
      AOS.refreshHard();
    }
  });
}
