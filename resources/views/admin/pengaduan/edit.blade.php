@extends('admin.dashboard')
@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg animate-fadeIn">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
      <i data-lucide="edit" class="w-7 h-7 text-emerald-600"></i>
      Ubah Pengaduan
    </h2>
  </div>

  <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block mb-1">Status</label>
        <select name="status" class="border rounded w-full p-2">
          <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="in_progress" {{ $pengaduan->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
          <option value="resolved" {{ $pengaduan->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
          <option value="rejected" {{ $pengaduan->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
      </div>
      <div>
        <label class="block mb-1">Catatan Internal</label>
        <textarea name="internal_notes" rows="4" class="border rounded w-full p-2">{{ $pengaduan->internal_notes }}</textarea>
      </div>
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
@endsection