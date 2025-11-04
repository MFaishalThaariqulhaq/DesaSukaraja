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

    // Compute convex hull using monotone chain (2D)
    function convexHull(points) {
      if (points.length <= 2) return points.slice();
      // sort by x, then y
      points = points.map(p => ({ x: p.lng, y: p.lat })).sort((a, b) => a.x === b.x ? a.y - b.y : a.x - b.x);
      const cross = (o, a, b) => (a.x - o.x) * (b.y - o.y) - (a.y - o.y) * (b.x - o.x);
      const lower = [];
      for (let p of points) {
        while (lower.length >= 2 && cross(lower[lower.length - 2], lower[lower.length - 1], p) <= 0) lower.pop();
        lower.push(p);
      }
      const upper = [];
      for (let i = points.length - 1; i >= 0; i--) {
        const p = points[i];
        while (upper.length >= 2 && cross(upper[upper.length - 2], upper[upper.length - 1], p) <= 0) upper.pop();
        upper.push(p);
      }
      upper.pop(); lower.pop();
      const hull = lower.concat(upper);
      return hull.map(h => [h.y, h.x]); // back to [lat, lng]
    }

    const pts = dusuns.map(d => ({ lat: d.lat, lng: d.lng }));
    const hullLatLngs = convexHull(pts);
    const hullLayer = L.polygon(hullLatLngs, { color: '#10b981', weight: 2, fillColor: '#10b981', fillOpacity: 0.08 });

    // Legend control
    const legend = L.control({ position: 'topright' });
    legend.onAdd = function () {
      const div = L.DomUtil.create('div', 'map-legend');
      div.innerHTML = '<h4>Peta Desa Sukaraja</h4>' +
        '<div class="legend-row"><div class="marker-number" style="width:18px;height:18px;line-height:18px;font-size:12px">1</div><div>Tegal Koneng</div></div>' +
        '<div class="legend-row"><div class="marker-number" style="width:18px;height:18px;line-height:18px;font-size:12px">2</div><div>Krajan</div></div>' +
        '<div class="legend-row"><div class="marker-number" style="width:18px;height:18px;line-height:18px;font-size:12px">3</div><div>Cilengka</div></div>' +
        '<div style="margin-top:6px"><span class="toggle-btn" id="toggle-boundary">Tampilkan Batas Desa</span></div>';
      L.DomEvent.disableClickPropagation(div);
      return div;
    };
    legend.addTo(map);

    let boundaryVisible = false;
    function toggleBoundary() {
      boundaryVisible = !boundaryVisible;
      if (boundaryVisible) {
        hullLayer.addTo(map);
        document.getElementById('toggle-boundary').textContent = 'Sembunyikan Batas Desa';
      } else {
        map.removeLayer(hullLayer);
        document.getElementById('toggle-boundary').textContent = 'Tampilkan Batas Desa';
      }
    }
    document.addEventListener('click', function (e) {
      if (e.target && e.target.id === 'toggle-boundary') toggleBoundary();
    });

    // Fit bounds to markers + small padding
    const bounds = markerGroup.getBounds();
    if (bounds.isValid()) map.fitBounds(bounds.pad(0.4));

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
