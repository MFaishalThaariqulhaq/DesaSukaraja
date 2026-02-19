@extends('admin.dashboard')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-2xl shadow-lg">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Edit Admin</h2>
    <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-600 hover:text-emerald-600">Kembali</a>
  </div>

  <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    @method('PUT')
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Avatar</label>
      @php $placeholderAvatar = 'https://placehold.co/300x300?text=Avatar'; @endphp
      <div class="group relative rounded-full overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 transition w-24 h-24"
        data-image-card
        data-input-id="avatar"
        data-remove-input-id="remove_avatar"
        data-remove-confirm="Hapus avatar admin ini?">
        <img data-image-preview src="{{ $user->avatar ? asset('storage/' . $user->avatar) : $placeholderAvatar }}" data-placeholder="{{ $placeholderAvatar }}" alt="Avatar" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
          <button type="button" data-image-edit class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 shadow">
            <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
          </button>
          @if($user->avatar)
          <button type="button" data-image-remove class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-slate-700 hover:bg-red-50 hover:text-red-700 shadow">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
          </button>
          @endif
        </div>
      </div>
      <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*">
      <input type="checkbox" name="remove_avatar" id="remove_avatar" value="1" class="hidden">
      @error('avatar') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
      @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
      @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
      <select name="role" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>admin</option>
        <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>super_admin</option>
      </select>
      @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div class="border-t border-slate-200 pt-4">
      <p class="text-sm font-semibold text-slate-700 mb-3">Ubah Password (opsional)</p>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
          <input type="password" name="password" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
          @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password Baru</label>
          <input type="password" name="password_confirmation" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        </div>
      </div>
    </div>
    <div class="pt-2 flex justify-end gap-3">
      <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">Batal</a>
      <button type="submit" class="px-5 py-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">Simpan Perubahan</button>
    </div>
  </form>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let cropper;
    const input = document.getElementById('avatar');
    const removeInput = document.getElementById('remove_avatar');
    const preview = document.querySelector('[data-input-id="avatar"] [data-image-preview]');

    const modal = document.createElement('div');
    modal.id = 'avatar-cropper-modal-edit';
    modal.className = 'fixed inset-0 bg-black/60 z-50 items-center justify-center p-4 hidden';
    modal.innerHTML = `
      <div class="bg-white rounded-xl p-5 shadow-xl w-full max-w-md">
        <h3 class="font-semibold text-slate-800 mb-3">Atur Avatar</h3>
        <div class="bg-slate-100 rounded-lg overflow-hidden">
          <img id="avatar-cropper-image-edit" src="" alt="Crop Avatar" class="max-h-[420px] mx-auto">
        </div>
        <div class="flex justify-end gap-2 mt-4">
          <button type="button" id="avatar-cropper-cancel-edit" class="px-4 py-2 rounded bg-slate-100 text-slate-700 hover:bg-slate-200">Batal</button>
          <button type="button" id="avatar-cropper-apply-edit" class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Terapkan</button>
        </div>
      </div>
    `;
    document.body.appendChild(modal);

    const image = document.getElementById('avatar-cropper-image-edit');
    const btnCancel = document.getElementById('avatar-cropper-cancel-edit');
    const btnApply = document.getElementById('avatar-cropper-apply-edit');

    if (!input || !image) return;

    input.addEventListener('change', function(e) {
      const file = e.target.files && e.target.files[0];
      if (!file) return;

      if (removeInput) removeInput.checked = false;

      const reader = new FileReader();
      reader.onload = function(evt) {
        image.onload = function() {
          if (cropper) cropper.destroy();
          cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            autoCropArea: 1
          });
        };
        image.src = evt.target.result;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      };
      reader.readAsDataURL(file);
    });

    btnCancel?.addEventListener('click', function() {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      if (cropper) {
        cropper.destroy();
        cropper = null;
      }
      input.value = '';
    });

    btnApply?.addEventListener('click', function() {
      if (!cropper) return;
      cropper.getCroppedCanvas({ width: 512, height: 512 }).toBlob(function(blob) {
        const dt = new DataTransfer();
        dt.items.add(new File([blob], 'avatar-cropped.jpg', { type: blob.type || 'image/jpeg' }));
        input.files = dt.files;
        if (preview) preview.src = URL.createObjectURL(blob);
        if (removeInput) removeInput.checked = false;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        cropper.destroy();
        cropper = null;
      }, 'image/jpeg', 0.92);
    });
  });
</script>
@endpush
