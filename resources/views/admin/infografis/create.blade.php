@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="user-plus" class="w-7 h-7 text-emerald-600"></i>
      Tambah Data Penduduk
    </h2>
    <a href="{{ route('admin.infografis.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow hover:bg-slate-100 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.infografis.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <label class="block mb-2 font-medium text-slate-700">Nama Dusun/Kampung</label>
        <input type="text" name="dusun" value="{{ old('dusun') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('dusun') border-red-500 @enderror"
          required>
        @error('dusun') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Total Penduduk</label>
        <input type="number" name="total_penduduk" value="{{ old('total_penduduk') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('total_penduduk') border-red-500 @enderror"
          required>
        @error('total_penduduk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Kepala Keluarga</label>
        <input type="number" name="kepala_keluarga" value="{{ old('kepala_keluarga') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('kepala_keluarga') border-red-500 @enderror"
          required>
        @error('kepala_keluarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Laki-laki</label>
        <input type="number" name="laki_laki" value="{{ old('laki_laki') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('laki_laki') border-red-500 @enderror"
          required>
        @error('laki_laki') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Perempuan</label>
        <input type="number" name="perempuan" value="{{ old('perempuan') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('perempuan') border-red-500 @enderror"
          required>
        @error('perempuan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Wajib KTP (Opsional)</label>
        <input type="number" name="wajib_ktp" value="{{ old('wajib_ktp') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Lahir (Opsional)</label>
        <input type="number" name="lahir" value="{{ old('lahir') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Datang (Opsional)</label>
        <input type="number" name="datang" value="{{ old('datang') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Mati (Opsional)</label>
        <input type="number" name="mati" value="{{ old('mati') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>

      <div>
        <label class="block mb-2 font-medium text-slate-700">Pindah (Opsional)</label>
        <input type="number" name="pindah" value="{{ old('pindah') }}"
          class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
      </div>
    </div>

    <div class="flex justify-end gap-4 pt-6 border-t">
      <button type="reset" class="px-6 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition">
        Reset
      </button>
      <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
        Simpan Data
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