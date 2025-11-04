<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\PengaduanLog;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengaduanStatusUpdated;

class PengaduanController extends Controller
{
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
  public function update(Request $request, $id)
  {
    $pengaduan = Pengaduan::findOrFail($id);
    $request->validate([
      'status' => 'required|in:pending,in_progress,resolved,rejected',
      'internal_notes' => 'nullable|string',
    ]);
    $oldStatus = $pengaduan->status;
    $pengaduan->update([
      'status' => $request->status,
      'internal_notes' => $request->internal_notes,
    ]);

    // Log the status change or update
    PengaduanLog::create([
      'pengaduan_id' => $pengaduan->id,
      'action' => 'updated',
      'meta' => json_encode([
        'old_status' => $oldStatus,
        'new_status' => $request->status,
        'internal_notes' => $request->internal_notes,
        'admin' => session('admin_logged_in') ? 'admin' : null,
      ]),
    ]);

    // If status changed, notify reporter via email (if email provided)
    if ($oldStatus !== $request->status && $pengaduan->email) {
      try {
        Mail::to($pengaduan->email)->queue(new PengaduanStatusUpdated($pengaduan, $oldStatus, $request->status));
      } catch (\Exception $e) {
        // swallow mail exception
      }
    }

    return redirect()->route('admin.pengaduan.show', $pengaduan->id)->with('success', 'Pengaduan diperbarui');
  }
  public function destroy($id)
  {
    $pengaduan = Pengaduan::findOrFail($id);
    $pengaduan->delete();
    return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
  }
}
