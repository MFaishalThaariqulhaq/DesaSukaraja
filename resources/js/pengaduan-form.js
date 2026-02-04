/**
 * Pengaduan Form Handler
 * 
 * Mengelola form pengaduan dengan:
 * - reCAPTCHA integration
 * - File upload handling with animations
 * - Form validation
 * - Icon initialization (Lucide)
 */

document.addEventListener('DOMContentLoaded', function () {
  // ===== File Upload Handler =====
  function updateFileName(input) {
    const label = document.getElementById('file-label');
    const parent = input.parentElement.querySelector('div');

    if (input.files && input.files.length > 0) {
      const fileName = input.files[0].name;
      label.innerHTML = `<span class="text-emerald-600 font-bold block truncate max-w-xs mx-auto">${fileName}</span>`;
      parent.classList.remove('border-slate-300', 'bg-slate-50');
      parent.classList.add('border-emerald-500', 'bg-emerald-50');
    } else {
      label.innerHTML = 'Klik untuk unggah atau seret file ke sini';
      parent.classList.add('border-slate-300', 'bg-slate-50');
      parent.classList.remove('border-emerald-500', 'bg-emerald-50');
    }
  }

  // Make updateFileName globally accessible
  window.updateFileName = updateFileName;

  // ===== reCAPTCHA Handler =====
  if (typeof grecaptcha !== 'undefined') {
    const form = document.getElementById('pengaduanForm');

    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();

        const submitBtn = document.getElementById('submitBtn');
        const originalHTML = submitBtn.innerHTML;

        // Loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
          <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Mengirim...
        `;

        grecaptcha.ready(function () {
          grecaptcha.execute('{{ config("services.recaptcha.site_key") }}', { action: 'submit' }).then(function (token) {
            document.getElementById('recaptchaResponse').value = token;
            form.submit();
          });
        });
      });
    }
  }

  // ===== Initialize Lucide Icons =====
  if (window.lucide) {
    lucide.createIcons();
  }
});
