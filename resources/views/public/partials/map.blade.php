<!-- Map partial (Leaflet) - keeps map code organized in resources/views/public/partials/map.blade.php -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="/maps/leaflet-styles.css" />

<div id="map" style="width:100%;height:450px;border-radius:8px;overflow:hidden"></div>

<script>
  // Dusun coordinates provided server-side (hard-coded here per user's list)
  window.DUSUN_DATA = [{
      name: 'Tegal Koneng',
      lat: -6.2078727,
      lng: 107.3806527
    },
    {
      name: 'Krajan',
      lat: -6.1972293,
      lng: 107.3834536
    },
    {
      name: 'Cilengka',
      lat: -6.2081167,
      lng: 107.3825883
    }
  ];
</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="/maps/leaflet-init.js" defer></script>