@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="edit" class="w-7 h-7 text-emerald-600"></i>
      Edit Data Penduduk
    </h2>
    <a href="{{ route('admin.infografis.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.infografis.update', $penduduk->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <label class="block mb-2 font-medium text-slate-700">Nama Dusun/Kampung</label>
        <input type="text" name="dusun" value="{{ $penduduk->dusun }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('dusun') border-red-500 @enderror"
          required>
        @error('dusun') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Total Penduduk</label>
        <input type="number" name="total_penduduk" value="{{ $penduduk->total_penduduk }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('total_penduduk') border-red-500 @enderror"
          required>
        @error('total_penduduk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Kepala Keluarga</label>
        <input type="number" name="kepala_keluarga" value="{{ $penduduk->kepala_keluarga }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('kepala_keluarga') border-red-500 @enderror"
          required>
        @error('kepala_keluarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Laki-laki</label>
        <input type="number" name="laki_laki" value="{{ $penduduk->laki_laki }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('laki_laki') border-red-500 @enderror"
          required>
        @error('laki_laki') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Perempuan</label>
        <input type="number" name="perempuan" value="{{ $penduduk->perempuan }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('perempuan') border-red-500 @enderror"
          required>
        @error('perempuan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Wajib KTP (Opsional)</label>
        <input type="number" name="wajib_ktp" value="{{ $penduduk->wajib_ktp }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Lahir (Opsional)</label>
        <input type="number" name="lahir" value="{{ $penduduk->lahir }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Datang (Opsional)</label>
        <input type="number" name="datang" value="{{ $penduduk->datang }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Mati (Opsional)</label>
        <input type="number" name="mati" value="{{ $penduduk->mati }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Pindah (Opsional)</label>
        <input type="number" name="pindah" value="{{ $penduduk->pindah }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>
    </div>

    <div class="flex justify-end gap-4 pt-6 border-t">
      <a href="{{ route('admin.infografis.index') }}" class="px-6 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition">
        Batal
      </a>
      <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
        Update Data
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
          <input type="number" name="{{ $name }}" value="{{ $penduduk->$name }}"
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
          <input type="number" name="{{ $name }}" value="{{ $penduduk->$name }}"
            class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
        </div>
        @endforeach
      </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex justify-end space-x-3 pt-6 border-t">
      <a href="{{ route('admin.infografis.index') }}"
        class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-2.5 rounded-lg transition">
        Batal
      </a>
      <button type="submit"
        class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium px-6 py-2.5 rounded-lg shadow transition">
        Update
      </button>
    </div>
  </form>
</div>
@endsection