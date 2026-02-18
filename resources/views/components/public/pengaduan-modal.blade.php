<!-- Modal Backdrop -->
<div id="pengaduanModal" class="modal-backdrop hidden fixed inset-0 z-40 flex items-center justify-center p-4 bg-black/60" role="dialog" aria-modal="true" aria-labelledby="modalTitle">

  <!-- Modal Content - Compact Size -->
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all relative overflow-hidden flex flex-col" id="pengaduanContent">

    {{-- Header Section --}}
    <div class="relative bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-8 overflow-hidden flex-shrink-0">
      
      {{-- Decorative Background Elements --}}
      <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white/10 blur-lg"></div>
      <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-20 h-20 rounded-full bg-black/5 blur-md"></div>

      {{-- Close Button --}}
      <button id="closeModalBtn" class="absolute top-4 right-4 p-1.5 hover:bg-white/20 text-white rounded-lg transition-colors z-10" aria-label="Tutup modal">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>

      {{-- Header Title --}}
      <div class="flex items-center gap-3 relative z-10">
        <div class="p-2 bg-white/20 rounded-lg">
          <i data-lucide="message-square" class="w-5 h-5 text-white"></i>
        </div>
        <div>
          <h2 id="modalTitle" class="text-xl font-bold text-white">Layanan Pengaduan</h2>
          <p class="text-emerald-100 text-xs mt-1">Pilih layanan yang dibutuhkan</p>
        </div>
      </div>
    </div>

    {{-- Body Section: Service Cards --}}
    <div class="p-6 space-y-3 overflow-y-auto">

      {{-- Card 1: Buat Pengaduan --}}
      <a href="{{ route('pengaduan.index') }}" class="group relative block">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl border border-emerald-200 group-hover:shadow-lg transition-all"></div>
        <div class="relative p-4 flex items-start gap-3 z-10">
          <div class="p-2.5 bg-emerald-600 text-white rounded-lg flex-shrink-0 group-hover:bg-emerald-700 transition-colors">
            <i data-lucide="file-plus" class="w-5 h-5"></i>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="font-semibold text-slate-800 group-hover:text-emerald-700 transition-colors text-sm">Buat Pengaduan</h3>
            <p class="text-slate-600 text-xs mt-0.5">Ajukan laporan atau keluhan</p>
          </div>
          <i data-lucide="arrow-right" class="w-4 h-4 text-emerald-600 flex-shrink-0 group-hover:translate-x-1 transition-transform"></i>
        </div>
      </a>

      {{-- Card 2: Cek Status --}}
      <a href="{{ route('pengaduan.status') }}" class="group relative block">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 group-hover:shadow-lg transition-all"></div>
        <div class="relative p-4 flex items-start gap-3 z-10">
          <div class="p-2.5 bg-blue-600 text-white rounded-lg flex-shrink-0 group-hover:bg-blue-700 transition-colors">
            <i data-lucide="search" class="w-5 h-5"></i>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="font-semibold text-slate-800 group-hover:text-blue-700 transition-colors text-sm">Cek Status</h3>
            <p class="text-slate-600 text-xs mt-0.5">Pantau status pengaduan Anda</p>
          </div>
          <i data-lucide="arrow-right" class="w-4 h-4 text-blue-600 flex-shrink-0 group-hover:translate-x-1 transition-transform"></i>
        </div>
      </a>

      {{-- Card 3: Lihat Daftar --}}
      <a href="{{ route('pengaduan.list') }}" class="group relative block">
        <div class="absolute inset-0 bg-gradient-to-br from-rose-50 to-red-50 rounded-xl border border-rose-200 group-hover:shadow-lg transition-all"></div>
        <div class="relative p-4 flex items-start gap-3 z-10">
          <div class="p-2.5 bg-rose-600 text-white rounded-lg flex-shrink-0 group-hover:bg-rose-700 transition-colors">
            <i data-lucide="list" class="w-5 h-5"></i>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="font-semibold text-slate-800 group-hover:text-rose-700 transition-colors text-sm">Lihat Daftar</h3>
            <p class="text-slate-600 text-xs mt-0.5">Lihat semua laporan yang masuk</p>
          </div>
          <i data-lucide="arrow-right" class="w-4 h-4 text-rose-600 flex-shrink-0 group-hover:translate-x-1 transition-transform"></i>
        </div>
      </a>

    </div>

    {{-- Footer Section --}}
    <div class="bg-slate-50 px-6 py-3 border-t border-slate-100 text-center flex-shrink-0">
      <p class="text-xs text-slate-500">Tekan <kbd class="font-mono text-slate-600">ESC</kbd> untuk menutup</p>
    </div>

  </div>
</div>
{{-- Component Styles --}}
@push('styles')
<style>
  /**
   * Modal Backdrop Styles
   */
  .modal-backdrop {
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    opacity: 0;
    visibility: hidden;
  }

  .modal-backdrop.active {
    opacity: 1;
    visibility: visible;
  }

  .modal-backdrop.hidden {
    display: none;
  }

  /**
   * Modal Content Animation
   */
  @keyframes slideInFromBottom {
    from {
      opacity: 0;
      transform: translateY(20px) scale(0.95);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .animate-modal-entry {
    animation: slideInFromBottom 0.3s ease-out forwards;
  }
</style>
@endpush