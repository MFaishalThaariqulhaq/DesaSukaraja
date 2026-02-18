<?php

namespace App\Services\Admin;

use App\Mail\PengaduanStatusUpdated;
use App\Models\Pengaduan;
use App\Models\PengaduanLog;
use App\Models\PengaduanProgress;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class PengaduanService
{
    public function updateStatus(Pengaduan $pengaduan, array $validatedData, ?UploadedFile $progressPhoto = null): void
    {
        $oldStatus = $pengaduan->status;
        $newStatus = $validatedData['status'];
        $progressNote = trim((string) ($validatedData['progress_note'] ?? ''));
        $isPublic = (bool) ($validatedData['publish_progress'] ?? true);
        $storedPhotoPath = $progressPhoto ? $progressPhoto->store('pengaduan-progress', 'public') : null;

        $pengaduan->update([
            'status' => $newStatus,
            'admin_notes' => $validatedData['admin_notes'] ?? null,
        ]);

        $shouldCreateProgress = $oldStatus !== $newStatus || $progressNote !== '' || $storedPhotoPath !== null;
        $progressEntry = null;

        if ($shouldCreateProgress) {
            $autoNote = $oldStatus !== $newStatus
                ? 'Status diubah dari "' . str_replace('_', ' ', $oldStatus) . '" ke "' . str_replace('_', ' ', $newStatus) . '".'
                : null;

            $progressEntry = PengaduanProgress::create([
                'pengaduan_id' => $pengaduan->id,
                'status' => $newStatus,
                'note' => $progressNote !== '' ? $progressNote : $autoNote,
                'photo_path' => $storedPhotoPath,
                'is_public' => $isPublic,
                'created_by' => session('admin_logged_in') ? 'admin' : null,
            ]);
        }

        PengaduanLog::create([
            'pengaduan_id' => $pengaduan->id,
            'action' => 'updated',
            'meta' => json_encode([
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'admin_notes' => $validatedData['admin_notes'] ?? null,
                'progress_note' => $progressNote !== '' ? $progressNote : null,
                'progress_photo' => $storedPhotoPath,
                'progress_public' => $isPublic,
                'progress_id' => $progressEntry?->id,
                'admin' => session('admin_logged_in') ? 'admin' : null,
            ]),
        ]);

        if ($oldStatus !== $newStatus && $pengaduan->email) {
            try {
                Mail::to($pengaduan->email)
                    ->queue(new PengaduanStatusUpdated($pengaduan, $oldStatus, $newStatus));
            } catch (\Throwable $e) {
                // User flow should not fail due to mail transport issue.
            }
        }
    }
}
