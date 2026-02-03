/**
 * Infografis Detail Page Initialization
 * Handles AOS animations, Lucide icons, and Chart.js initialization
 */

// Initialize AOS (Animate On Scroll)
export function initAOS() {
  if (window.AOS) {
    AOS.init({
      duration: 800,
      once: false,
      mirror: true
    });
  }
}

// Render Lucide icons
export function initLucideIcons() {
  if (window.lucide) {
    lucide.createIcons();
  }
}

// Initialize all infografis features
export function initInfografis() {
  initAOS();
  initLucideIcons();
  
  // Import chart initialization
  import('./infografis-detail.js').catch(err => {
    console.error('Failed to load infografis-detail:', err);
  });
}

// Run initialization when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initInfografis);
} else {
  initInfografis();
}
