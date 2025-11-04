<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Pengaduan;

class PengaduanStatusUpdated extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $pengaduan;
  public $oldStatus;
  public $newStatus;

  public function __construct(Pengaduan $pengaduan, $oldStatus, $newStatus)
  {
    $this->pengaduan = $pengaduan;
    $this->oldStatus = $oldStatus;
    $this->newStatus = $newStatus;
  }

  public function build()
  {
    return $this->subject('Perubahan Status Pengaduan')->view('emails.pengaduan.status_updated');
  }
}
