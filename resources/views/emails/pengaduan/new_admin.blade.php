<div style="font-family: sans-serif;">
  <h2>Pengaduan Baru Diterima</h2>
  <p>Nama: {{ $pengaduan->nama ?? '-' }}</p>
  <p>Email: {{ $pengaduan->email ?? '-' }}</p>
  <p>Telepon: {{ $pengaduan->telepon ?? '-' }}</p>
  <p>Judul: {{ $pengaduan->judul ?? '-' }}</p>
  <p>Kategori: {{ $pengaduan->kategori ?? '-' }}</p>
  <p>Isi:</p>
  <div style="padding:8px;background:#f8fafc;border-radius:6px">{{ $pengaduan->isi }}</div>
  @if($pengaduan->file_path)
  <p>Lampiran: <a href="{{ asset('storage/' . $pengaduan->file_path) }}">Lihat</a></p>
  @endif
  <p>Silakan login ke dashboard admin untuk menindaklanjuti.</p>
</div>