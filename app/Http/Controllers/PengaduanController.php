<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PengaduanLog;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPengaduanAdmin;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
  public function index()
  {
    return view('public.pengaduan.index');
  }
  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'nullable|string|max:191',
      'email' => 'nullable|email|max:191',
      'telepon' => 'nullable|string|max:50',
      'kategori' => 'nullable|string|max:100',
      'judul' => 'nullable|string|max:191',
      'isi' => 'required|string',
      'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,mp4|max:5120',
    ]);

    $data = $request->only(['nama', 'email', 'telepon', 'kategori', 'judul', 'isi']);
    // ensure email not null to avoid DB NOT NULL issues on some environments
    $data['email'] = $data['email'] ?? '';
    $data['status'] = 'pending';

    if ($request->hasFile('lampiran')) {
      $data['file_path'] = $request->file('lampiran')->store('pengaduan', 'public');
    }

    $pengaduan = Pengaduan::create($data);

    // Log the creation
    PengaduanLog::create([
      'pengaduan_id' => $pengaduan->id,
      'action' => 'created',
      'meta' => json_encode(['ip' => request()->ip()]),
    ]);

    // Send email to admin (if MAIL_* configured)
    try {
      Mail::to(config('mail.admin_address', env('MAIL_ADMIN')))->send(new NewPengaduanAdmin($pengaduan));
    } catch (\Exception $e) {
      // don't break user flow if mail fails
    }

    return back()->with('success', 'Pengaduan berhasil dikirim. Terima kasih.');
  }
}
