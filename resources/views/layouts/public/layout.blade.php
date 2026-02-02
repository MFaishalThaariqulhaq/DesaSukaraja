<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Desa Sukaraja')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  
  @stack('styles')

  <!-- Vite Entry Point -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-700">
  <!-- Preloader -->
  <div id="preloader">
    <div class="flex flex-col items-center gap-4">
      <div class="loader-spinner"></div>
      <p class="text-emerald-600 font-bold tracking-widest text-sm animate-pulse">MEMUAT...</p>
    </div>
  </div>
  @include('components.public.header')
  <div class="pt-24">
    @yield('content')
  </div>
  @include('components.public.footer')
  @stack('scripts')
</body>
</html>
