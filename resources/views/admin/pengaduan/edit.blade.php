@extends('admin.dashboard')
@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="edit" class="w-7 h-7 text-emerald-600"></i>
      Ubah Pengaduan
    </h2>
  </div>

  <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-6 p-4 bg-slate-100 rounded-lg">
      <p class="text-sm text-gray-600"><strong>Tracking Number:</strong></p>
      <p class="font-mono text-lg font-bold text-slate-800">{{ $pengaduan->tracking_number }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block font-semibold text-slate-700 mb-2">Status Pengaduan</label>
        <select name="status" class="border border-slate-300 rounded w-full p-3 focus:outline-none focus:border-emerald-500">
          <option value="submitted" {{ $pengaduan->status == 'submitted' ? 'selected' : '' }}>Baru Diterima (Submitted)</option>
          <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Dalam Antrian (Pending)</option>
          <option value="in_progress" {{ $pengaduan->status == 'in_progress' ? 'selected' : '' }}>Sedang Diproses (In Progress)</option>
          <option value="resolved" {{ $pengaduan->status == 'resolved' ? 'selected' : '' }}>Selesai (Resolved)</option>
          <option value="rejected" {{ $pengaduan->status == 'rejected' ? 'selected' : '' }}>Ditolak (Rejected)</option>
        </select>
      </div>
    </div>

    <div class="mb-4">
      <label class="block font-semibold text-slate-700 mb-2">Catatan Penanganan (Public)</label>
      <p class="text-xs text-gray-600 mb-2">Catatan ini akan ditampilkan kepada masyarakat di halaman status tracking. Gunakan bahasa yang baik dan profesional.</p>
      <textarea name="admin_notes" rows="4" class="border border-slate-300 rounded w-full p-3 focus:outline-none focus:border-emerald-500" placeholder="Contoh: Pengaduan telah ditinjau. Proses perbaikan akan dimulai minggu depan.">{{ old('admin_notes', $pengaduan->admin_notes) }}</textarea>
    </div>

    <div class="mb-6 p-4 border border-slate-200 rounded-lg bg-slate-50">
      <h3 class="font-semibold text-slate-800 mb-2">Update Progres untuk Timeline Publik</h3>
      <p class="text-xs text-slate-600 mb-3">Isi bagian ini jika ada progres baru di lapangan. Foto dan catatan akan tampil di halaman Cek Progress warga.</p>

      <div class="mb-3">
        <label class="block text-sm font-semibold text-slate-700 mb-2">Catatan Progres</label>
        <textarea name="progress_note" rows="3" class="border border-slate-300 rounded w-full p-3 focus:outline-none focus:border-emerald-500" placeholder="Contoh: Tim sudah turun ke lokasi dan melakukan pengecekan awal.">{{ old('progress_note') }}</textarea>
        @error('progress_note')
          <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Progres (Opsional, Max 5MB)</label>
        <input type="file" id="progress_photo" name="progress_photo" accept=".jpg,.jpeg,.png,.webp,image/*" class="border border-slate-300 rounded w-full p-2.5 bg-white">
        @error('progress_photo')
          <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
        <div id="progress-preview-wrap" class="hidden mt-3">
          <p class="text-xs text-slate-500 mb-1">Pratinjau foto progres:</p>
          <img id="progress-preview-img" class="w-40 h-28 object-cover rounded-lg border border-slate-200" alt="Pratinjau foto progres">
        </div>
      </div>

      <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="checkbox" name="publish_progress" value="1" {{ old('publish_progress', '1') ? 'checked' : '' }} class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
        Tampilkan update ini ke publik
      </label>
    </div>

    <div class="mt-4 flex gap-3">
      <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition transform hover:-translate-y-0.5 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-300">
        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
        Simpan
      </button>
      <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-800 rounded-lg hover:bg-slate-200 transition transform hover:-translate-y-0.5 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-slate-200">
        <i data-lucide="corner-up-left" class="w-4 h-4 mr-2"></i>
        Batal
      </a>
    </div>
  </form>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    if (window.lucide) {
      lucide.createIcons();
    }

    const input = document.getElementById('progress_photo');
    const wrap = document.getElementById('progress-preview-wrap');
    const img = document.getElementById('progress-preview-img');

    if (input && wrap && img) {
      input.addEventListener('change', (event) => {
        const file = event.target.files && event.target.files[0];
        if (!file) {
          wrap.classList.add('hidden');
          img.removeAttribute('src');
          return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
          img.src = e.target?.result;
          wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      });
    }
  });
</script>
@endsection
