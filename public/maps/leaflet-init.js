(function () {
  // Ensure DOM available
  function init() {
    if (!window.DUSUN_DATA || !Array.isArray(window.DUSUN_DATA)) return;
    const dusuns = window.DUSUN_DATA;
    if (!dusuns.length) return;

    // Center map at average of points
    const latSum = dusuns.reduce((s, d) => s + d.lat, 0);
    const lngSum = dusuns.reduce((s, d) => s + d.lng, 0);
    const center = [latSum / dusuns.length, lngSum / dusuns.length];

    const map = L.map('map', { scrollWheelZoom: false }).setView(center, 15);

    // OpenStreetMap tile layer (free)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    // custom numbered div icon
    function createNumberedIcon(number) {
      const html = '<div class="marker-number">' + number + '</div>';
      return L.divIcon({ html: html, className: '', iconSize: [30, 30], iconAnchor: [15, 30] });
    }

    const markerGroup = L.layerGroup().addTo(map);

    dusuns.forEach((d, i) => {
      const marker = L.marker([d.lat, d.lng], { icon: createNumberedIcon(i + 1) })
        .bindPopup('<strong>' + escapeHtml(d.name) + '</strong>')
        .addTo(markerGroup);
    });

    // Simple legend (static) listing dusun markers. No boundary / convex hull.
    const legend = L.control({ position: 'topright' });
    legend.onAdd = function () {
      const div = L.DomUtil.create('div', 'map-legend');
      let html = '<h4>Peta Desa Sukaraja</h4>';
      dusuns.forEach((d, i) => {
        html += `<div class="legend-row"><div class="marker-number" style="width:18px;height:18px;line-height:18px;font-size:12px">${i + 1}</div><div>${escapeHtml(d.name)}</div></div>`;
      });
      div.innerHTML = html;
      L.DomEvent.disableClickPropagation(div);
      return div;
    };
    legend.addTo(map);

    // Fit bounds to markers + small padding
    const bounds = markerGroup.getBounds();
    if (bounds.isValid()) map.fitBounds(bounds.pad(0.35));

    // simple escape to avoid XSS in popup content
    function escapeHtml(str) {
      return String(str).replace(/[&<>"]/g, function (s) {
        const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' };
        return map[s];
      });
    }
  }

  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(init, 10);
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();
