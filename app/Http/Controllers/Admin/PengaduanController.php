<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengaduan\UpdatePengaduanRequest;
use App\Models\Pengaduan;
use App\Services\Admin\PengaduanService;

class PengaduanController extends Controller
{
  public function __construct(private readonly PengaduanService $pengaduanService)
  {
  }

  public function index()
  {
    $query = Pengaduan::query();

    if (request('status')) {
      $query->where('status', request('status'));
    }
    if (request('kategori')) {
      $query->where('kategori', request('kategori'));
    }
    if (request('q')) {
      $q = request('q');
      $query->where(function ($sub) use ($q) {
        $sub->where('nama', 'like', "%{$q}%")
          ->orWhere('email', 'like', "%{$q}%")
          ->orWhere('isi', 'like', "%{$q}%")
          ->orWhere('judul', 'like', "%{$q}%");
      });
    }

    $pengaduans = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

    // Get distinct categories for the filter dropdown
    $categories = Pengaduan::whereNotNull('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

    return view('admin.pengaduan.index', compact('pengaduans', 'categories'));
  }
  public function show($id)
  {
    $pengaduan = Pengaduan::findOrFail($id);
    return view('admin.pengaduan.show', compact('pengaduan'));
  }
  public function edit($id)
  {
    $pengaduan = Pengaduan::findOrFail($id);
    return view('admin.pengaduan.edit', compact('pengaduan'));
  }
  public function update(UpdatePengaduanRequest $request, $id)
  {
    $pengaduan = Pengaduan::findOrFail($id);
    $this->pengaduanService->updateStatus($pengaduan, $request->validated());

    return redirect()->route('admin.pengaduan.show', $pengaduan->id)->with('success', 'Pengaduan diperbarui');
  }
  public function destroy($id)
  {
    $pengaduan = Pengaduan::findOrFail($id);
    $pengaduan->delete();
    return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
  }
}
