// Inisialisasi Peta Wilayah Desa
document.addEventListener('DOMContentLoaded', () => {
  if (!document.getElementById('map')) return;

  lucide.createIcons();

  // 1. Inisialisasi Peta
  const centerLat = -6.3117;
  const centerLng = 107.3298;

  var map = L.map('map', {
    zoomControl: false,
    scrollWheelZoom: false,
    dragging: true
  }).setView([centerLat, centerLng], 14);

  // 2. Tile Layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
  }).addTo(map);

  L.control.zoom({ position: 'topleft' }).addTo(map);

  // 3. Custom Icon
  const createPin = (color) => {
    return L.divIcon({
      className: 'custom-pin',
      html: `<div style="background-color: ${color}; width: 14px; height: 14px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 0 4px rgba(0,0,0,0.2);"></div>`,
      iconSize: [14, 14],
      iconAnchor: [7, 7],
      popupAnchor: [0, -10]
    });
  };

  // 4. Polygon Batas Wilayah
  const villageBoundary = [
    [-6.3000, 107.3250], [-6.3020, 107.3350], [-6.3100, 107.3400],
    [-6.3200, 107.3380], [-6.3250, 107.3300], [-6.3220, 107.3200],
    [-6.3100, 107.3150], [-6.3050, 107.3200]
  ];

  var polygon = L.polygon(villageBoundary, {
    color: '#10b981', weight: 3, opacity: 1,
    fillColor: '#10b981', fillOpacity: 0.15
  }).addTo(map);

  polygon.bindPopup(`
        <div class="text-center p-2">
            <span class="text-xs font-bold text-emerald-600 block">WILAYAH DESA</span>
            <span class="text-sm font-bold text-slate-800">SUKARAJA</span>
        </div>
    `);

  // 5. Markers
  const locations = [
    { name: "Kantor Desa Sukaraja", lat: -6.3117, lng: 107.3298, color: "#ef4444", type: "Pusat Pemerintahan" },
    { name: "Pos Dusun I (Krajan)", lat: -6.3080, lng: 107.3320, color: "#3b82f6", type: "Dusun / RW" },
    { name: "Pos Dusun II (Babakan)", lat: -6.3150, lng: 107.3250, color: "#3b82f6", type: "Dusun / RW" },
    { name: "Pos Dusun III (Sawah)", lat: -6.3180, lng: 107.3350, color: "#3b82f6", type: "Dusun / RW" }
  ];

  locations.forEach(loc => {
    L.marker([loc.lat, loc.lng], { icon: createPin(loc.color) })
      .addTo(map)
      .bindPopup(`<div class="font-bold text-xs text-slate-600 uppercase mb-1">${loc.type}</div><div class="font-bold text-sm text-slate-800">${loc.name}</div>`);
  });

  // Reset Map Function
  window.resetMap = function () {
    map.fitBounds(polygon.getBounds());
  };

  resetMap();

  // Aktifkan scroll zoom hanya saat fokus (hover)
  const mapContainer = document.getElementById('map').parentElement;
  mapContainer.addEventListener('mouseenter', () => map.scrollWheelZoom.enable());
  mapContainer.addEventListener('mouseleave', () => map.scrollWheelZoom.disable());
});
