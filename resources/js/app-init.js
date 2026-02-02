// Main app initialization
// Import all modules
import { initLayout } from './modules/layout.js';
import { initLibraries } from './modules/libraries.js';
import { initInfografis } from './modules/infografis.js';
import { initPengaduan } from './modules/pengaduan.js';
import { initSotk } from './modules/sotk.js';
import { initProfil } from './modules/profil.js';
import { initBeranda } from './modules/beranda.js';

// Initialize all modules on DOMContentLoaded
document.addEventListener('DOMContentLoaded', function () {
  // Core modules
  initLayout();
  initLibraries();

  // Page-specific modules (these will auto-detect if their elements exist)
  initBeranda();
  initInfografis();
  initPengaduan();
  initSotk();
  initProfil();
});
