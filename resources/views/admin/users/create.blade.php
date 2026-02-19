@extends('admin.dashboard')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-2xl shadow-lg">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Tambah Admin Baru</h2>
    <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-600 hover:text-emerald-600">Kembali</a>
  </div>

  <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
    @csrf
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
      <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
      @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
      @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
      <select name="role" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>admin</option>
        <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>super_admin</option>
      </select>
      @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
      <input type="password" name="password" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
      @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
    </div>
    <div class="pt-2 flex justify-end gap-3">
      <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">Batal</a>
      <button type="submit" class="px-5 py-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">Simpan</button>
    </div>
  </form>
</div>
@endsection
