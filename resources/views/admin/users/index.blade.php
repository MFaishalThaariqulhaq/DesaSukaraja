@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
      <h2 class="text-2xl font-bold text-slate-800">Kelola Admin</h2>
      <p class="text-sm text-slate-500 mt-1">Hanya super admin yang dapat mengelola akun admin.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg shadow font-semibold transition">
      <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah Admin
    </a>
  </div>

  <div class="overflow-x-auto border border-slate-200 rounded-xl">
    <table class="min-w-full bg-white text-sm">
      <thead class="bg-slate-50 text-slate-700 uppercase text-xs">
        <tr>
          <th class="py-3 px-4 text-left font-semibold">Nama</th>
          <th class="py-3 px-4 text-left font-semibold">Email</th>
          <th class="py-3 px-4 text-left font-semibold">Role</th>
          <th class="py-3 px-4 text-left font-semibold">Dibuat</th>
          <th class="py-3 px-4 text-center font-semibold w-36">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 text-slate-700">
        @forelse($users as $user)
        <tr class="hover:bg-slate-50 transition">
          <td class="py-3 px-4 font-medium text-slate-800">{{ $user->name }}</td>
          <td class="py-3 px-4">{{ $user->email }}</td>
          <td class="py-3 px-4">
            <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-emerald-100 text-emerald-700' }}">
              {{ $user->role }}
            </span>
          </td>
          <td class="py-3 px-4 text-xs">{{ $user->created_at?->format('d M Y H:i') }}</td>
          <td class="py-3 px-4">
            <div class="flex justify-center items-center gap-2">
              <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center justify-center p-2 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition" title="Edit">
                <i data-lucide="pencil" class="w-4 h-4"></i>
              </a>
              <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus admin ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center p-2 rounded-lg text-red-600 hover:text-red-800 hover:bg-red-50 transition" title="Hapus">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-8 text-slate-500">Belum ada data admin.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($users->hasPages())
  <div class="mt-6">
    {{ $users->links('vendor.pagination.tailwind') }}
  </div>
  @endif
</div>
@endsection
