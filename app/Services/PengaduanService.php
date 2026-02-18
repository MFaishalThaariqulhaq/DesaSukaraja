<?php

namespace App\Services;

use App\Mail\NewPengaduanAdmin;
use App\Models\Pengaduan;
use App\Models\PengaduanLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

    public function createPengaduan(array $validatedData, ?\Illuminate\Http\UploadedFile $lampiran = null): array
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

        $notifications = $this->sendNotifications($pengaduan, $data);

        return [
            'pengaduan' => $pengaduan,
            'notifications' => $notifications,
        ];
    }

    public function getPublicListData(?string $kategori, ?string $status, int $perPage = 10): array
    {
        $allowedPerPage = [5, 10, 15, 20, 50];
        $perPage = in_array($perPage, $allowedPerPage, true) ? $perPage : 10;

        $query = Pengaduan::query();

        if ($kategori && $kategori !== 'all') {
            $query->where('kategori', $kategori);
        }

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $pengaduans = $query
            ->withCount([
                'progressUpdates as public_progress_count' => function ($subQuery) {
                    $subQuery->where('is_public', true);
                }
            ])
            ->withMax([
                'progressUpdates as last_public_progress_at' => function ($subQuery) {
                    $subQuery->where('is_public', true);
                }
            ], 'created_at')
            ->latest()
            ->paginate($perPage)
            ->withQueryString()
            ->fragment('daftar-pengaduan');

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

    private function sendNotifications(Pengaduan $pengaduan, array $data): array
    {
        $result = [
            'pelapor_sent' => false,
            'pelapor_skipped' => empty($data['email']),
            'admin_sent' => false,
        ];

        if (!empty($data['email'])) {
            try {
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

                $result['pelapor_sent'] = true;
            } catch (\Throwable $e) {
                Log::warning('Gagal mengirim email konfirmasi pengaduan ke pelapor.', [
                    'pengaduan_id' => $pengaduan->id,
                    'email' => $data['email'],
                    'error' => $e->getMessage(),
                ]);
            }
        }

        try {
            Mail::to(config('mail.admin_address', env('MAIL_ADMIN')))
                ->send(new NewPengaduanAdmin($pengaduan));
            $result['admin_sent'] = true;
        } catch (\Throwable $e) {
            Log::warning('Gagal mengirim notifikasi pengaduan ke admin.', [
                'pengaduan_id' => $pengaduan->id,
                'admin_email' => config('mail.admin_address', env('MAIL_ADMIN')),
                'error' => $e->getMessage(),
            ]);
        }

        return $result;
    }
}
