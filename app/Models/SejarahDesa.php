<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahDesa extends Model
{
  protected $fillable = [
    'profil_desa_id',
    'tahun',
    'judul',
    'deskripsi',
    'gambar',
  ];

  public function profilDesa()
  {
    return $this->belongsTo(ProfilDesa::class, 'profil_desa_id');
  }
}
