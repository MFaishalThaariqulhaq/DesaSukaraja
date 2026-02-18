<?php

namespace App\Services;

use App\Mail\NewPengaduanAdmin;
use App\Models\Pengaduan;
use App\Models\PengaduanLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PengaduanService
{
    public function verifyRecaptcha(string $token): bool
    {
        $secret = config('services.recaptcha.secret');

        if (!$secret) {
            return false;
        }

        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['secret' => $secret, 'response' => $token]
        );

        $result = $response->json();

        return ($result['success'] ?? false) && (($result['score'] ?? 0) >= 0.5);
    }

    public function createPengaduan(array $validatedData, ?\Illuminate\Http\UploadedFile $lampiran = null): Pengaduan
    {
        $data = collect($validatedData)
            ->only(['nama', 'email', 'telepon', 'kategori', 'judul', 'isi'])
            ->toArray();

        $data['email'] = $data['email'] ?? '';
        $data['status'] = 'submitted';
        $data['tracking_number'] = 'ADU-' . now()->format('YmdHis') . '-' . random_int(1000, 9999);

        if ($lampiran) {
            $data['file_path'] = $lampiran->store('pengaduan', 'public');
        }

        $pengaduan = Pengaduan::create($data);

        PengaduanLog::create([
            'pengaduan_id' => $pengaduan->id,
            'action' => 'created',
            'meta' => json_encode(['ip' => request()->ip()]),
        ]);

        $this->sendNotifications($pengaduan, $data);

        return $pengaduan;
    }

    public function getPublicListData(?string $kategori, ?string $status): array
    {
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

        return compact('pengaduans', 'allKategori', 'stats', 'kategoriStats');
    }

    private function sendNotifications(Pengaduan $pengaduan, array $data): void
    {
        try {
            if (!empty($data['email'])) {
                Mail::send(
                    'emails.pengaduan_received',
                    [
                        'tracking_number' => $data['tracking_number'],
                        'nama' => $data['nama'] ?? null,
                    ],
                    function ($message) use ($data) {
                        $message
                            ->to($data['email'])
                            ->subject('Pengaduan Anda Telah Diterima - ' . config('app.name'));
                    }
                );
            }

            Mail::to(config('mail.admin_address', env('MAIL_ADMIN')))
                ->send(new NewPengaduanAdmin($pengaduan));
        } catch (\Throwable $e) {
            // User flow should not fail due to mail transport issue.
        }
    }
}
