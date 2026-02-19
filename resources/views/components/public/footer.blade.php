<footer class="public-footer font-sans text-sm">
  <div class="container mx-auto px-6">
    <div class="public-footer__top py-14 md:py-16">
      <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-5 space-y-5">
          <div class="flex items-center gap-3">
            <div class="public-footer-brandmark">
              <img src="{{ asset('images/logo.png') }}" alt="Logo Desa Sukaraja" class="w-8 h-8 object-contain brightness-0 invert opacity-90">
            </div>
            <div>
              <h4 class="public-footer-title">Desa Sukaraja</h4>
              <p class="public-footer-subtitle">Kabupaten Karawang</p>
            </div>
          </div>

          <p class="public-footer-muted leading-relaxed max-w-md">
            Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan melayani dengan integritas tinggi.
          </p>
        </div>

        <div class="lg:col-span-7">
          <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <section class="public-footer-card">
              <h5 class="public-footer-heading">Kontak Kami</h5>
              <ul class="space-y-3.5 mt-4">
                <li class="flex items-start gap-2.5">
                  <i data-lucide="map-pin" class="public-footer-icon mt-0.5"></i>
                  <span class="public-footer-muted">Jl. Jenderal A. Yani No. 1 Karawang</span>
                </li>
                <li class="flex items-center gap-2.5">
                  <i data-lucide="mail" class="public-footer-icon"></i>
                  <span class="public-footer-muted">info@karawangkab.go.id</span>
                </li>
                <li class="flex items-center gap-2.5">
                  <i data-lucide="phone" class="public-footer-icon"></i>
                  <span class="public-footer-muted">0267-429800</span>
                </li>
              </ul>
            </section>

            <section class="public-footer-card">
              <h5 class="public-footer-heading">Jam Pelayanan</h5>
              <ul class="space-y-3 mt-4">
                <li class="flex items-center justify-between gap-2">
                  <span class="public-footer-muted">Senin - Kamis</span>
                  <span class="public-footer-badge">08:00 - 15:00</span>
                </li>
                <li class="flex items-center justify-between gap-2">
                  <span class="public-footer-muted">Jumat</span>
                  <span class="public-footer-badge">08:00 - 11:00</span>
                </li>
                <li class="flex items-center justify-between gap-2">
                  <span class="public-footer-muted">Sabtu - Minggu</span>
                  <span class="public-footer-badge is-off">Libur</span>
                </li>
              </ul>
            </section>

            <section class="public-footer-card sm:col-span-2 xl:col-span-1">
              <h5 class="public-footer-heading">Tautan Cepat</h5>
              <ul class="space-y-2.5 mt-4">
                <li>
                  <a href="{{ route('profil') }}" class="public-footer-link">
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    Profil Desa
                  </a>
                </li>
                <li>
                  <a href="{{ route('galeri.index') }}" class="public-footer-link">
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    Galeri
                  </a>
                </li>
                <li>
                  <a href="{{ route('infografis.index') }}" class="public-footer-link">
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    Infografis
                  </a>
                </li>
                <li>
                  <a href="{{ route('pengaduan.index') }}" class="public-footer-link">
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    Layanan Pengaduan
                  </a>
                </li>
              </ul>
            </section>
          </div>
        </div>
      </div>
    </div>

    <div class="public-footer__bottom py-6">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <p class="public-footer-fine">&copy; {{ now()->year }} Pemerintah Desa Sukaraja. Hak Cipta Dilindungi.</p>

        <div class="flex flex-wrap items-center gap-4 md:gap-5">
          <a href="#" class="public-footer-fine-link">Kebijakan Privasi</a>
          <a href="#" class="public-footer-fine-link">Syarat & Ketentuan</a>
          <span class="hidden sm:block h-4 w-px bg-slate-500/40" aria-hidden="true"></span>
          <div class="flex items-center gap-2.5">
            <a href="#" class="public-footer-social" aria-label="Facebook Desa Sukaraja">
              <i data-lucide="facebook" class="w-4 h-4"></i>
            </a>
            <a href="#" class="public-footer-social" aria-label="Instagram Desa Sukaraja">
              <i data-lucide="instagram" class="w-4 h-4"></i>
            </a>
            <a href="#" class="public-footer-social" aria-label="Youtube Desa Sukaraja">
              <i data-lucide="youtube" class="w-4 h-4"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
