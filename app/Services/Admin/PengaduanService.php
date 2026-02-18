<?php

namespace App\Services\Admin;

use App\Mail\PengaduanStatusUpdated;
use App\Models\Pengaduan;
use App\Models\PengaduanLog;
use Illuminate\Support\Facades\Mail;

class PengaduanService
{
    public function updateStatus(Pengaduan $pengaduan, array $validatedData): void
    {
        $oldStatus = $pengaduan->status;

        $pengaduan->update([
            'status' => $validatedData['status'],
            'admin_notes' => $validatedData['admin_notes'] ?? null,
        ]);

        PengaduanLog::create([
            'pengaduan_id' => $pengaduan->id,
            'action' => 'updated',
            'meta' => json_encode([
                'old_status' => $oldStatus,
                'new_status' => $validatedData['status'],
                'admin_notes' => $validatedData['admin_notes'] ?? null,
                'admin' => session('admin_logged_in') ? 'admin' : null,
            ]),
        ]);

        if ($oldStatus !== $validatedData['status'] && $pengaduan->email) {
            try {
                Mail::to($pengaduan->email)
                    ->queue(new PengaduanStatusUpdated($pengaduan, $oldStatus, $validatedData['status']));
            } catch (\Throwable $e) {
                // User flow should not fail due to mail transport issue.
            }
        }
    }
}
