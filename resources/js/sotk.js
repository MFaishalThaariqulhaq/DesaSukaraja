// SOTK Page Modal and Interactions
document.addEventListener('DOMContentLoaded', function() {
  const baganContainer = document.getElementById('baganContainer');
  const baganModal = document.getElementById('baganModal');
  const baganModalImg = document.getElementById('baganModalImg');
  const closeModal = document.getElementById('closeModal');
  const downloadBagan = document.getElementById('downloadBagan');

  // Open modal when clicking bagan image or button
  if (baganContainer) {
    baganContainer.addEventListener('click', function() {
      const img = this.querySelector('img');
      if (img && img.src) {
        baganModalImg.src = img.src;
        baganModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }
    });
  }

  // Close modal
  if (closeModal) {
    closeModal.addEventListener('click', closeModalHandler);
  }

  // Close modal when clicking outside
  if (baganModal) {
    baganModal.addEventListener('click', function(e) {
      if (e.target === this) {
        closeModalHandler();
      }
    });
  }

  // Close modal on Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !baganModal.classList.contains('hidden')) {
      closeModalHandler();
    }
  });

  function closeModalHandler() {
    baganModal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  }

  // Download handler (placeholder for future implementation)
  if (downloadBagan) {
    downloadBagan.addEventListener('click', function() {
      // Placeholder: dapat diimplementasikan untuk generate/download PDF
      console.log('Download functionality dapat diimplementasikan');
    });
  }
});
