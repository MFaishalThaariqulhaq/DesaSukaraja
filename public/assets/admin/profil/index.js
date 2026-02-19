(function () {
  const TAB_STORAGE_KEY = 'admin.profil.activeTab';

  function refreshIcons() {
    if (window.lucide) {
      window.lucide.createIcons();
    }
  }

  window.closeAlert = function closeAlert() {
    const alert = document.getElementById('success-alert');
    if (!alert) {
      return;
    }

    alert.style.animation = 'profilSlideIn 0.5s ease reverse';
    setTimeout(function () {
      alert.remove();
    }, 500);
  };

  window.switchTab = function switchTab(tabId) {
    try {
      window.sessionStorage.setItem(TAB_STORAGE_KEY, tabId);
    } catch (error) {
      // Ignore storage errors (private mode or disabled storage)
    }

    document.querySelectorAll('.tab-content').forEach(function (el) {
      el.classList.add('hidden');
    });

    document.querySelectorAll('.tab-btn').forEach(function (el) {
      el.classList.remove('active-tab', 'text-emerald-600', 'border-emerald-500');
      el.classList.add('text-slate-600', 'border-transparent');
    });

    const selectedContent = document.getElementById('tab-' + tabId);
    if (selectedContent) {
      selectedContent.classList.remove('hidden');
    }

    const activeBtn = document.getElementById('btn-' + tabId);
    if (activeBtn) {
      activeBtn.classList.add('active-tab');
      activeBtn.classList.remove('text-slate-600', 'border-transparent');
    }

    refreshIcons();
  };

  window.toggleHistoryForm = function toggleHistoryForm() {
    const form = document.getElementById('history-form');
    if (form) {
      form.classList.toggle('hidden');
    }
  };

  document.addEventListener('DOMContentLoaded', function () {
    const urlTab = new URLSearchParams(window.location.search).get('tab');
    let savedTab = null;
    try {
      savedTab = window.sessionStorage.getItem(TAB_STORAGE_KEY);
    } catch (error) {
      savedTab = null;
    }

    const initialTab = urlTab || savedTab || 'beranda';
    const hasInitialTab = document.getElementById('tab-' + initialTab) && document.getElementById('btn-' + initialTab);
    window.switchTab(hasInitialTab ? initialTab : 'beranda');

    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
      setTimeout(function () {
        if (document.getElementById('success-alert')) {
          window.closeAlert();
        }
      }, 4000);
    }

    let cropper;
    const inputFoto = document.getElementById('foto_kades');
    const inputGambarProfil = document.getElementById('gambar');
    const inputTtdKades = document.getElementById('ttd_kades');
    const inputStruktur = document.getElementById('struktur_organisasi');
    const removeGambarProfil = document.getElementById('remove_gambar');
    const removeFotoKades = document.getElementById('remove_foto_kades');
    const removeTtdKades = document.getElementById('remove_ttd_kades');
    const removeStruktur = document.getElementById('remove_struktur_organisasi');
    const btnEditGambarProfil = document.getElementById('btn-edit-gambar-profil');
    const btnHapusGambarProfil = document.getElementById('btn-hapus-gambar-profil');
    const btnEditFotoKades = document.getElementById('btn-edit-foto-kades');
    const btnHapusFotoKades = document.getElementById('btn-hapus-foto-kades');
    const btnEditTtdKades = document.getElementById('btn-edit-ttd-kades');
    const btnHapusTtdKades = document.getElementById('btn-hapus-ttd-kades');
    const btnEditStruktur = document.getElementById('btn-edit-struktur');
    const btnHapusStruktur = document.getElementById('btn-hapus-struktur');
    const modal = document.getElementById('modal-cropper');
    const imageCropper = document.getElementById('image-cropper');
    const previewFoto = document.getElementById('preview-foto-kades');
    const previewGambarProfil = document.getElementById('preview-gambar-profil');
    const previewTtd = document.getElementById('preview-ttd-kades');
    const previewStruktur = document.getElementById('preview-struktur-organisasi');
    const btnCancel = document.getElementById('btn-crop-cancel');
    const btnApply = document.getElementById('btn-crop-apply');

    if (btnEditGambarProfil && inputGambarProfil) {
      btnEditGambarProfil.addEventListener('click', function () {
        inputGambarProfil.click();
      });
    }

    if (btnHapusGambarProfil && previewGambarProfil) {
      btnHapusGambarProfil.addEventListener('click', function () {
        const shouldRemove = window.confirm('Hapus gambar profil saat ini?');
        if (!shouldRemove) {
          return;
        }

        if (removeGambarProfil) {
          removeGambarProfil.checked = true;
        }

        if (inputGambarProfil) {
          inputGambarProfil.value = '';
        }

        if (previewGambarProfil.dataset.placeholder) {
          previewGambarProfil.src = previewGambarProfil.dataset.placeholder;
        }
      });
    }

    if (inputGambarProfil && previewGambarProfil) {
      inputGambarProfil.addEventListener('change', function (e) {
        const file = e.target.files && e.target.files[0];
        if (!file) {
          return;
        }

        if (removeGambarProfil) {
          removeGambarProfil.checked = false;
        }

        const reader = new FileReader();
        reader.onload = function (evt) {
          previewGambarProfil.src = evt.target.result;
        };
        reader.readAsDataURL(file);
      });
    }

    if (btnEditFotoKades && inputFoto) {
      btnEditFotoKades.addEventListener('click', function () {
        inputFoto.click();
      });
    }

    if (btnHapusFotoKades && previewFoto) {
      btnHapusFotoKades.addEventListener('click', function () {
        const shouldRemove = window.confirm('Hapus foto kepala desa saat ini?');
        if (!shouldRemove) {
          return;
        }

        if (removeFotoKades) {
          removeFotoKades.checked = true;
        }

        if (inputFoto) {
          inputFoto.value = '';
        }

        if (previewFoto.dataset.placeholder) {
          previewFoto.src = previewFoto.dataset.placeholder;
        }
      });
    }

    if (inputFoto && imageCropper && modal) {
      inputFoto.addEventListener('change', function (e) {
        const file = e.target.files && e.target.files[0];
        if (!file) {
          return;
        }

        if (removeFotoKades) {
          removeFotoKades.checked = false;
        }

        if (!window.Cropper) {
          const readerNoCrop = new FileReader();
          readerNoCrop.onload = function (evt) {
            if (previewFoto) {
              previewFoto.src = evt.target.result;
            }
          };
          readerNoCrop.readAsDataURL(file);
          return;
        }

        const reader = new FileReader();
        reader.onload = function (evt) {
          imageCropper.onload = function () {
            if (cropper) {
              cropper.destroy();
            }
            cropper = new window.Cropper(imageCropper, {
              aspectRatio: 3 / 4,
              viewMode: 1,
              autoCropArea: 1,
            });
          };
          imageCropper.src = evt.target.result;
          modal.style.display = 'flex';
        };
        reader.readAsDataURL(file);
      });
    }

    if (btnCancel && modal) {
      btnCancel.addEventListener('click', function () {
        modal.style.display = 'none';
        if (cropper) {
          cropper.destroy();
          cropper = null;
        }
        if (inputFoto) {
          inputFoto.value = '';
        }
      });
    }

    if (btnApply && previewFoto && inputFoto && modal) {
      btnApply.addEventListener('click', function () {
        if (!cropper) {
          return;
        }

        cropper
          .getCroppedCanvas({ width: 300, height: 400 })
          .toBlob(function (blob) {
            const url = URL.createObjectURL(blob);
            previewFoto.src = url;

            const dt = new DataTransfer();
            dt.items.add(new File([blob], 'cropped.jpg', { type: blob.type }));
            inputFoto.files = dt.files;

            if (removeFotoKades) {
              removeFotoKades.checked = false;
            }

            modal.style.display = 'none';
            cropper.destroy();
            cropper = null;
          }, 'image/jpeg', 0.95);
      });
    }

    if (inputTtdKades) {
      if (btnEditTtdKades) {
        btnEditTtdKades.addEventListener('click', function () {
          inputTtdKades.click();
        });
      }

      if (btnHapusTtdKades && previewTtd) {
        btnHapusTtdKades.addEventListener('click', function () {
          const shouldRemove = window.confirm('Hapus tanda tangan kepala desa saat ini?');
          if (!shouldRemove) {
            return;
          }

          if (removeTtdKades) {
            removeTtdKades.checked = true;
          }

          inputTtdKades.value = '';
          if (previewTtd.dataset.placeholder) {
            previewTtd.src = previewTtd.dataset.placeholder;
          }
        });
      }

      inputTtdKades.addEventListener('change', function (e) {
        const file = e.target.files && e.target.files[0];
        if (!file) {
          return;
        }

        if (removeTtdKades) {
          removeTtdKades.checked = false;
        }

        const reader = new FileReader();
        reader.onload = function (evt) {
          if (previewTtd) {
            previewTtd.src = evt.target.result;
          }
        };
        reader.readAsDataURL(file);
      });
    }

    if (inputStruktur && previewStruktur) {
      if (btnEditStruktur) {
        btnEditStruktur.addEventListener('click', function () {
          inputStruktur.click();
        });
      }

      if (btnHapusStruktur) {
        btnHapusStruktur.addEventListener('click', function () {
          const shouldRemove = window.confirm('Hapus gambar struktur organisasi saat ini?');
          if (!shouldRemove) {
            return;
          }

          if (removeStruktur) {
            removeStruktur.checked = true;
          }

          inputStruktur.value = '';
          if (previewStruktur.dataset.placeholder) {
            previewStruktur.src = previewStruktur.dataset.placeholder;
          }
        });
      }

      inputStruktur.addEventListener('change', function (e) {
        const file = e.target.files && e.target.files[0];
        if (!file) {
          return;
        }

        if (removeStruktur) {
          removeStruktur.checked = false;
        }

        const reader = new FileReader();
        reader.onload = function (evt) {
          previewStruktur.src = evt.target.result;
        };
        reader.readAsDataURL(file);
      });
    }

    refreshIcons();
  });
})();
