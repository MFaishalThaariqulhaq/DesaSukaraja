<div style="font-family:sans-serif;">
  <h2>Status Pengaduan Anda Telah Diubah</h2>
  <p>Judul: {{ $pengaduan->judul ?? '-' }}</p>
  <p>Perubahan: <strong>{{ $oldStatus }}</strong> &rarr; <strong>{{ $newStatus }}</strong></p>
  <p>Catatan: {{ $pengaduan->internal_notes ?? '-' }}</p>
  <p>Terima kasih telah melapor. Silakan login ke sistem jika ingin informasi lebih lanjut.</p>
</div>