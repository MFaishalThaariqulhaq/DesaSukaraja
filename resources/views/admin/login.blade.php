<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin Desa Sukaraja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#ecfdf5',
              100: '#d1fae5',
              500: '#10b981',
              600: '#059669',
              700: '#047857',
            }
          },
          fontFamily: {
            sans: ['Manrope', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>

<body class="min-h-screen bg-slate-950 text-slate-800 antialiased">
  <div class="relative min-h-screen overflow-hidden">
    <div class="absolute -top-28 -left-24 h-80 w-80 rounded-full bg-primary-500/35 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-16 h-96 w-96 rounded-full bg-cyan-400/25 blur-3xl"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,0.1),transparent_45%)]"></div>

    <main class="relative z-10 mx-auto grid min-h-screen w-full max-w-6xl items-center px-4 py-8 md:grid-cols-2 md:px-8">
      <section class="hidden md:block md:pr-10">
        <p class="mb-4 inline-flex items-center rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white/90">
          Panel Administrasi
        </p>
        <h1 class="text-4xl font-extrabold leading-tight text-white lg:text-5xl">
          Admin Sukaraja
        </h1>
        <p class="mt-4 max-w-md text-sm leading-relaxed text-slate-200/90">
          Kelola informasi desa, konten publikasi, dan data layanan masyarakat dari satu dashboard terpadu.
        </p>
      </section>

      <section class="w-full">
        <div class="mx-auto w-full max-w-md rounded-3xl border border-white/35 bg-white/95 p-7 shadow-2xl backdrop-blur md:p-8">
          <div class="mb-7 text-center">
            <h2 class="text-2xl font-extrabold text-slate-900">Masuk ke Admin</h2>
            <p class="mt-1 text-sm text-slate-500">Gunakan akun admin yang terdaftar</p>
          </div>

          @if($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
              {{ $errors->first() }}
            </div>
          @endif

          <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
              <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
              <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100"
                placeholder="nama@email.com"
                required>
            </div>

            <div>
              <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
              <div class="relative">
                <input
                  type="password"
                  name="password"
                  id="password"
                  class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 pr-11 text-sm outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100"
                  placeholder="Masukkan password"
                  required>
                <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 px-3 text-slate-500 hover:text-slate-700" aria-label="Lihat password">
                  <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                    <circle cx="12" cy="12" r="3" />
                  </svg>
                  <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m4 4 16 16" />
                    <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83" />
                    <path d="M9.363 5.365A9.466 9.466 0 0 1 12 5c4.478 0 8.268 2.943 9.543 7a9.774 9.774 0 0 1-1.563 3.029" />
                    <path d="M6.378 6.378A9.732 9.732 0 0 0 2.458 12 9.772 9.772 0 0 0 12 19c1.9 0 3.668-.548 5.163-1.496" />
                  </svg>
                </button>
              </div>
            </div>

            <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs text-amber-800">
              Lupa password? Hubungi <strong>Super Admin</strong> untuk reset dari menu <strong>Kelola Admin</strong>.
            </div>

            <button type="submit" class="w-full rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-100">
              Login
            </button>
          </form>
        </div>
      </section>
    </main>
  </div>

  <script>
    const passwordInput = document.getElementById('password');
    const toggleButton = document.getElementById('toggle-password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');

    if (passwordInput && toggleButton && eyeOpen && eyeClosed) {
      toggleButton.addEventListener('click', () => {
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        eyeOpen.classList.toggle('hidden', isHidden);
        eyeClosed.classList.toggle('hidden', !isHidden);
        toggleButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Lihat password');
      });
    }
  </script>
</body>

</html>
