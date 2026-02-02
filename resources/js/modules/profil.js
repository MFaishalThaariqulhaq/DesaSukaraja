// Profil Module - Modal and download functionality

export function initProfil() {
  window.openStrukturModal = function () {
    document.getElementById('struktur-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  };

  window.closeStrukturModal = function (event) {
    if (event && event.target.id !== 'struktur-modal') return;
    document.getElementById('struktur-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
  };

  window.downloadStruktur = function () {
    const img = document.getElementById('struktur-modal-img');
    if (img && img.src) {
      const link = document.createElement('a');
      link.href = img.src;
      link.download = 'struktur-organisasi-desa-sukaraja.png';
      link.click();
    }
  };

  // Close modal when pressing Escape
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      window.closeStrukturModal();
    }
  });
}
