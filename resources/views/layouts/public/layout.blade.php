<!DOCTYPE html>
<html lang="id" style="scroll-behavior: smooth;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Desa Sukaraja')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  
  @stack('styles')

  <!-- Vite Entry Point -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-700" style="scroll-behavior: smooth;">
  <!-- Preloader -->
  <div id="preloader">
    <div class="flex flex-col items-center gap-4">
      <div class="loader-spinner"></div>
      <p class="text-emerald-600 font-bold tracking-widest text-sm animate-pulse">MEMUAT...</p>
    </div>
  </div>
  @include('components.public.header')
  @include('components.public.pengaduan-modal')
  <div class="pt-24">
    @yield('content')
  </div>
  @include('components.public.footer')
  
  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
  @stack('scripts')
  
  <script>
    // Smooth navigation helper function for anchor links
    function smoothNavigateTo(e, path, hash) {
      e.preventDefault();
      
      // If already on same page, just smooth scroll to anchor
      if (window.location.pathname === path) {
        const element = document.querySelector(hash);
        if (element) {
          element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      } else {
        // Navigate to new page and store hash in sessionStorage for scroll on load
        sessionStorage.setItem('scrollToHash', hash);
        window.location.href = path + hash;
      }
    }
    
    // Auto scroll on page load if hash is in sessionStorage
    window.addEventListener('load', function() {
      const hash = sessionStorage.getItem('scrollToHash');
      if (hash) {
        sessionStorage.removeItem('scrollToHash');
        setTimeout(() => {
          const element = document.querySelector(hash);
          if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }, 100);
      }
    });
  </script>
</body>
</html>
