// Pengaduan Module - Form handling and reCAPTCHA

export function initPengaduan() {
  const form = document.getElementById('pengaduanForm');

  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Generate reCAPTCHA token v3
    if (window.grecaptcha) {
      grecaptcha.ready(function () {
        grecaptcha.execute(document.querySelector('meta[name="recaptcha-key"]')?.content || '', { action: 'submit' }).then(function (token) {
          // Set token ke hidden field
          document.getElementById('recaptchaResponse').value = token;
          // Submit form
          form.submit();
        });
      });
    } else {
      // Fallback if reCAPTCHA tidak tersedia
      form.submit();
    }
  });
}
