@extends('admin.dashboard')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-lg mt-10 border border-slate-100">
  <div class="flex items-center justify-between mb-8">
    <h2 class="text-3xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="user-plus" class="w-7 h-7 text-emerald-600"></i>
      Tambah Data Penduduk
    </h2>
    <a href="{{ route('admin.infografis.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
    </a>
  </div>

  <form action="{{ route('admin.infografis.store') }}" method="POST" class="space-y-8">
    @csrf

    {{-- Informasi Umum --}}
    <div>
      <h3 class="text-xl font-semibold text-emerald-600 mb-4 border-b pb-2">Informasi Umum</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
          <label class="block mb-2 font-medium text-slate-700">Nama Dusun/Kampung</label>
          <input type="text" name="dusun"
            class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-400 focus:outline-none"
            required>
        </div>
        <div>
          <label class="block mb-2 font-medium text-slate-700">Periode Bulan</label>
          <input type="text" name="bulan"
            class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-400 focus:outline-none"
            placeholder="cth: Agustus" required>
        </div>
        <div>
          <label class="block mb-2 font-medium text-slate-700">Tahun</label>
          <input type="number" name="tahun" value="{{ date('Y') }}"
            class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-400 focus:outline-none"
            required>
        </div>
      </div>
    </div>

    {{-- Data Kependudukan --}}
    <div>
      <h3 class="text-xl font-semibold text-emerald-600 mb-4 border-b pb-2">Data Kependudukan</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ([
        'total_penduduk' => 'Total Penduduk',
        'kepala_keluarga' => 'Kepala Keluarga',
        'laki_laki' => 'Laki-laki',
        'perempuan' => 'Perempuan',
        'jumlah_kk' => 'Jumlah KK',
        'wajib_ktp' => 'Wajib KTP',
        'sudah_kk' => 'Sudah KK',
        'belum_kk' => 'Belum KK',
        'sudah_ktp' => 'Sudah KTP',
        'belum_ktp' => 'Belum KTP',
        'lahir' => 'Lahir',
        'datang' => 'Datang',
        'mati' => 'Mati',
        'pindah' => 'Pindah',
        'penduduk_bulan_lalu' => 'Penduduk Bulan Lalu',
        'penduduk_bulan_ini' => 'Penduduk Bulan Ini',
        'wni' => 'WNI',
        'wna' => 'WNA'
        ] as $name => $label)
        <div>
          <label class="block mb-2 font-medium text-slate-700">{{ $label }}</label>
          <input type="number" name="{{ $name }}"
            class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
        </div>
        @endforeach
      </div>
    </div>

    {{-- Kelompok Usia --}}
    <div>
      <h3 class="text-xl font-semibold text-emerald-600 mb-4 border-b pb-2">Kelompok Usia</h3>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach ([
        'kelompok_usia_0_5' => 'Usia 0–5',
        'kelompok_usia_6_11' => 'Usia 6–11',
        'kelompok_usia_12_17' => 'Usia 12–17',
        'kelompok_usia_18_25' => 'Usia 18–25',
        'kelompok_usia_26_35' => 'Usia 26–35',
        'kelompok_usia_36_45' => 'Usia 36–45',
        'kelompok_usia_46_60' => 'Usia 46–60',
        'kelompok_usia_61_keatas' => 'Usia 61+'
        ] as $name => $label)
        <div>
          <label class="block mb-2 font-medium text-slate-700">{{ $label }}</label>
          <input type="number" name="{{ $name }}"
            class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
        </div>
        @endforeach
      </div>
    </div>

    {{-- Tombol --}}
    <div class="flex justify-end gap-3 pt-6 border-t">
      <a href="{{ route('admin.infografis.index') }}"
        class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-2.5 rounded-lg shadow-sm transition-all duration-300 hover:scale-105">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Batal
      </a>
      <button type="submit"
        class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-md transition-all duration-300 hover:scale-105">
        <i data-lucide="save" class="w-5 h-5"></i>
        Simpan
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();
  });
</script>
@endsection