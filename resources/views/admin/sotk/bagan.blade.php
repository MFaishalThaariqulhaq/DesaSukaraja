@extends('admin.dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h2 class="text-2xl font-bold text-slate-800">Kelola Bagan Organisasi</h2>
      <p class="text-sm text-slate-500 mt-1">Edit atau hapus bagan dengan cara yang sama seperti pengelolaan gambar profil.</p>
    </div>
    <a href="{{ route('admin.sotk.index') }}"
      class="text-sm text-slate-600 hover:text-emerald-500 flex items-center gap-1 bg-white border border-slate-300 px-4 py-2 rounded-lg shadow-sm hover:bg-slate-50 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i> <span>Kembali</span>
    </a>
  </div>

  @if(session('success'))
  <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
    {{ session('success') }}
  </div>
  @endif

  @if ($errors->any())
  <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700 text-sm">
    <ul class="list-disc pl-5 space-y-1">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  @php
  $defaultBagan = asset('assets/struktur.jpg');
  $currentBagan = ($bagan && $bagan->foto) ? asset('storage/' . $bagan->foto) : $defaultBagan;
  @endphp

  <form action="{{ route('admin.sotk.bagan.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
    @csrf
    <div>
      <h3 class="font-semibold text-slate-800 mb-3">Bagan Organisasi</h3>
      <div class="relative group rounded-xl overflow-hidden shadow border border-slate-200 bg-slate-100">
        <img
          id="preview-bagan"
          src="{{ $currentBagan }}"
          data-default="{{ $currentBagan }}"
          data-placeholder="{{ $defaultBagan }}"
          alt="Bagan Organisasi"
          class="w-full object-contain max-h-[500px] transition duration-500 group-hover:opacity-90">
        <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-3">
          <button
            type="button"
            id="btn-edit-bagan"
            class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-white text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 shadow">
            <i data-lucide="pencil" class="w-5 h-5"></i>
          </button>
          @if($bagan && $bagan->foto)
          <button
            type="button"
            id="btn-hapus-bagan"
            class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-white text-slate-700 hover:bg-red-50 hover:text-red-700 shadow">
            <i data-lucide="trash-2" class="w-5 h-5"></i>
          </button>
          @endif
        </div>
      </div>
      <input type="file" name="bagan" id="bagan" class="hidden" accept="image/*">
      <input type="checkbox" name="remove_bagan" id="remove_bagan" value="1" class="hidden">
      <p class="text-xs text-slate-500 mt-2">Arahkan kursor ke gambar untuk Edit/Hapus. Format JPG/PNG/GIF, maksimal 2MB.</p>
    </div>

    <div class="pt-2 flex justify-end">
      <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-lg shadow-md font-semibold transition">
        <i data-lucide="save" class="inline w-4 h-4 mr-1"></i> Simpan Perubahan
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (window.lucide) {
      lucide.createIcons();
    }

    const baganInput = document.getElementById('bagan');
    const removeBagan = document.getElementById('remove_bagan');
    const preview = document.getElementById('preview-bagan');
    const btnEdit = document.getElementById('btn-edit-bagan');
    const btnHapus = document.getElementById('btn-hapus-bagan');

    if (btnEdit && baganInput) {
      btnEdit.addEventListener('click', function() {
        baganInput.click();
      });
    }

    if (btnHapus && preview) {
      btnHapus.addEventListener('click', function() {
        const shouldRemove = window.confirm('Hapus bagan organisasi saat ini?');
        if (!shouldRemove) {
          return;
        }

        if (removeBagan) {
          removeBagan.checked = true;
        }

        if (baganInput) {
          baganInput.value = '';
        }

        if (preview.dataset.placeholder) {
          preview.src = preview.dataset.placeholder;
        }
      });
    }

    if (baganInput && preview) {
      baganInput.addEventListener('change', function(e) {
        const file = e.target.files && e.target.files[0];
        if (!file) {
          preview.src = preview.dataset.default || preview.src;
          return;
        }

        if (removeBagan) {
          removeBagan.checked = false;
        }

        const reader = new FileReader();
        reader.onload = function(evt) {
          preview.src = evt.target.result;
        };
        reader.readAsDataURL(file);
      });
    }
  });
</script>
@endsection
