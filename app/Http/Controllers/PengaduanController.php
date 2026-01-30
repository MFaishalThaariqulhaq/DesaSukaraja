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

  public function checkStatus(Request $request)
  {
    $tracking = $request->get('tracking');
    $pengaduan = null;
    $notFound = false;

    if ($tracking) {
      $pengaduan = Pengaduan::where('tracking_number', $tracking)->first();
      if (!$pengaduan) {
        $notFound = true;
      }
    }

    return view('public.pengaduan.status', compact('pengaduan', 'notFound', 'tracking'));
  }

  public function listPengaduan()
  {
    $kategori = request('kategori');
    $status = request('status');

    $query = Pengaduan::query();

    if ($kategori && $kategori !== 'all') {
      $query->where('kategori', $kategori);
    }

    if ($status && $status !== 'all') {
      $query->where('status', $status);
    }

    $pengaduans = $query->latest()->paginate(10);
    
    $allKategori = Pengaduan::select('kategori')
      ->whereNotNull('kategori')
      ->distinct()
      ->pluck('kategori');
    
    // Stats
    $stats = [
      'total' => Pengaduan::count(),
      'submitted' => Pengaduan::where('status', 'submitted')->count(),
      'pending' => Pengaduan::where('status', 'pending')->count(),
      'in_progress' => Pengaduan::where('status', 'in_progress')->count(),
      'resolved' => Pengaduan::where('status', 'resolved')->count(),
      'rejected' => Pengaduan::where('status', 'rejected')->count(),
    ];

    $kategoriStats = Pengaduan::select('kategori')
      ->selectRaw('count(*) as count')
      ->whereNotNull('kategori')
      ->groupBy('kategori')
      ->pluck('count', 'kategori');

    return view('public.pengaduan.list', compact('pengaduans', 'stats', 'kategoriStats', 'allKategori', 'kategori', 'status'));
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
      'g-recaptcha-response' => 'required',
    ]);

    // Verify reCAPTCHA
    $recaptchaToken = $request->input('g-recaptcha-response');
    $recaptchaSecret = config('services.recaptcha.secret');
    
    $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
      'secret' => $recaptchaSecret,
      'response' => $recaptchaToken,
    ]);
    
    $recaptchaResult = $response->json();
    
    if (!$recaptchaResult['success'] || $recaptchaResult['score'] < 0.5) {
      return back()->withErrors(['captcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.']);
    }

    $data = $request->only(['nama', 'email', 'telepon', 'kategori', 'judul', 'isi']);
    // ensure email not null to avoid DB NOT NULL issues on some environments
    $data['email'] = $data['email'] ?? '';
    $data['status'] = 'submitted';
    
    // Generate tracking number
    $data['tracking_number'] = 'ADU-' . date('YmdHis') . '-' . random_int(1000, 9999);

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

    // Send email to user with tracking number
    try {
      if ($data['email']) {
        \Illuminate\Support\Facades\Mail::send('emails.pengaduan_received', [
          'tracking_number' => $data['tracking_number'],
          'nama' => $data['nama'],
        ], function ($message) use ($data) {
          $message->to($data['email'])->subject('Pengaduan Anda Telah Diterima - ' . config('app.name'));
        });
      }

      // Send email to admin
      Mail::to(config('mail.admin_address', env('MAIL_ADMIN')))->send(new NewPengaduanAdmin($pengaduan));
    } catch (\Exception $e) {
      // don't break user flow if mail fails
    }

    return back()->with('success', 'Pengaduan berhasil dikirim. Nomor tracking: ' . $data['tracking_number']);
  }
}
