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

    $result = $this->pengaduanService->createPengaduan($validated, $request->file('lampiran'));
    $pengaduan = $result['pengaduan'];
    $notifications = $result['notifications'];

    $successMessage = 'Pengaduan berhasil dikirim. Nomor tracking: ' . $pengaduan->tracking_number;
    $warnings = [];

    if (config('mail.default') === 'log' || config('mail.default') === 'array') {
      $warnings[] = 'Email masih dalam mode ' . config('mail.default') . ' sehingga belum benar-benar dikirim.';
    } elseif (!$notifications['pelapor_sent'] && !$notifications['pelapor_skipped']) {
      $warnings[] = 'Konfirmasi email ke pelapor belum terkirim.';
    }

    $redirect = back()->with('success', $successMessage);

    if (!empty($warnings)) {
      $redirect->with('warning', implode(' ', $warnings));
    }

    return $redirect;
  }
}
