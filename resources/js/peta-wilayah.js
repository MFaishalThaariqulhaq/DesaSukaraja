// Inisialisasi peta saat mendekati viewport untuk meringankan initial load.
document.addEventListener('DOMContentLoaded', () => {
  const mapElement = document.getElementById('map');
  if (!mapElement) return;

  window.resetMap = window.resetMap || function () {};
  if (window.lucide) {
    window.lucide.createIcons();
  }

  const LEAFLET_CSS_ID = 'leaflet-css';
  const LEAFLET_JS_ID = 'leaflet-js';
  let isInitialized = false;

  const loadStylesheet = (id, href, integrity) => {
    if (document.getElementById(id)) return;
    const link = document.createElement('link');
    link.id = id;
    link.rel = 'stylesheet';
    link.href = href;
    link.integrity = integrity;
    link.crossOrigin = '';
    document.head.appendChild(link);
  };

  const loadScript = (id, src, integrity) =>
    new Promise((resolve, reject) => {
      const existing = document.getElementById(id);
      if (existing) {
        if (window.L) {
          resolve();
          return;
        }

        existing.addEventListener('load', resolve, { once: true });
        existing.addEventListener('error', reject, { once: true });
        return;
      }

      const script = document.createElement('script');
      script.id = id;
      script.src = src;
      script.defer = true;
      script.integrity = integrity;
      script.crossOrigin = '';
      script.onload = resolve;
      script.onerror = reject;
      document.head.appendChild(script);
    });

  const ensureLeafletLoaded = async () => {
    if (window.L) return;

    loadStylesheet(
      LEAFLET_CSS_ID,
      'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
      'sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY='
    );

    await loadScript(
      LEAFLET_JS_ID,
      'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
      'sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo='
    );
  };

  const initMap = async () => {
    if (isInitialized) return;
    isInitialized = true;

    try {
      await ensureLeafletLoaded();
    } catch (error) {
      console.error('Gagal memuat Leaflet:', error);
      return;
    }

    const L = window.L;
    const centerLat = -6.3117;
    const centerLng = 107.3298;

    const map = L.map('map', {
      zoomControl: false,
      scrollWheelZoom: false,
      dragging: true,
    }).setView([centerLat, centerLng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors',
    }).addTo(map);

    L.control.zoom({ position: 'topleft' }).addTo(map);

    const createPin = (color) =>
      L.divIcon({
        className: 'custom-pin',
        html: `<div style="background-color: ${color}; width: 14px; height: 14px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 0 4px rgba(0,0,0,0.2);"></div>`,
        iconSize: [14, 14],
        iconAnchor: [7, 7],
        popupAnchor: [0, -10],
      });

    const villageBoundary = [
      [-6.3, 107.325],
      [-6.302, 107.335],
      [-6.31, 107.34],
      [-6.32, 107.338],
      [-6.325, 107.33],
      [-6.322, 107.32],
      [-6.31, 107.315],
      [-6.305, 107.32],
    ];

    const polygon = L.polygon(villageBoundary, {
      color: '#10b981',
      weight: 3,
      opacity: 1,
      fillColor: '#10b981',
      fillOpacity: 0.15,
    }).addTo(map);

    polygon.bindPopup(
      '<div class="text-center p-2"><span class="text-xs font-bold text-emerald-600 block">WILAYAH DESA</span><span class="text-sm font-bold text-slate-800">SUKARAJA</span></div>'
    );

    const locations = [
      { name: 'Kantor Desa Sukaraja', lat: -6.3117, lng: 107.3298, color: '#ef4444', type: 'Pusat Pemerintahan' },
      { name: 'Pos Dusun I (Krajan)', lat: -6.308, lng: 107.332, color: '#3b82f6', type: 'Dusun / RW' },
      { name: 'Pos Dusun II (Babakan)', lat: -6.315, lng: 107.325, color: '#3b82f6', type: 'Dusun / RW' },
      { name: 'Pos Dusun III (Sawah)', lat: -6.318, lng: 107.335, color: '#3b82f6', type: 'Dusun / RW' },
    ];

    locations.forEach((loc) => {
      L.marker([loc.lat, loc.lng], { icon: createPin(loc.color) })
        .addTo(map)
        .bindPopup(
          `<div class="font-bold text-xs text-slate-600 uppercase mb-1">${loc.type}</div><div class="font-bold text-sm text-slate-800">${loc.name}</div>`
        );
    });

    window.resetMap = function () {
      map.fitBounds(polygon.getBounds());
    };

    window.resetMap();

    const mapContainer = mapElement.parentElement;
    mapContainer.addEventListener('mouseenter', () => map.scrollWheelZoom.enable());
    mapContainer.addEventListener('mouseleave', () => map.scrollWheelZoom.disable());
  };

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        if (entries[0]?.isIntersecting) {
          observer.disconnect();
          initMap();
        }
      },
      { rootMargin: '300px 0px' }
    );

    observer.observe(mapElement);
    return;
  }

  initMap();
});
