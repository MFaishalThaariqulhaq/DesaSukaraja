<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pengaduan;

class NewPengaduanAdmin extends Mailable
{
  use Queueable, SerializesModels;

  public $pengaduan;

  public function __construct(Pengaduan $pengaduan)
  {
    $this->pengaduan = $pengaduan;
  }

  public function build()
  {
    return $this->subject('Laporan Pengaduan Baru')->view('emails.pengaduan.new_admin');
  }
}
