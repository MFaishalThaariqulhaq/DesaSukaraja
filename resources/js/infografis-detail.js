// Initialize AOS animations and Lucide icons on DOM loaded
document.addEventListener('DOMContentLoaded', () => {
  // Initialize AOS
  if (window.AOS) {
    AOS.init({
      once: true,
      duration: 800,
      easing: 'ease-out-cubic'
    });
  }

  // Initialize Lucide icons
  if (window.lucide) {
    lucide.createIcons();
  }
});
