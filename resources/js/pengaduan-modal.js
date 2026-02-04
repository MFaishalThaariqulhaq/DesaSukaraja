document.addEventListener('DOMContentLoaded', function () {
  // ===== Element References =====
  const modal = document.getElementById('pengaduanModal');
  const modalContent = document.getElementById('pengaduanContent');
  const closeBtn = document.getElementById('closeModalBtn');
  const openBtn = document.getElementById('openPengaduanModalBtn');
  const openBtnMobile = document.getElementById('openPengaduanModalBtnMobile');

  // Early exit jika modal tidak ditemukan
  if (!modal) return;

  // ===== Core Functions =====

  function openModal() {
    modal.classList.remove('hidden');
    modal.classList.add('active');
    modalContent.classList.add('animate-modal-entry');
    document.body.style.overflow = 'hidden';
    if (window.lucide) lucide.createIcons();
  }

  /**
   * Menutup modal dengan smooth animation
   * - Menghapus class 'active' untuk fade-out effect
   * - Delay sebelum menambah 'hidden' untuk animation duration
   * - Membuka scroll kembali pada body
   */
  function closeModal() {
    modal.classList.remove('active');
    setTimeout(() => {
      modal.classList.add('hidden');
    }, 300); // Sesuai dengan CSS transition duration
    document.body.style.overflow = 'auto';
  }

  // ===== Event Listeners =====

  /**
   * Desktop button - Trigger modal open
   */
  if (openBtn) {
    openBtn.addEventListener('click', function (e) {
      e.preventDefault();
      openModal();
    });
  }

  /**
   * Mobile button - Trigger modal open
   */
  if (openBtnMobile) {
    openBtnMobile.addEventListener('click', function (e) {
      e.preventDefault();
      openModal();
    });
  }

  /**
   * Close button (X) - Trigger modal close
   */
  if (closeBtn) {
    closeBtn.addEventListener('click', closeModal);
  }

  /**
   * Backdrop click - Close modal jika klik di area gelap
   * (tidak menutup jika klik di content)
   */
  modal.addEventListener('click', function (e) {
    if (e.target === modal) {
      closeModal();
    }
  });

  /**
   * Keyboard support - ESC key untuk menutup modal
   */
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      closeModal();
    }
  });
});
