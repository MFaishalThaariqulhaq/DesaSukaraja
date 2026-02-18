<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pengaduan\StorePengaduanRequest;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Services\PengaduanService;

class PengaduanController extends Controller
{
  public function __construct(private readonly PengaduanService $pengaduanService)
  {
  }

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

    $data = $this->pengaduanService->getPublicListData($kategori, $status);

    return view('public.pengaduan.list', array_merge($data, compact('kategori', 'status')));
  }

  public function store(StorePengaduanRequest $request)
  {
    $validated = $request->validated();

    if (!$this->pengaduanService->verifyRecaptcha($validated['g-recaptcha-response'])) {
      return back()->withErrors(['captcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.']);
    }

    $pengaduan = $this->pengaduanService->createPengaduan($validated, $request->file('lampiran'));

    return back()->with('success', 'Pengaduan berhasil dikirim. Nomor tracking: ' . $pengaduan->tracking_number);
  }
}
